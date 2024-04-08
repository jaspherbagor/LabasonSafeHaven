<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomPhoto;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    // Method to display all rooms
    public function index()
    {
        $rooms = Room::get();
        return view('admin.room_view', compact('rooms'));
    }

    // Method to display the form for adding a new room
    public function add()
    {
        $all_amenities = Amenity::get();
        return view('admin.room_add',compact('all_amenities'));
    }

    // Method to store a new room
    public function store(Request $request)
    {
        // Initialize an empty string to store amenities
        $amenities = '';
        $i=0;
        // Concatenate selected amenities into a comma-separated string
        if(isset($request->arr_amenities)) {
            foreach($request->arr_amenities as $item) {
                if($i==0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ','.$item;
                }            
                $i++;
            }
        }

        // Validate the incoming request
        $request->validate([
            'featured_photo' => 'required|image|mimes:jpg,jpeg,png,gif',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'total_rooms' => 'required'
        ]);

        // Handle the uploaded featured photo
        $ext = $request->file('featured_photo')->extension();
        $final_name = time().'.'.$ext;
        $request->file('featured_photo')->move(public_path('uploads/'),$final_name);

        // Create a new room object and save it
        $obj = new Room();
        $obj->featured_photo = $final_name;
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->total_rooms = $request->total_rooms;
        $obj->amenities = $amenities;
        $obj->size = $request->size;
        $obj->total_beds = $request->total_beds;
        $obj->total_bathrooms = $request->total_bathrooms;
        $obj->total_balconies = $request->total_balconies;
        $obj->total_guests = $request->total_guests;
        $obj->video_id = $request->video_id;
        $obj->save();

        return redirect()->back()->with('success', 'Room is added successfully.');

    }

    // Method to display the form for editing a room
    public function edit($id)
    {
        $all_amenities = Amenity::get();
        $room_data = Room::where('id',$id)->first();

        $existing_amenities = array();
        if($room_data->amenities != '') {
            $existing_amenities = explode(',',$room_data->amenities);
        }
        return view('admin.room_edit', compact('room_data','all_amenities','existing_amenities'));
    }

    // Method to update a room
    public function update(Request $request,$id) 
    {        
        $obj = Room::where('id',$id)->first();

        // Initialize an empty string to store amenities
        $amenities = '';
        $i=0;
        // Concatenate selected amenities into a comma-separated string
        if(isset($request->arr_amenities)) {
            foreach($request->arr_amenities as $item) {
                if($i==0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ','.$item;
                }            
                $i++;
            }
        }

        // Validate the incoming request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'total_rooms' => 'required'
        ]);

        // Handle the featured photo update if a new one is uploaded
        if($request->hasFile('featured_photo')) {
            $request->validate([
                'featured_photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            unlink(public_path('uploads/'.$obj->featured_photo));
            $ext = $request->file('featured_photo')->extension();
            $final_name = time().'.'.$ext;
            $request->file('featured_photo')->move(public_path('uploads/'),$final_name);
            $obj->featured_photo = $final_name;
        }

        // Update the room's data
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->total_rooms = $request->total_rooms;
        $obj->amenities = $amenities;
        $obj->size = $request->size;
        $obj->total_beds = $request->total_beds;
        $obj->total_bathrooms = $request->total_bathrooms;
        $obj->total_balconies = $request->total_balconies;
        $obj->total_guests = $request->total_guests;
        $obj->video_id = $request->video_id;
        $obj->update();

        return redirect()->back()->with('success', 'Room is updated successfully.');
    }

    // Method to delete a room
    public function delete($id)
    {
        // Retrieve the room data and delete the featured photo
        $single_data = Room::where('id',$id)->first();
        unlink(public_path('uploads/'.$single_data->featured_photo));
        $single_data->delete();

        // Delete all room photos associated with the room
        $room_photo_data = RoomPhoto::where('room_id',$id)->get();
        foreach($room_photo_data as $item) {
            unlink(public_path('uploads/'.$item->photo));
            $item->delete();
        }

        return redirect()->back()->with('success', 'Room is deleted successfully.');
    }

    // Method to display the room gallery
    public function gallery($id)
    {
        $room_data = Room::where('id',$id)->first();
        $room_photos = RoomPhoto::where('room_id',$id)->get();
        return view('admin.room_gallery', compact('room_data','room_photos'));
    }

    // Method to add a photo to the room gallery
    public function gallery_store(Request $request,$id)
    {
        // Validate the incoming request
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        // Handle the uploaded photo
        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;
        $request->file('photo')->move(public_path('uploads/'),$final_name);

        // Create a new room photo object and save it
        $obj = new RoomPhoto();
        $obj->photo = $final_name;
        $obj->room_id = $id;
        $obj->save();

        return redirect()->back()->with('success', 'Photo is added successfully.');
    }

    // Method to delete a photo from the room gallery
    public function gallery_delete($id)
    {
        // Retrieve the room photo data, delete the photo, and then delete the record
        $single_data = RoomPhoto::where('id',$id)->first();
        unlink(public_path('uploads/'.$single_data->photo));
        $single_data->delete();

        return redirect()->back()->with('success', 'Photo is deleted successfully.');
    }
}
