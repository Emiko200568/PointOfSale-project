<?php

namespace App\Http\Controllers;

use user;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // User home page
    public function home()
    {
        $products = Product::select('products.name', 'products.price', 'products.description', 'products.image', 'products.id', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            //when user click category tag
            ->when(request('categoryId'), function ($query) {
                $categoryId = request('categoryId');
                $query->where('products.category_id', $categoryId);

            })
            //when user search products by name
            ->when(request('searchKey'), function ($query) {
                $key = request('searchKey');
                $query->where('products.name', 'like', '%' . $key . '%');
            })
            ->when(request('minPrice') || request('maxPrice'), function ($query) {
                $min = request('minPrice');
                $max = request('maxPrice');

                if (request('minPrice')) {
                    $query->where('products.price', '>=', $min);
                }
                if (request('maxPrice')) {
                    $query->where('products.price', '>=', $max);
                }
            })
            ->when(request('sortingType'), function ($query) {
                $sortType = request('sortingType');

                switch ($sortType) {
                    case 'nameAsc':
                        $query->orderBy('products.name', 'asc');
                        break;
                    case 'nameDesc':
                        $query->orderBy('products.name', 'desc');
                        break;
                    case 'priceAsc':
                        $query->orderBy('products.price', 'asc');
                        break;
                    case 'priceDesc':
                        $query->orderBy('products.price', 'desc');
                        break;
                    case 'dateAsc':
                        $query->orderBy('products.created_at', 'asc');
                        break;
                    case 'dateDe.c':
                        $query->orderBy('products.created_at', 'desc');
                        break;
                }
            })

            ->orderBy('products.created_at', 'desc')->paginate(9);
            ;

        $categories = Category::select('id', 'name')->get();
        return view('user.dashboard.home', compact('products', 'categories')); // Make sure this view exists
    }

    ///product detail

    public function productDetails($id)
    {
        $product = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)
            ->first();

        $comment = Comment::select('comments.id as comment_id', 'comments.product_id', 'comments.user_id', 'users.profile', 'users.name', 'comments.message', 'comments.created_at')
            ->leftJoin('users', 'comments.user_id', 'users.id')
            ->where('comments.product_id', $id)
            ->orderBy('comments.created_at', 'desc')
            ->get();

        $rating = Rating::where('product_id', $id)->where('user_id', auth()->user()->id)->value('count');
        $avgRating = ceil(Rating::where('product_id', $id)->avg('count'));

        return view('user.product.details', compact('product', 'comment', 'rating', 'avgRating'));
    }

    //comment

    public function comment(Request $request)
    {
        Comment::create([
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'message' => $request->comment,

        ]);
        return back()->with(['success' => 'comment success']);

    }

    //comment delete

    public function commentDelete($commentId){
    Comment::where('id', $commentId)->delete();
    return back()->with('successDelete', 'Comment deleted successfully!');
}


    //rating
    public function rating(Request $request)
    {
        Rating::updateOrCreate([
            'user_id' => $request->userId,
            'product_id' => $request->productId
        ], [
            'count' => $request->productRating
        ]);
        return back()->with('RatingSuccess', 'Rating successfully');

    }

    //cart

    public function cart()
    {
        $orderItems = Cart::select('carts.id', 'carts.user_id', 'carts.product_id', 'carts.quantity', 'products.name', 'products.price', 'products.image')
            ->leftJoin('products', 'carts.product_id', 'products.id')
            ->where('carts.user_id', auth()->user()->id)
            ->get();
        return view('user.cart.list', compact('orderItems'));
    }

    //add to cart

    public function addToCart(Request $request)
    {
        Cart::create([
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->count,


        ]);

        return back()->with('AddToCartSuccess', 'Add successfully');

    }

    //delete cart item

    public function deleteCart(Request $request)
    {
        Cart::where('id', $request->deleteCartId)->delete();

        return response()->json([
            'status' => 200,
            "message" => 'cart delete success'

        ]);

    }

    //cart temp
    public function cartTemp(Request $request)
{
    Session::put('tempCart', $request->orderList);

    return response()->json([
        'status' => 200,
        'message' => 'session store success'
    ]);
}


    //payment page

    public function paymentPage()
    {
        if (!Session::has('tempCart')) {
            return redirect()->route('user#cart');
        }

        $order = Session::get('tempCart');

        if (count($order) == 0) {
            return redirect()->route('user#cart');
        }

        $orderCode = $order[0]['order_code'];
        $total = 5000; //deli
        foreach($order as $item){
            $total += $item['total_price'];
        }

        $paymentAccounts = Payment::orderBy('account_type', 'asc')->get();

        return view('user.cart.payment', compact('paymentAccounts','orderCode','total'));
    }


    //payment
    public function payment(Request $request)
{
    $request->validate([
        'name' => 'required|min:2|max:30',
        'phone' => 'required|min:10',
        'address' => 'required|min:5',
        'paymentType' => 'required',
        'payslipImage' => 'required|image'
    ]);

    $order = Session::get('tempCart');
    $total = 5000;

    foreach ($order as $item) {
        Order::create($item);
        $total += $item['total_price'];
    }

    $fileName = uniqid() . $request->file('payslipImage')->getClientOriginalName();
    $request->file('payslipImage')
            ->move(public_path('payslipImage'), $fileName);

    PaymentHistory::create([
        'user_id' => auth()->user()->id,
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'payment_method' => $request->paymentType,
        'order_code' => $order[0]['order_code'],
        'total_amount' => $total,
        'payslip_image' => $fileName
    ]);

    Session::forget('tempCart');

    Cart::where('user_id',auth()->user()->id)->delete(); ///clear cart

    return redirect()->route('user#orderList')->with('payment_success', true);

}

    ///order list
    public function orderList(){
        $orderList = Order::where('user_id',auth()->user()->id)
        ->groupBy('order_code')
        ->orderBy('order_code','desc')
        ->get();
        return view('user.cart.orderList',compact('orderList'));
    }

    ///READ MORE
    public function readMore() {
        return view('user.dashboard.readMore');
    }

    //development team

    public function team(){
        return view('user.dashboard.team');
    }

}

