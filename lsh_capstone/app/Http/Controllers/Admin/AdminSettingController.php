<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    // Method to display the settings
    public function index()
    {
        $setting_data = Setting::where('id',1)->first();
        return view('admin.setting', compact('setting_data'));
    }

    // Method to update the settings
    public function update(Request $request)
    {
        // Retrieve the setting object
        $obj = Setting::where('id',1)->first();

        // Handle the logo update if a new one is uploaded
        if($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,gif,webp,svg|max:5120'
            ]);
            unlink('uploads/'.$obj->logo);
            $ext = $request->file('logo')->extension();
            $final_name = time().'.'.$ext;
            $request->file('logo')->move('uploads/',$final_name);
            $obj->logo = $final_name;
        }

        // Handle the favicon update if a new one is uploaded
        if($request->hasFile('favicon')) {
            $request->validate([
                'favicon' => 'image|mimes:jpg,jpeg,png,gif,webp,svg|max:5120'
            ]);
            unlink('uploads/'.$obj->favicon);
            $ext = $request->file('favicon')->extension();
            $final_name = time().'.'.$ext;
            $request->file('favicon')->move('uploads/',$final_name);
            $obj->favicon = $final_name;
        }

        // Update the remaining settings
        $obj->top_bar_phone = $request->top_bar_phone;
        $obj->top_bar_email = $request->top_bar_email;
        $obj->home_feature_status = $request->home_feature_status;
        $obj->home_room_total = $request->home_room_total;
        $obj->home_room_status = $request->home_room_status;
        $obj->home_testimonial_status = $request->home_testimonial_status;
        $obj->home_latest_post_total = $request->home_latest_post_total;
        $obj->home_latest_post_status = $request->home_latest_post_status;
        $obj->footer_address = $request->footer_address;
        $obj->footer_phone = $request->footer_phone;
        $obj->footer_email = $request->footer_email;
        $obj->copyright = $request->copyright;
        $obj->facebook = $request->facebook;
        $obj->twitter = $request->twitter;
        $obj->linkedin = $request->linkedin;
        $obj->pinterest = $request->pinterest;
        $obj->analytic_id = $request->analytic_id;
        $obj->theme_color_1 = $request->theme_color_1;
        $obj->theme_color_2 = $request->theme_color_2;
        $obj->update();

        return redirect()->back()->with('success', 'Setting is updated successfully.');
    }
}
