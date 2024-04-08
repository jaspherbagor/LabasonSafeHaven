<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    // Method to display the admin profile page
    public function index()
    {
        return view('admin.profile');
    }

    // Method to submit profile changes
    public function profileSubmit(Request $request)
    {
        // Retrieve the admin data based on the authenticated user's email
        $admin_data = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        // Validate the incoming request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Check if password is being updated
        if ($request->password != '') {
            // Validate password fields
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            // Update the password with hashed value
            $admin_data->password = Hash::make($request->password);
        }

        // Check if a new profile photo is being uploaded
        if ($request->hasFile('photo')) {
            // Validate the uploaded photo file
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120',
            ]);

            // Delete the old profile photo file
            unlink(public_path('uploads/'.$admin_data->photo));

            // Get the file extension and generate a unique name for the new photo
            $ext = $request->file('photo')->extension();
            $final_name = 'admin'.'.'.$ext;

            // Move the uploaded photo to the uploads directory
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            // Update the profile photo file name
            $admin_data->photo = $final_name;
        }

        // Update the admin's name and email
        $admin_data->name = $request->name;
        $admin_data->email = $request->email;
        $admin_data->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile information is saved successfully!');
    }
}
