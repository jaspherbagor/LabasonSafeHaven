<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail; // Import the Mailable class for sending emails
use App\Models\Subscriber; // Import the Subscriber model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Import the Mail facade for sending emails

class AdminSubscriberController extends Controller
{
    // Display all active subscribers
    public function index()
    {
        $subscriber = Subscriber::where('status', 1)->get(); // Fetch all subscribers with status 1 (active)
        return view('admin.subscriber_show', compact('subscriber')); // Return the view with subscriber data
    }

    // Display the form to compose and send an email to subscribers
    public function send_email()
    {
        return view('admin.subscriber_send_email'); // Return the view for composing and sending emails
    }

    // Process the submission of the email to subscribers
    public function submit_email(Request $request)
    {
        // Validate the request data
        $request->validate([
            'subject' => 'required', // Subject field is required
            'message' => 'required' // Message field is required
        ]);

        // Send Email

        $subject  = $request->subject; // Get the subject from the request
        $message = $request->message; // Get the message from the request

        $all_subscribers = Subscriber::where('status', 1)->get(); // Fetch all subscribers with status 1 (active)

        // Loop through each active subscriber and send them the email
        foreach($all_subscribers as $item)
        {
            Mail::to($item->email)->send(new WebsiteMail($subject, $message)); // Send the email using the WebsiteMail Mailable class
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Email has been sent successfully');
    }
}
