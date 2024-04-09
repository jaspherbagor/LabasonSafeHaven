<?php

namespace App\Http\Controllers\Front; // Namespace declaration

use App\Http\Controllers\Controller; // Import the base controller class
use App\Models\Page; // Import the Page model
use Illuminate\Http\Request; // Import the Request class

class AboutController extends Controller // Define the AboutController class, extending the base controller
{
    public function index() // Define the index method to display the about page
    {
        // Retrieve the about page data from the database
        $about_data = Page::where('id', 1)->first(); 
        
        // Return the view for the about page, passing the about page data to the view
        return view('front.about', compact('about_data')); 
    }
}
