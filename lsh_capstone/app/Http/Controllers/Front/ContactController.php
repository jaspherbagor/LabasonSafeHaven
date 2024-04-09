<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Admin;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // Display the contact form
    public function index()
    {
        $contact_data = Page::where('id', 1)->first();
        return view('front.contact', compact('contact_data'));
    }

    // Handle the submission of the contact form
    public function send_email(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // If validation fails, return error response
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error_message' => $validator->errors()->toArray()]);
        } else {
            // Send email
            $subject = 'Contact form email';
            $message = 'Visitor email information: <br>';
            $message .= '<br>Name: ' . $request->name;
            $message .= '<br>Email: ' . $request->email;
            $message .= '<br>Message: ' . $request->message;

            $admin_data = Admin::where('id', 1)->first();
            $admin_email = $admin_data->email;

            Mail::to($admin_email)->send(new WebsiteMail($subject, $message));

            // Return success response
            return response()->json(['code' => 1, 'success_message' => 'Email has been sent successfully!']);
        }
    }
}
