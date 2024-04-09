<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Display the terms page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve terms data from the database
        $terms_data = Page::where('id', 1)->first();
        
        // Return the view with terms data
        return view('front.terms', compact('terms_data'));
    }
}
