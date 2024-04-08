<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video; // Import the Video model
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    // Display all videos
    public function index()
    {
        $videos = Video::get(); // Fetch all videos
        return view('admin.video_view', compact('videos')); // Return the view with video data
    }

    // Display the form to add a new video
    public function add()
    {
        return view('admin.video_add'); // Return the view for adding a video
    }

    // Process the submission of adding a new video
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'video_id' => 'required' // Video ID field is required
        ]);

        // Create a new Video instance and save it to the database
        $obj = new Video();
        $obj->video_id = $request->video_id;
        $obj->caption = $request->caption;
        $obj->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Video is added successfully!');
    }

    // Display the form to edit a video
    public function edit($id)
    {
        $video_data = Video::where('id',$id)->first(); // Fetch the video data by ID
        return view('admin.video_edit', compact('video_data')); // Return the view for editing the video
    }

    // Process the submission of editing a video
    public function update(Request $request, $id)
    {
        // Fetch the video by ID
        $obj = Video::where('id', $id)->first();

        // Update properties of the video
        $obj->video_id = $request->video_id;
        $obj->caption = $request->caption;
        $obj->update();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Video is updated successfully!');
        
    }

    // Delete a video
    public function delete($id)
    {
        $single_data = Video::where('id', $id)->first(); // Fetch the video data by ID
        $single_data->delete(); // Delete the video record from the database

        // Redirect back with success message
        return redirect()->back()->with('success', 'Video is deleted successfully!');
    }
}
