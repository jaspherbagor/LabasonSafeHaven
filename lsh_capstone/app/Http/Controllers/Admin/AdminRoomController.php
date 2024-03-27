<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function index()
    {
        $rooms = Room::get();
        return view('admin.room_view', compact('rooms'));
    }

    public function add()
    {
        $all_amenities = Amenity::get();
        return view('admin.room_add', compact('all_amenities'));
    }

    public function store(Request $request)
    {

        $amenities = '';
        $i = 0;
        if(isset($request->arr_amenties)) {
            foreach($request ->arr_amenities as $item) {
                if($i === 0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ',' .$item;
                }
                $i++;
            }
        }

        $request->validate([
            'featured_photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'total_rooms' => 'required'
        ]);

        

        $ext = $request->file('featured_photo')->extension();
        $final_name = time().'.'.$ext;

        $request->file('featured_photo')->move(public_path('uploads/'),$final_name);

        $obj = new Room();
        $obj->featured_photo = $final_name;
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->total_rooms = $request->total_rooms;
        $obj->arr_amenties = $request->arr_amenties;
        $obj->size = $request->size;
        $obj->total_beds = $request->total_beds;
        $obj->total_bathrooms = $request->total_bathrooms;
        $obj->total_balconies = $request->total_balconies;
        $obj->total_guests = $request->total_guests;
        $obj->video_id = $request->video_id;
        $obj->save();

        return redirect()->back()->with('success', 'Room is added successfully!');
    }

    // public function edit($id)
    // {
    //     $slide_data = Slide::where('id',$id)->first();
    //     return view('admin.slide_edit', compact('slide_data'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $obj = Slide::where('id', $id)->first();

    //     if($request->hasFile('photo')) {
    //         $request->validate([
    //             'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120',
    //         ]);

    //         unlink(public_path('uploads/'.$obj->photo));

    //         $ext = $request->file('photo')->extension();
    //         $final_name = time().'.'.$ext;

    //         $request->file('photo')->move(public_path('uploads/'),$final_name);


    //         $obj->photo = $final_name;           
    //     }

    //     $obj->heading = $request->heading;
    //     $obj->text = $request->text;
    //     $obj->button_text = $request->button_text;
    //     $obj->button_url = $request->button_url;
    //     $obj->update();

    //     return redirect()->back()->with('success', 'Slide is updated successfully!');
        
    // }

    // public function delete($id)
    // {
    //     $single_data = Slide::where('id', $id)->first();
    //     unlink(public_path('uploads/'.$single_data->photo));
    //     $single_data->delete();

    //     return redirect()->back()->with('success', 'Slide is deleted successfully!');
    // }
}
