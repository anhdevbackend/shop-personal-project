<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //User ContactList Page
    public function userFeedbackListPage(){
        $userFeedback = Contact::orderBy('created_at','desc')->paginate(4);
        $userFeedback->appends(request()->query());
        return view('admin.contact.userContactListPage',compact('userFeedback'));
    }

    // User Feedback Delete
    public function userFeedbackDelete($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('feedbacks#userFeedbackListPage');
    }
}
