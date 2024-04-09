<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Post;
use App\Models\Room;
use App\Models\Slide;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all testimonials
        $testimonial_all = Testimonial::get();

        // Retrieve all slides
        $slide_all = Slide::get();

        // Retrieve all features
        $feature_all = Feature::get();

        // Retrieve the latest 3 posts
        $post_all = Post::orderBy('id', 'desc')->limit(3)->get();

        // Retrieve all rooms
        $room_all = Room::get();

        // Return the view with data
        return view('front.home', compact('slide_all', 'feature_all', 'testimonial_all', 'post_all', 'room_all'));
    }
}
