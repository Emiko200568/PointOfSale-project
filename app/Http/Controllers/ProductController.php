<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //product list page

    public function list(){
        $products = Product::select('id','name','image','stock','created_at')->paginate(10);
        return view('admin.product.list',compact('products'));
    }

    //product create page

    public function createPage(){
        $categories = Category::select('id','name')->orderBy('created_at','desc')->get();
        return view('admin.product.create',compact('categories'));
    }


    public function create(Request $request)
{
    $this->productValidation($request);

    $data = [
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'stock' => $request->stock,
        'category_id' => $request->categoryId,
    ];

    // image upload
    $imageName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
    $request->file('image')->move(public_path('productImage'), $imageName);

    // FIXED variable name
    $data['image'] = $imageName;

    $product = Product::create($data);

    ActionLog::create([
        'user_id' => auth()->id(),
        'product_id' => $product->id,
        'action' => 'created'
    ]);


    return back()->with(['success'=>'Created Successfully']);
}


    //validation check

    private function productValidation($request){
        $rules = [
            'image' =>'required|image|mimes:jpg,jpeg,gif,webp,svg,png',
            'name' =>'required|min:3|max:100|unique:products,name',
            'categoryId' =>'required',
            'price' =>'required|integer',
            'stock' =>'required|integer|min:1',
            'description' =>'required|min:10',
        ];

        $message =[
            'image.required' => 'Image Required!'
        ];

        $request->validate($rules,$message);

    }

    //delete product

    public function delete($id)
{
    $product = Product::findOrFail($id);

    if ($product->image && file_exists(public_path('productImage/' . $product->image))) {
        unlink(public_path('productImage/' . $product->image));
    }

    $product->delete();

    return redirect()
        ->route('product#list')
        ->with('success', 'Product deleted successfully');
}

//product edit
 // Show edit form
 public function edit($id)
 {
     $product = Product::findOrFail($id);
     $categories = Category::orderBy('created_at', 'desc')->get();
     return view('admin.product.edit', compact('product', 'categories'));
 }

 // Handle update
 public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:products,name,' . $id,
        'categoryId' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    $product = Product::findOrFail($id);

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($product->image && file_exists(public_path('productImage/' . $product->image))) {
            unlink(public_path('productImage/' . $product->image));
        }

        // Upload new image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('productImage'), $imageName);
        $product->image = $imageName;
    }

    // Update other fields
    $product->name = $request->name;
    $product->category_id = $request->categoryId;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->description = $request->description;

    $product->save();

    return redirect()->route('product#list')->with('success', 'Product updated successfully');
}

public function detail($id)
{
    $product = Product::with('category')->findOrFail($id); // eager load category
    return view('admin.product.detail', compact('product'));
}



}
