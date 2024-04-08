<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    // Method to display all customers
    public function index()
    {
        // Fetch all customers from the database
        $customers = Customer::get();
        // Return a view with the fetched customers data
        return view('admin.customer', compact('customers'));
    }

    // Method to change customer status
    public function change_status($id)
    {
        // Fetch the customer data by ID
        $customer_data = Customer::where('id', $id)->first();
        
        // Check if the current status is 1 (active)
        if($customer_data->status == 1) {
            // If active, change status to 0 (inactive)
            $customer_data->status = 0;
        } else {
            // If inactive, change status to 1 (active)
            $customer_data->status = 1;
        }

        // Update the status in the database
        $customer_data->update();
        
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Customer status has been successfully changed!');
    }
}
