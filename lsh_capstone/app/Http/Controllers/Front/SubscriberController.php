<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Admin;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    /**
     * Send verification email to subscribe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send_email(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        // Check if validation fails
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error_message' => $validator->errors()->toArray()]);
        } else {
            // Generate a verification token
            $token = hash('sha256', time());

            // Create a new subscriber record
            $obj = new Subscriber();
            $obj->email = $request->email;
            $obj->status = 0;
            $obj->token = $token;
            $obj->save();

            // Generate verification link
            $verification_link = url('subscriber/verify/'.$request->email.'/'.$token);

            // Send verification email
            $subject = 'Subscriber Verification';
            $message = 'Please click on the link below to confirm your subscription: <br>';
            $message .= '<a href="'.$verification_link.'">'.$verification_link.'</a>';

            Mail::to($request->email)->send(new WebsiteMail($subject, $message));

            return response()->json(['code' => 1, 'success_message' => 'Please check your email to confirm subscription!']);
        }
    }

    /**
     * Verify subscriber's email.
     *
     * @param  string  $email
     * @param  string  $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($email, $token)
    {
        // Find subscriber data by email and token
        $subscriber_data = Subscriber::where('email', $email)->where('token', $token)->first();

        // Check if subscriber data exists
        if ($subscriber_data) {
            // Update subscriber status and token
            $subscriber_data->token = '';
            $subscriber_data->status = 1;
            $subscriber_data->update();

            // Redirect with success message
            return redirect()->route('home')->with('success', 'Your subscription is verified successfully!');
        } else {
            // Redirect with error message
            return redirect()->route('home')->with('error', 'Your data is not found!');
        }
    }
}
