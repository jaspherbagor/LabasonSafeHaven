<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    // Method to display all posts
    public function index()
    {
        // Fetch all posts from the database
        $posts = Post::get();
        // Return the view with fetched posts data
        return view('admin.post_view', compact('posts'));
    }

    // Method to display the post add form
    public function add()
    {
        // Return the view for adding a post
        return view('admin.post_add');
    }

    // Method to store a new post
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120', // Maximum file size: 5MB
            'heading' => 'required',
            'short_content' => 'required',
            'content' => 'required'
        ]);

        // Get the file extension and generate a unique name for the photo
        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;

        // Move the uploaded photo to the uploads directory
        $request->file('photo')->move(public_path('uploads/'), $final_name);

        // Create a new Post instance and save it to the database
        $obj = new Post();
        $obj->photo = $final_name;
        $obj->heading = $request->heading;
        $obj->short_content = $request->short_content;
        $obj->content = $request->content;
        $obj->total_view = 1; // Assuming view count starts from 1
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Post is added successfully!');
    }

    // Method to display the post edit form
    public function edit($id)
    {
        // Fetch the post data by its ID
        $post_data = Post::where('id', $id)->first();
        // Return the view for editing the post with fetched data
        return view('admin.post_edit', compact('post_data'));
    }

    // Method to update an existing post
    public function update(Request $request, $id)
    {
        // Fetch the post data by its ID
        $obj = Post::where('id', $id)->first();

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

        // Update the post heading, short content, and content
        $obj->heading = $request->heading;
        $obj->short_content = $request->short_content;
        $obj->content = $request->content;
        // Save the changes to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Post is updated successfully!');
    }

    // Method to delete a post
    public function delete($id)
    {
        // Fetch the post data by its ID
        $single_data = Post::where('id', $id)->first();
        // Delete the post photo file from the uploads directory
        unlink(public_path('uploads/'.$single_data->photo));
        // Delete the post record from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Post is deleted successfully!');
    }
}
