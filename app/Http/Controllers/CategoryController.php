<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show category list page
    public function list()
{
    $categories = Category::when(request('searchKey'), function ($query) {
        $query->where('name', 'like', '%' . request('searchKey') . '%');
    })
    ->orderBy('created_at', 'desc')
    ->paginate(5);

    $categoryCount = $categories->toArray();
    $categoryCount = count($categoryCount['data']);

    return view('admin.category.list', compact('categories','categoryCount'));
}


    // Show the create category form
    public function create()
    {
        return view('admin.category.list'); // return the form view
    }

    // Handle the form submission to store category
    public function store(Request $request)
    {
        $this->validationCheck($request);

        Category::create([
            'name' => $request->categoryName
        ]);

        return back()->with(['success' => 'Category created successfully!']);
    }

    //delete category

    public function delete($id){
        Category::destroy($id);
        return back();

    }

    //edit category

    public function edit($id) {
        $category = Category::find($id);

        return view('admin.category.edit',compact('category'));

    }

     //update category

     public function update($id, Request $request)
     {
         $this->validationCheck($request, $id);

         Category::where('id', $id)->update([
             'name' => $request->categoryName
         ]);

         return back()->with('updateSuccess', 'Updated successfully');
     }


    private function validationCheck($request){
        $request->validate([
            'categoryName' => 'required|min:2|max:30|unique:categories,name,'.$request->id //self->skip | other ->check
        ]);
    }
}
