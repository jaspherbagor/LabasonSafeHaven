<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the photos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve paginated photos
        $photo_all = Photo::paginate(12);

        // Return the view with photo data
        return view('front.photo_gallery', compact('photo_all'));
    }
}
