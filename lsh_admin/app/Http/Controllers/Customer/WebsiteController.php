<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }
}
