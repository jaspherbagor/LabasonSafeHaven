<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerProfileController extends Controller
{
    // Display the customer profile view
    public function index()
    {
        return view('customer.profile');
    }

    // Handle profile update form submission
    public function profile_submit(Request $request)
    {
        // Retrieve the customer data for the logged-in customer
        $customer_data = Customer::where('email', Auth::guard('customer')->user()->email)->first();

        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        // Check if password is provided for update
        if ($request->password != '') {
            // Validate password and retype password fields
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required|same:password'
            ]);
            // Update password with hashed value
            $customer_data->password = Hash::make($request->password);
        }

        // Check if photo is provided for update
        if ($request->hasFile('photo')) {
            // Validate photo file
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif,svg,webp|max:5120'
            ]);

            // Delete previous photo if exists
            if ($customer_data->photo != NULL) {
                unlink(public_path('uploads/' . $customer_data->photo));
            }

            // Move uploaded photo to public/uploads directory
            $ext = $request->file('photo')->extension();
            $final_name = time() . '.' . $ext;
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            // Update photo field with new photo name
            $customer_data->photo = $final_name;
        }

        // Update other profile fields
        $customer_data->name = $request->name;
        $customer_data->email = $request->email;
        $customer_data->phone = $request->phone;
        $customer_data->country = $request->country;
        $customer_data->address = $request->address;
        $customer_data->province = $request->province;
        $customer_data->city = $request->city;
        $customer_data->zip = $request->zip;
        $customer_data->update();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile information is saved successfully.');
    }
}
