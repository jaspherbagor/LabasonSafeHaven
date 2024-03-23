<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function about()
    {
        $about_data = Page::where('id',1)->first();
        return view('admin.about_page', compact('about_data'));
    }

    public function about_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->about_heading = $request->about_heading;
        $obj->about_content = $request->about_content;
        $obj->about_status = $request->about_status;
        $obj->update();

        return redirect()->back()->with('success', 'About page is updated successfully!');
    }

    public function terms()
    {
        $terms_data = Page::where('id',1)->first();
        return view('admin.terms_page', compact('terms_data'));
    }

    public function terms_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->terms_heading = $request->terms_heading;
        $obj->terms_content = $request->terms_content;
        $obj->terms_status = $request->terms_status;
        $obj->update();

        return redirect()->back()->with('success', 'Terms page is updated successfully!');
    }










    public function contact()
    {
        $contact_data = Page::where('id',1)->first();
        return view('admin.contact_page', compact('contact_data'));
    }

    public function contact_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->contact_heading = $request->contact_heading;
        $obj->contact_map = $request->contact_map;
        $obj->contact_status = $request->contact_status;
        $obj->update();

        return redirect()->back()->with('success', 'Contact page is updated successfully!');
    }
}
