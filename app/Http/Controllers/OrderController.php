<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //list

    public function orderList($state = ''){
        $orderList = Order::select('orders.id as order_id','orders.created_at','orders.order_code','orders.status','users.name as user_name')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->when(request('orderCode'), function ($query) {
                        $query->where('orders.order_code', 'like', '%' . request('orderCode') . '%');
                    });
        if($state == 'reject'){
            $orderList = $orderList->where('orders.status','=','reject');
        }else{
            $orderList = $orderList ->where('orders.status','!=','reject');
        }
            $orderList = $orderList->groupBy('orders.order_code')
                                    ->orderBy('orders.created_at','desc')
                                    ->paginate(5);




                    foreach($orderList as $item){

                        $orderData = Order::select(
                                'users.name','users.phone','users.address',
                                'orders.order_code','orders.created_at',
                                'orders.total_price','orders.count as order_count',
                                'products.stock','products.name','products.price','products.image'
                            )
                            ->leftJoin('users','orders.user_id','users.id')
                            ->leftJoin('products','orders.product_id','products.id')
                            ->where('orders.order_code',$item->order_code)
                            ->get();

                        $eachOrderStatus = true;

                        foreach($orderData as $eachItem){
                            if($eachItem->order_count > $eachItem->stock){
                                $eachOrderStatus = false;
                                break;
                            }
                        }

                        // ✅ correct
                        $item->confirmStatus = $eachOrderStatus;
                    }


        return view('admin.order.list',compact('orderList'));
    }


    //detail
    public function orderDetail($orderCode){
        $orderData = Order::select('users.name as customer_name','users.phone','users.address','orders.order_code','orders.created_at','orders.total_price','orders.status','orders.count as order_count','products.stock','products.name','products.price','products.image','products.id as product_id')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->leftJoin('products','orders.product_id','products.id')
                    ->where('orders.order_code',$orderCode)
                    ->get();

        $paymentHistories = PaymentHistory::select('payment_histories.name','payment_histories.phone','payment_histories.payslip_image','payment_histories.address','payment_histories.total_amount','payment_histories.created_at','payments.account_type as payment_method')
                            ->leftJoin('payments','payment_histories.payment_method','payments.id')
                            ->where('order_code',$orderCode)
                            ->first();

        $totalAmt = 5000;

        foreach($orderData as $item){
        $totalAmt += $item['total_price'];
        }
        return view('admin.order.detail',compact('orderData','totalAmt','paymentHistories'));

    }

     //reject order

     public function orderReject($orderCode){
        Order::where('order_code', $orderCode)->update([
            'status' => 'reject'
        ]);

        return redirect()->route('admin#orderList')
                         ->with('success', 'Order rejected successfully');
    }



    public function orderAccept(Request $request){
        // Get the order first
        $order = Order::where('order_code', $request->orderCode)->first();

        if(!$order){
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found'
            ]);
        }

        // Update order status
        Order::where('order_code', $request->orderCode)->update([
            'status' => 'success'
        ]);

        $userId = $order->user_id; // customer's ID

        // reduce stock & create action log
        foreach($request->data as $item){
            Product::where('id', $item['productId'])->decrement('stock', $item['orderCount']);

            // create purchased log
            ActionLog::create([
                'user_id' => $userId,  // logs customer
                'product_id' => $item['productId'], // the purchased product
                'action' => 'purchased'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order Confirmed'
        ]);
    }


}
