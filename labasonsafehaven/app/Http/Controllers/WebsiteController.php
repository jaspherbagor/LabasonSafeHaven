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

    public function forgetPassword() {
        return view('forget_password');
    }
}
