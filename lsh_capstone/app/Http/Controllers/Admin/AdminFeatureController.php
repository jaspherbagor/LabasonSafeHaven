<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class AdminFeatureController extends Controller
{
    // Method to display all features
    public function index()
    {
        // Fetch all features from the database
        $features = Feature::get();
        // Return a view with the fetched features data
        return view('admin.feature_view', compact('features'));
    }

    // Method to display add feature form
    public function add()
    {
        // Return the add feature form view
        return view('admin.feature_add');
    }

    // Method to store a newly created feature
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'icon' => 'required',
            'heading' => 'required'
        ]);

        // Create a new Feature instance
        $obj = new Feature();
        // Set the icon, heading, and text attributes from the request
        $obj->icon = $request->icon;
        $obj->heading = $request->heading;
        $obj->text = $request->text;
        // Save the feature to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Feature is added successfully!');
    }

    // Method to display edit feature form
    public function edit($id)
    {
        // Fetch the feature data by ID
        $feature_data = Feature::where('id',$id)->first();
        // Return the edit feature form view with the fetched data
        return view('admin.feature_edit', compact('feature_data'));
    }

    // Method to update an existing feature
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'icon' => 'required',
            'heading' => 'required'
        ]);

        // Fetch the feature by ID
        $obj = Feature::where('id', $id)->first();

        // Update the icon, heading, and text attributes from the request
        $obj->icon = $request->icon;
        $obj->heading = $request->heading;
        $obj->text = $request->text;
        // Save the updated feature
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Feature is updated successfully!');
        
    }

    // Method to delete an existing feature
    public function delete($id)
    {
        // Fetch the feature by ID
        $single_data = Feature::where('id', $id)->first();
        // Delete the fetched feature
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Feature is deleted successfully!');
    }
}
