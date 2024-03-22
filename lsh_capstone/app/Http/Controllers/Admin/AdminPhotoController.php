<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class AdminPhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::get();
        return view('admin.photo_view', compact('photos'));
    }

    public function add()
    {
        return view('admin.post_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120',
            'heading' => 'required',
            'short_content' => 'required',
            'content' => 'required'
        ]);

        

        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;

        $request->file('photo')->move(public_path('uploads/'),$final_name);

        $obj = new Photo();
        $obj->photo = $final_name;
        $obj->heading = $request->heading;
        $obj->short_content = $request->short_content;
        $obj->content = $request->content;
        $obj->total_view = 1;
        $obj->save();

        return redirect()->back()->with('success', 'Post is added successfully!');
    }

    public function edit($id)
    {
        $post_data = Photo::where('id',$id)->first();
        return view('admin.post_edit', compact('post_data'));
    }

    public function update(Request $request, $id)
    {
        $obj = Photo::where('id', $id)->first();

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

        $obj->heading = $request->heading;
        $obj->short_content = $request->short_content;
        $obj->content = $request->content;
        $obj->update();

        return redirect()->back()->with('success', 'Post is updated successfully!');
        
    }

    public function delete($id)
    {
        $single_data = Photo::where('id', $id)->first();
        unlink(public_path('uploads/'.$single_data->photo));
        $single_data->delete();

        return redirect()->back()->with('success', 'Post is deleted successfully!');
    }
}
