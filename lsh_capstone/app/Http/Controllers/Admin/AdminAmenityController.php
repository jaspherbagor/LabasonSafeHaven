<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AdminAmenityController extends Controller
{
    // Method to display all amenities
    public function index()
    {
        // Fetch all amenities from the database
        $amenities = Amenity::get();
        // Return a view with the fetched amenities data
        return view('admin.amenity_view', compact('amenities'));
    }

    // Method to display add amenity form
    public function add()
    {
        // Return the add amenity form view
        return view('admin.amenity_add');
    }

    // Method to store a newly created amenity
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required',
        ]);

        // Create a new Amenity instance
        $obj = new Amenity();
        // Set the name attribute from the request
        $obj->name = $request->name;
        // Save the amenity to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Amenity is added successfully!');
    }

    // Method to display edit amenity form
    public function edit($id)
    {
        // Fetch the amenity data by ID
        $amenity_data = Amenity::where('id',$id)->first();
        // Return the edit amenity form view with the fetched data
        return view('admin.amenity_edit', compact('amenity_data'));
    }

    // Method to update an existing amenity
    public function update(Request $request, $id)
    {
        // Fetch the amenity by ID
        $obj = Amenity::where('id', $id)->first();

        // Update the name attribute from the request
        $obj->name = $request->name;
        // Save the updated amenity
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Amenity is updated successfully!');
        
    }

    // Method to delete an existing amenity
    public function delete($id)
    {
        // Fetch the amenity by ID
        $single_data = Amenity::where('id', $id)->first();
        // Delete the fetched amenity
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Amenity is deleted successfully!');
    }
}
