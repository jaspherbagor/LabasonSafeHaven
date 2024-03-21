<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $post_all = Post::orderBy('id', 'desc')->paginate(9);
        return view('front.blog',compact('post_all'));
    }
}
