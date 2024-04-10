<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;

class CustomerOrderController extends Controller
{
    // Display a list of orders for the logged-in customer
    public function index()
    {
        // Retrieve orders associated with the logged-in customer
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)->get();
        
        // Pass the retrieved orders to the view
        return view('customer.orders', compact('orders'));
    }

    // Display invoice for a specific order
    public function invoice($id)
    {
        // Retrieve the order details for the specified order ID
        $order = Order::where('id', $id)->first();
        $order_detail = OrderDetail::where('order_id', $id)->get();
        
        // Pass the order and its details to the view
        return view('customer.invoice', compact('order', 'order_detail'));
    }
}
