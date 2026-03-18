<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    //profile

    public function detail(){
        return view('admin.profile.detail');
    }

    public function edit(){
        return view('admin.profile.edit');
    }

   // Update profile
   public function update(Request $request, $id)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|unique:users,email,' . $id,
        'phone'   => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $user = User::findOrFail($id);

    // Handle image upload (merged version)
    if ($request->hasFile('image')) {

        // Delete old image if exists
        if ($user->profile && file_exists(public_path('profileImage/' . $user->profile))) {
            unlink(public_path('profileImage/' . $user->profile));
        }

        // Upload new image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('profileImage'), $imageName);

        // Update the user profile column
        $user->profile = $imageName;
    }

    // Update other fields
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully');

}

//change password page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    //change password process
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $dbAccountPassword = auth()->user()->password;

        $passwordCheckStatus = Hash::check($request->oldPassword, $dbAccountPassword);

        if($passwordCheckStatus){
            User::find(auth()->user()->id)->update(['password'=>Hash::make($request->newPassword)]);

            return back()->with(['success'=>'password change success']);
        }
        return back()->with(['fail'=>'Old Password do not match our records. Try again!']);

    }

    //password validation check
    private function passwordValidationCheck($request){
        $request->validate([
            'oldPassword'=>'required|min:8|max:20',
            'newPassword'=>'required|min:8|max:20',
            'confirmPassword'=>'required|min:8|max:20|same:newPassword',
        ]);

    }

    // Add New Admin page

    public function addNewAdminPage(){
        return view('admin.profile.addNewAdmin');
    }

    //Add new admin

    public function addNewAdmin(Request $request){
       $this->checkAccountValidation($request);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'provider'=>'simple'

        ]);

        return back()->with(['success'=>'Admin Add success']);
    }

    private function checkAccountValidation($request){
        $request->validate([
            'name'=>'required|min:1|max:30',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|max:20',
            'confirmPassword'=>'required|min:8|max:20|same:password',

        ]);
    }

    //Admin List page

    public function adminList(Request $request)
{
    // Start query for admins & superadmins
    $query = User::whereIn('role', ['admin', 'superadmin']);

    // Check if searchKey exists
    if ($request->filled('searchKey')) {
        $searchKey = $request->searchKey;

        $query->where(function ($q) use ($searchKey) {
            $q->where('name', 'like', '%' . $searchKey . '%')
              ->orWhere('email', 'like', '%' . $searchKey . '%')
              ->orWhere('phone', 'like', '%' . $searchKey . '%');
        });
    }

    // Get results
    $adminAccounts = $query->get();

    return view('admin.profile.adminList', compact('adminAccounts'));
}


     //User List page


    public function userList(Request $request)
    {
        // Start query for admins & superadmins
        $query = User::whereIn('role', ['user']);

        // Check if searchKey exists
        if ($request->filled('searchKey')) {
            $searchKey = $request->searchKey;

            $query->where(function ($q) use ($searchKey) {
                $q->where('name', 'like', '%' . $searchKey . '%')
                  ->orWhere('email', 'like', '%' . $searchKey . '%')
                  ->orWhere('phone', 'like', '%' . $searchKey . '%')
                  ->orWhere('address', 'like', '%' . $searchKey . '%')
                  ->orWhere('role', 'like', '%' . $searchKey . '%');

                  //$q->whereAny(['name','email','address','phone','role'],'like','%'.$searchKey.'%);
            });
        }

        // Get results
        $userAccounts = $query->get();

        return view('admin.profile.userList', compact('userAccounts'));
    }


    //delete category

    public function delete($id){
        User::destroy($id);
        return back()->with('success', 'Deleted successfully');
    }



}
