<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WebsiteMail;
use App\Models\Customer;

class CustomerAuthController extends Controller
{
    // Display the login view
    public function login()
    {
        return view('front.login');
    }

    // Handle login form submission
    public function login_submit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Set the login credentials
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ];

        // Attempt to authenticate the user
        if(Auth::guard('customer')->attempt($credential)) {
            return redirect()->route('customer_home');
        } else {            
            return redirect()->route('customer_login')->with('error', 'Invalid credentials!');
        }
    }

    // Display the signup view
    public function signup()
    {
        return view('front.signup');
    }

    // Handle signup form submission
    public function signup_submit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'retype_password' =>'required|same:password'
        ]);

        // Generate a token and verification link
        $token = hash('sha256', time());
        $password = Hash::make($request->password);
        $verification_link = url('signup-verify/'.$request->email.'/'.$token);

        // Create a new customer record
        $obj = new Customer();
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->password = $password;
        $obj->token = $token;
        $obj->status = 0;
        $obj->save();

        // Send verification email
        $subject = 'Sign Up Verification';
        $message = 'Please click on the link below to confirm sign up process:<br>';
        $message .= '<a href="'.$verification_link.'">';
        $message .= $verification_link;
        $message .= '</a>';

        Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Please check your email and click the link to complete the signup process.');
    }

    // Verify signup through email link
    public function signup_verify($email,$token)
    {
        $customer_data = Customer::where('email',$email)->where('token',$token)->first();

        if($customer_data) {
            $customer_data->token = '';
            $customer_data->status = 1;
            $customer_data->update();

            return redirect()->route('customer_login')->with('success', 'Your account is verified successfully!');
        } else {
            return redirect()->route('customer_login');
        }
    }

    // Logout the user
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer_login');
    }

    // Display forget password view
    public function forget_password()
    {
        return view('front.forget_password');
    }

    // Handle forget password form submission
    public function forget_password_submit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email'
        ]);

        // Find customer data by email
        $customer_data = Customer::where('email',$request->email)->first();
        if(!$customer_data) {
            return redirect()->back()->with('error','Email address not found!');
        }

        // Generate a token and update customer record
        $token = hash('sha256',time());
        $customer_data->token = $token;
        $customer_data->update();

        // Send reset password email
        $reset_link = url('reset-password/'.$token.'/'.$request->email);
        $subject = 'Reset Password';
        $message = 'Please click on the following link to reset the password: <br>';
        $message .= '<a href="'.$reset_link.'">Click here</a>';

        Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->route('customer_login')->with('success','Please check your email and follow the steps there');
    }

    // Display reset password view
    public function reset_password($token,$email)
    {
        $customer_data = Customer::where('token',$token)->where('email',$email)->first();
        if(!$customer_data) {
            return redirect()->route('customer_login');
        }

        return view('front.reset_password', compact('token','email'));
    }

    // Handle reset password form submission
    public function reset_password_submit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password'
        ]);

        // Find customer data by token and email
        $customer_data = Customer::where('token',$request->token)->where('email',$request->email)->first();

        // Update customer password and clear token
        $customer_data->password = Hash::make($request->password);
        $customer_data->token = '';
        $customer_data->update();

        return redirect()->route('customer_login')->with('success', 'Password is reset successfully');
    }
}
