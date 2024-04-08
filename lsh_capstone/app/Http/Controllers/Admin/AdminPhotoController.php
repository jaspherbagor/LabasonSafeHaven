<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class AdminPhotoController extends Controller
{
    // Method to display all photos
    public function index()
    {
        // Fetch all photos from the database
        $photos = Photo::get();
        // Return the view with fetched photos data
        return view('admin.photo_view', compact('photos'));
    }

    // Method to display the photo add form
    public function add()
    {
        // Return the view for adding a photo
        return view('admin.photo_add');
    }

    // Method to store a new photo
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120' // Maximum file size: 5MB
        ]);

        // Get the file extension and generate a unique name for the photo
        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;

        // Move the uploaded photo to the uploads directory
        $request->file('photo')->move(public_path('uploads/'), $final_name);

        // Create a new Photo instance and save it to the database
        $obj = new Photo();
        $obj->photo = $final_name;
        $obj->caption = $request->caption;
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Photo is added successfully!');
    }

    // Method to display the photo edit form
    public function edit($id)
    {
        // Fetch the photo data by its ID
        $photo_data = Photo::where('id', $id)->first();
        // Return the view for editing the photo with fetched data
        return view('admin.photo_edit', compact('photo_data'));
    }

    // Method to update an existing photo
    public function update(Request $request, $id)
    {
        // Fetch the photo data by its ID
        $obj = Photo::where('id', $id)->first();

        // Check if a new photo file is uploaded
        if ($request->hasFile('photo')) {
            // Validate the uploaded file
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120', // Maximum file size: 5MB
            ]);

            // Delete the old photo file
            unlink(public_path('uploads/'.$obj->photo));

            // Get the file extension and generate a unique name for the new photo
            $ext = $request->file('photo')->extension();
            $final_name = time().'.'.$ext;

            // Move the uploaded photo to the uploads directory
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            // Set the new photo file name
            $obj->photo = $final_name;
        }

        // Update the photo caption
        $obj->caption = $request->caption;
        // Save the changes to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Photo is updated successfully!');
    }

    // Method to delete a photo
    public function delete($id)
    {
        // Fetch the photo data by its ID
        $single_data = Photo::where('id', $id)->first();
        // Delete the photo file from the uploads directory
        unlink(public_path('uploads/'.$single_data->photo));
        // Delete the photo record from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Photo is deleted successfully!');
    }
}
