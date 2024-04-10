<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerHomeController extends Controller
{
    // Display the customer dashboard
    public function index()
    {
        // Retrieve the total completed orders for the logged-in customer
        $total_completed_orders = Order::where('status','Completed')->where('customer_id',Auth::guard('customer')->user()->id)->count();
        
        // Retrieve the total pending orders for the logged-in customer
        $total_pending_orders = Order::where('status','Pending')->where('customer_id',Auth::guard('customer')->user()->id)->count();
        
        // Pass the total completed and pending orders to the view
        return view('customer.home', compact('total_completed_orders','total_pending_orders'));
    }
}
