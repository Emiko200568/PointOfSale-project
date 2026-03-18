<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    //profile detail

    public function detail(){
        return view('user.profile.detail');
    }

    //edit profile
    public function edit(){
        return view('user.profile.edit');
    }

       // Update profile
   public function update(Request $request, $id)
   {
       $request->validate([
           'name'    => 'required|string|max:255',
           'email'   => 'required|email|unique:users,email,' . $id,
           'phone'   => 'required|string|max:20',
           'address' => 'required|string|max:255',
           'profile'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
       ]);

       $user = User::findOrFail($id);

       // Handle image upload (merged version)
       if ($request->hasFile('image')) {

           // Delete old image if exists
           if ($user->profile && file_exists(public_path('userProfile/' . $user->profile))) {
               unlink(public_path('userProfile/' . $user->profile));
           }

           // Upload new image
           $imageName = time() . '.' . $request->profile->extension();
           $request->profile->move(public_path('userProfile'), $imageName);

           // Update the user profile column
           $user->profile = $imageName;
       }

       // Update other fields
       $user->name = $request->name;
       $user->email = $request->email;
       $user->phone = $request->phone;
       $user->address = $request->address;

       $user->save();

       return redirect()->route('user#detail')
           ->with('success', 'Profile updated successfully');
   }
   //change password page
   public function changePasswordPage()
{
    return view('user.profile.changePassword');
}

//change password
public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully');

}
}
