<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    // Method to display all orders
    public function index()
    {
        // Fetch all orders from the database
        $orders = Order::get();
        // Return a view with the fetched orders data
        return view('admin.orders', compact('orders'));
    }

    // Method to display invoice for a specific order
    public function invoice($id)
    {
        // Fetch the order by ID
        $order = Order::where('id', $id)->first();
        // Fetch order details for the order
        $order_detail = OrderDetail::where('order_id',$id )->get();
        // Fetch customer data for the order
        $customer_data = Customer::where('id', $order->customer_id)->first();
        // Return the invoice view with the fetched data
        return view('admin.invoice', compact('order', 'order_detail', 'customer_data'));
    }

    // Method to delete an order
    public function delete($id)
    {
        // Delete the order and its associated order details
        Order::where('id', $id)->delete();
        OrderDetail::where('order_id', $id)->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Order is deleted successfully!');
    }
}
