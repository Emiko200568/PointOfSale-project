<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //payment method list

    public function list(){
        $payments = Payment::orderBy('created_at','desc')->paginate(3);
        return view('admin.paymentMethod.list',compact('payments'));
    }

    //payment create
    public function create(Request $request){
        $request->validate([
            'account_number' => 'required|digits_between:5,20',
            'account_name'   => 'required|string|min:2|max:20',
            'account_type'   => 'required|string|min:2|max:10',
        ]);

        Payment::create($request->only([
        'account_number',
        'account_name',
        'account_type',

        ]));
        return back()->with(['success'=>'Create Successfully']);


    }

      //delete payment
      public function delete($id){
        Payment::destroy($id);
        return redirect()->route('paymentMethod#list')
                         ->with('success', 'Deleted successfully');
    }


        //edit payment

        public function edit($id) {
            $payment = Payment::find($id);

            return view('admin.paymentMethod.edit',compact('payment'));

        }

         //update payment

         public function update($id, Request $request)
         {
             $this->validationCheck($request, $id);

             Payment::where('id', $id)->update([
                 'account_number' => $request->account_number,
                 'account_name' => $request->account_name,
                 'account_type' => $request->account_type,
             ]);

             return redirect()->route('paymentMethod#list')
             ->with('success', 'Payment method updated successfully');

         }


         private function validationCheck(Request $request,$id){
            $request->validate([
                'account_number' => 'required|digits_between:5,20|unique:payments,account_number,'.$request->id,
                'account_name'   => 'required|string|min:2|max:30',
                'account_type'   => 'required|string|min:2|max:20',
            ]);
        }

    }






