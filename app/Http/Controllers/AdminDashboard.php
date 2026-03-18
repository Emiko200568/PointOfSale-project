<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;

class AdminDashboard extends Controller
{
    //direct admin dashboard
    public function dashboard(){
        $userCount = User::where('role','user')->count();
        $adminCount = User::whereIn('role',['admin','superadmin'])->count();
        $orderCount = Order::whereIn('status',['pending','success'])->count();
        $rejectCount = Order::whereIn('status',['reject'])->count();

        $totalTransitionAmount = PaymentHistory::sum('total_amount');
        $totalOrderSuccessAmount = Order::where('status','success')->sum('total_price');
        $paymentTypeCount = Payment::whereNotNull('account_type')->count();
        $contactCount = Contact::count();
        $categoryCount = Category::count();
        $productCount = Product::count();
        return view('admin.dashboard.home',compact('userCount','adminCount','orderCount','rejectCount','totalTransitionAmount','totalOrderSuccessAmount','paymentTypeCount','contactCount','categoryCount','productCount'));
    }
}
