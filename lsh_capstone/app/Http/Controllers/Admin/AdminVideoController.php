<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    public function index()
    {
        $videos = Video::get();
        return view('admin.video_view', compact('videos'));
    }

    public function add()
    {
        return view('admin.video_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120'
        ]);

        

        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;

        $request->file('photo')->move(public_path('uploads/'),$final_name);

        $obj = new Video();
        $obj->photo = $final_name;
        $obj->caption = $request->caption;
        $obj->save();

        return redirect()->back()->with('success', 'Photo is added successfully!');
    }

    public function edit($id)
    {
        $photo_data = Video::where('id',$id)->first();
        return view('admin.photo_edit', compact('photo_data'));
    }

    public function update(Request $request, $id)
    {
        $obj = Video::where('id', $id)->first();

        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120',
            ]);

            unlink(public_path('uploads/'.$obj->photo));

            $ext = $request->file('photo')->extension();
            $final_name = time().'.'.$ext;

            $request->file('photo')->move(public_path('uploads/'),$final_name);


            $obj->photo = $final_name;           
        }

        $obj->caption = $request->caption;
        $obj->update();

        return redirect()->back()->with('success', 'Photo is updated successfully!');
        
    }

    public function delete($id)
    {
        $single_data = Video::where('id', $id)->first();
        unlink(public_path('uploads/'.$single_data->photo));
        $single_data->delete();

        return redirect()->back()->with('success', 'Photo is deleted successfully!');
    }
}
