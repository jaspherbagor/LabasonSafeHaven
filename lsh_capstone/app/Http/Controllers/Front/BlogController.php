<?php

namespace App\Http\Controllers\Front; // Namespace declaration

use App\Http\Controllers\Controller; // Import the base controller class
use App\Models\Post; // Import the Post model
use Illuminate\Http\Request; // Import the Request class

class BlogController extends Controller // Define the BlogController class, extending the base controller
{
    public function index() // Define the index method to display the blog page
    {
        // Retrieve all posts from the database, ordered by ID in descending order and paginated
        $post_all = Post::orderBy('id', 'desc')->paginate(9); 
        
        // Return the view for the blog page, passing the retrieved posts to the view
        return view('front.blog', compact('post_all')); 
    }

    public function single_post($id) // Define the single_post method to display a single post
    {
        // Retrieve the data of the single post from the database
        $single_post_data = Post::where('id', $id)->first(); 
        
        // Increment the total view count of the single post
        $single_post_data->total_view = $single_post_data->total_view + 1;
        $single_post_data->update(); // Update the post data in the database
        
        // Return the view for the single post, passing the retrieved single post data to the view
        return view('front.post', compact('single_post_data')); 
    }
}
