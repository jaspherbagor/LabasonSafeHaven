<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * Display the privacy policy page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve the privacy data from the database
        $privacy_data = Page::where('id', 1)->first();

        // Return the view with privacy data
        return view('front.privacy', compact('privacy_data'));
    }
}
