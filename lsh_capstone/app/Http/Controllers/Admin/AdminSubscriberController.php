<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class AdminSubscriberController extends Controller
{
    public function index()
    {
        $subscriber = Subscriber::where('status', 1)->get();
        return view('admin.subscriber_view', compact('subscriber'));
    }
}
