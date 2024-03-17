<?php

namespace App\Http\Controllers;

use App\Mail\WebsiteMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function index() 
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function login() {
        return view('login');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function loginSubmit(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'Active'
        ];

        if(Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login');
        }

    }

    public function registration() {
        return view('registration');
    }

    public function registrationSubmit(Request $request) 
    {
        $token = hash('sha256', time());

        $user = new User();
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->password  = Hash::make($request->password);
        $user->status  = 'Pending';
        $user->token = $token;
        $user->save();

        $verificationLink = url('registration/verify/'.$token.'/'.$request->email);
        $subject = 'Registration Confirmation';
        $message = 'Thank you for registering an account. to verify your account, please click the link: <br> <a href="'.$verificationLink.'">Click Here</a>';

        \Mail::to($request->email)->send(new WebsiteMail($subject, $message));

        echo 'Email is sent';
    }

    public function registrationVerify($token, $email)
    {
        $user = User::where('token',$token)->where('email', $email)->first();

        if(!$user) {
            return redirect()->route('login');
        }

        $user->status = 'Active';
        $user->token = '';
        $user->update();

        echo 'Registration verification is successful';
    }

    public function forgetPassword() 
    {
        return view('forget_password');
    }

    public function forgetPasswordSubmit(Request $request) 
    {
        $token = hash('sha256', time());

        $user = User::where('email', $request->email)->first();

        if(!$user) {
            dd('Email not found');
        }

        $user->token = $token;
        $user->update();

        $resetLink = url('reset-password/'.$token.'/'.$request->email);

        $subject = 'Reset Password';
        $message = 'Please click on the link to reset your password. <br> <a href="'.$resetLink.'">Click Here</a>';

        \Mail::to($request->email)->send(new WebsiteMail($subject, $message));

        echo 'Check your email';
       
    }

    public function resetPassword($token, $email) {
        $user = User::where('token', $token)->where('email', $email)->first();

        if(!$user) {
            return redirect()->route('login');
        }

        return view('reset_password', compact('token', 'email'));
    }

    public function resetPasswordSubmit(Request $request) {
        echo $request->token;
    }
}
