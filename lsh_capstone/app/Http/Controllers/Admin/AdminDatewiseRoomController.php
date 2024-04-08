<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BookedRoom; // Importing the BookedRoom model

class AdminDatewiseRoomController extends Controller
{
    // Method to display the index view
    public function index()
    {
        // Return the view for displaying datewise rooms
        return view('admin.datewise_rooms');
    }

    // Method to handle displaying datewise room details
    public function show(Request $request) 
    {
        // Validate the incoming request
        $request->validate([
            'selected_date' => 'required' // Ensure selected_date is provided
        ]);

        // Retrieve the selected date from the request
        $selected_date = $request->selected_date;

        // Return the view for displaying datewise room details, passing the selected_date
        return view('admin.datewise_rooms_detail', compact('selected_date'));
    }
}
