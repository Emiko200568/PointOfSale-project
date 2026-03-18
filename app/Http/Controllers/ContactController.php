<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    //list

    public function contactList(){
        $contacts = Contact::orderBy('created_at','desc')->get();
        return view('admin.contact.list',compact('contacts'));
    }

    //contact

    public function contactPage() {
        return view('user.dashboard.contact');
    }

    public function contact(Request $request) {
       $request->validate([
        'name' => 'required',
        'email' => 'required',
        'title' => 'required',
        'message' => 'required',

       ]);

       Contact::create([
        'user_id'    => Auth::check() ? Auth::id() : null,
        'user_name'  => $request->name,
        'user_email' => $request->email,
        'title'      => $request->title,
        'message'    => $request->message,
    ]);

    return back()->with('success', 'Message sent successfully!');
}
    }
