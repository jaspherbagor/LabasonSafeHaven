<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial; // Import the Testimonial model
use Illuminate\Http\Request;

class AdminTestimonialController extends Controller
{
    // Display all testimonials
    public function index()
    {
        $testimonials = Testimonial::get(); // Fetch all testimonials
        return view('admin.testimonial_view', compact('testimonials')); // Return the view with testimonial data
    }

    // Display the form to add a new testimonial
    public function add()
    {
        return view('admin.testimonial_add'); // Return the view for adding a testimonial
    }

    // Process the submission of adding a new testimonial
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120', // Photo field is required and must be an image
            'name' => 'required', // Name field is required
            'designation' => 'required', // Designation field is required
            'comment' => 'required' // Comment field is required
        ]);

        // Move the uploaded photo to the public/uploads directory
        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;
        $request->file('photo')->move(public_path('uploads/'),$final_name);

        // Create a new Testimonial instance and save it to the database
        $obj = new Testimonial();
        $obj->photo = $final_name;
        $obj->name = $request->name;
        $obj->designation = $request->designation;
        $obj->comment = $request->comment;
        $obj->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Testimonial is added successfully!');
    }

    // Display the form to edit a testimonial
    public function edit($id)
    {
        $testimonial_data = Testimonial::where('id',$id)->first(); // Fetch the testimonial data by ID
        return view('admin.testimonial_edit', compact('testimonial_data')); // Return the view for editing the testimonial
    }

    // Process the submission of editing a testimonial
    public function update(Request $request, $id)
    {
        // Fetch the testimonial by ID
        $obj = Testimonial::where('id', $id)->first();

        // If a new photo is uploaded, update the photo
        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120', // New photo must be an image
            ]);

            // Delete the old photo
            unlink(public_path('uploads/'.$obj->photo));

            // Move the new photo to the public/uploads directory
            $ext = $request->file('photo')->extension();
            $final_name = time().'.'.$ext;
            $request->file('photo')->move(public_path('uploads/'),$final_name);

            // Update the photo property of the testimonial
            $obj->photo = $final_name;           
        }

        // Update other properties of the testimonial
        $obj->name = $request->name;
        $obj->designation = $request->designation;
        $obj->comment = $request->comment;
        $obj->update();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Testimonial is updated successfully!');
        
    }

    // Delete a testimonial
    public function delete($id)
    {
        $single_data = Testimonial::where('id', $id)->first(); // Fetch the testimonial data by ID
        unlink(public_path('uploads/'.$single_data->photo)); // Delete the photo associated with the testimonial
        $single_data->delete(); // Delete the testimonial record from the database

        // Redirect back with success message
        return redirect()->back()->with('success', 'Testimonial is deleted successfully!');
    }
}
