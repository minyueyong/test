<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function sendEmail()
    {
    	$data = array('name'=>"Company Name");
      	Mail::send('mail', $data, function($message) 
      	{
         $message->to('evonmiyako.em@gmail.com', 'Company Name')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('images/subscriptionfees.png');
         $message->from('monsta@gmail.com','Monsta Asia');
      });
      echo "Email Sent with attachment. Check your inbox.";
    }
}
