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
    public function index()
    {
        
        return view('admin.login');
    }

    public function forget_password()
    {
        return view('admin.forget_password');
    }
}
