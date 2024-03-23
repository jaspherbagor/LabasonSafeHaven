<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AdminAboutController extends Controller
{
    public function about()
    {
        $about_data = About::where('id',1)->first();
        return view('admin.about_page', compact('about_data'));
    }

    public function about_update(Request $request)
    {
        $obj = About::where('id',1)->first();


        $obj->about_heading = $request->about_heading;
        $obj->about_content = $request->about_content;
        $obj->update();

        return redirect()->back()->with('success', 'About page is updated successfully!');
    }
}
