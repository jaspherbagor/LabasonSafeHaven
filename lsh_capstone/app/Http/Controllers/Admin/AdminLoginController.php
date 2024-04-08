<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WebsiteMail;

class AdminLoginController extends Controller
{
    // Method to display admin login page
    public function index()
    {
        return view('admin.login');
    }

    // Method to display forget password page
    public function forgetPassword()
    {
        return view('admin.forget_password');
    }

    // Method to handle forget password submission
    public function forgetPasswordSubmit(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email'
        ]);

        // Check if admin with provided email exists
        $admin_data = Admin::where('email', $request->email)->first();

        if (!$admin_data) {
            return redirect()->back()->with('error', 'Email address not found!');
        }

        // Generate a reset token
        $token = hash('sha256', time());

        // Update admin's token in the database
        $admin_data->token = $token;
        $admin_data->update();

        // Construct reset link
        $resetLink = url('admin/reset-password/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = 'I hope this message finds you well. You are reaching out to request a password reset for your account. Please assist by following the reset process. Kindly click on the following link to reset your password: ';
        $message .= '<a href="' . $resetLink . '">Click Here</a>';

        // Send reset password email
        Mail::to($request->email)->send(new WebsiteMail($subject, $message));

        return redirect()->route('admin_login')->with('success', 'Please check your email and follow the steps there.');
    }

    // Method to handle admin login submission
    public function loginSubmit(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Prepare credentials
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Attempt to authenticate admin
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin_home');
        } else {
            return redirect()->route('admin_login')->with('error', 'Invalid Credentials!');
        }
    }

    // Method to handle admin logout
    public function logout()
    {
        // Logout admin
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }

    // Method to display reset password page
    public function resetPassword($token, $email)
    {
        // Fetch admin data using token and email
        $admin_data = Admin::where('token', $token)->where('email', $email)->first();
        if (!$admin_data) {
            return redirect()->route('admin_login');
        }

        return view('admin.reset_password', compact('token', 'email'));
    }

    // Method to handle reset password submission
    public function resetPasswordSubmit(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        // Find admin by token and email
        $admin_data = Admin::where('token', $request->token)->where('email', $request->email)->first();
        // Update admin's password and clear token
        $admin_data->password = Hash::make($request->password);
        $admin_data->token = '';
        $admin_data->update();

        return redirect()->route('admin_login')->with('success', 'Password has been reset successfully!');
    }
}
