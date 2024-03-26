<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function index()
    {
        $rooms = Room::get();
        return view('admin.room_view', compact('rooms'));
    }

    // public function add()
    // {
    //     return view('admin.slide_add');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120'
    //     ]);

        

    //     $ext = $request->file('photo')->extension();
    //     $final_name = time().'.'.$ext;

    //     $request->file('photo')->move(public_path('uploads/'),$final_name);

    //     $obj = new Slide();
    //     $obj->photo = $final_name;
    //     $obj->heading = $request->heading;
    //     $obj->text = $request->text;
    //     $obj->button_text = $request->button_text;
    //     $obj->button_url = $request->button_url;
    //     $obj->save();

    //     return redirect()->back()->with('success', 'Slide is added successfully!');
    // }

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
