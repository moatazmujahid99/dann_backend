<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{
    public function PostContactDetails(Request $request){

$name = $request->input('name');
$email = $request->input('email');
$phone = $request->input('phone');
$subject = $request->input('subject');
$message = $request->input('message');
date_default_timezone_set('Africa/Cairo');
$contact_time =  date("h:i:sa");
$contact_date =  date("d-m-y");

    $result = Contact::insert([
            'name' =>$name,
            'email' =>$email,
            'phone' =>$phone,
            'subject' =>$subject,
            'message' =>$message,
            'contact_time' =>$contact_time,
            'contact_date' =>$contact_date ]);
        return $result;
    }//end PostContactDetails
}

