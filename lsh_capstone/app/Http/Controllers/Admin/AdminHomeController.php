<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Room;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    // Method to display admin dashboard
    public function index()
    {
        // Count total completed orders
        $total_completed_orders = Order::where('status', 'Completed')->count();
        // Count total pending orders
        $total_pending_orders = Order::where('status', 'Pending')->count();
        // Count total active customers
        $total_active_customers = Customer::where('status', 1)->count();
        // Count total pending customers
        $total_pending_customers = Customer::where('status', 0)->count();
        // Count total rooms
        $total_rooms = Room::count();
        // Count total subscribers
        $total_subscribers = Subscriber::where('status', 1)->count();
        // Fetch recent orders (last 5)
        $recent_orders = Order::orderBy('id', 'desc')->skip(0)->take(5)->get();
        
        // Return admin dashboard view with the fetched data
        return view('admin.home', compact(
            'total_completed_orders',
            'total_pending_orders',
            'total_active_customers',
            'total_pending_customers',
            'total_rooms',
            'total_subscribers',
            'recent_orders'
        ));
    }
}
