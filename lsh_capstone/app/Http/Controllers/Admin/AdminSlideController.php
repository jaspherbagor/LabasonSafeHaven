<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;

class AdminSlideController extends Controller
{
    // Display all slides
    public function index()
    {
        $slides = Slide::get();
        return view('admin.slide_view', compact('slides'));
    }

    // Display the form to add a new slide
    public function add()
    {
        return view('admin.slide_add');
    }

    // Store a newly created slide in the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120'
        ]);

        // Generate unique filename for the uploaded photo
        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;

        // Move the uploaded photo to the uploads directory
        $request->file('photo')->move(public_path('uploads/'),$final_name);

        // Create a new slide record in the database
        $obj = new Slide();
        $obj->photo = $final_name;
        $obj->heading = $request->heading;
        $obj->text = $request->text;
        $obj->button_text = $request->button_text;
        $obj->button_url = $request->button_url;
        $obj->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Slide is added successfully!');
    }

    // Display the form to edit a slide
    public function edit($id)
    {
        $slide_data = Slide::where('id',$id)->first();
        return view('admin.slide_edit', compact('slide_data'));
    }

    // Update the specified slide in the database
    public function update(Request $request, $id)
    {
        // Find the slide record by ID
        $obj = Slide::where('id', $id)->first();

        // Handle photo upload if present in the request
        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120',
            ]);

            // Delete the old photo from the server
            unlink(public_path('uploads/'.$obj->photo));

            // Generate unique filename for the new photo
            $ext = $request->file('photo')->extension();
            $final_name = time().'.'.$ext;

            // Move the new photo to the uploads directory
            $request->file('photo')->move(public_path('uploads/'),$final_name);

            // Update the photo field in the database
            $obj->photo = $final_name;           
        }

        // Update other fields of the slide
        $obj->heading = $request->heading;
        $obj->text = $request->text;
        $obj->button_text = $request->button_text;
        $obj->button_url = $request->button_url;
        $obj->update();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Slide is updated successfully!');
    }

    // Remove the specified slide from the database
    public function delete($id)
    {
        // Find the slide record by ID
        $single_data = Slide::where('id', $id)->first();

        // Delete the photo associated with the slide from the server
        unlink(public_path('uploads/'.$single_data->photo));

        // Delete the slide record from the database
        $single_data->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Slide is deleted successfully!');
    }
    
}
