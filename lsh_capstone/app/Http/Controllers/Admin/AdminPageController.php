<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    // Method to display the about page and update its data
    public function about()
    {
        // Fetch about page data from the database
        $about_data = Page::where('id', 1)->first();
        // Return the about page view with the fetched data
        return view('admin.about_page', compact('about_data'));
    }

    public function about_update(Request $request)
    {
        // Fetch the about page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the about page fields with the submitted data
        $obj->about_heading = $request->about_heading;
        $obj->about_content = $request->about_content;
        $obj->about_status = $request->about_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'About page is updated successfully!');
    }

    // Method to display the terms page and update its data
    public function terms()
    {
        // Fetch terms page data from the database
        $terms_data = Page::where('id', 1)->first();
        // Return the terms page view with the fetched data
        return view('admin.terms_page', compact('terms_data'));
    }

    public function terms_update(Request $request)
    {
        // Fetch the terms page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the terms page fields with the submitted data
        $obj->terms_heading = $request->terms_heading;
        $obj->terms_content = $request->terms_content;
        $obj->terms_status = $request->terms_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Terms page is updated successfully!');
    }


    // Method to display the privacy page and update its data
    public function privacy()
    {
        // Fetch privacy page data from the database
        $privacy_data = Page::where('id', 1)->first();
        // Return the privacy page view with the fetched data
        return view('admin.privacy_page', compact('privacy_data'));
    }

    public function privacy_update(Request $request)
    {
        // Fetch the privacy page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the privacy page fields with the submitted data
        $obj->privacy_heading = $request->privacy_heading;
        $obj->privacy_content = $request->privacy_content;
        $obj->privacy_status = $request->privacy_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Privacy page is updated successfully!');
    }

    // Method to display the room page and update its data
    public function room()
    {
        // Fetch room page data from the database
        $room_data = Page::where('id', 1)->first();
        // Return the room page view with the fetched data
        return view('admin.room_page', compact('room_data'));
    }

    public function room_update(Request $request)
    {
        // Fetch the room page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the room page fields with the submitted data
        $obj->room_heading = $request->room_heading;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Room page is updated successfully!');
    }

    // Method to display the contact page and update its data
    public function contact()
    {
        // Fetch contact page data from the database
        $contact_data = Page::where('id', 1)->first();
        // Return the contact page view with the fetched data
        return view('admin.contact_page', compact('contact_data'));
    }

    public function contact_update(Request $request)
    {
        // Fetch the contact page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the contact page fields with the submitted data
        $obj->contact_heading = $request->contact_heading;
        $obj->contact_map = $request->contact_map;
        $obj->contact_status = $request->contact_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Contact page is updated successfully!');
    }

    // Method to display the photo gallery page and update its data
    public function photo_gallery()
    {
        // Fetch photo gallery page data from the database
        $photo_gallery_data = Page::where('id', 1)->first();
        // Return the photo gallery page view with the fetched data
        return view('admin.photo_gallery_page', compact('photo_gallery_data'));
    }

    public function photo_gallery_update(Request $request)
    {
        // Fetch the photo gallery page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the photo gallery page fields with the submitted data
        $obj->photo_gallery_heading = $request->photo_gallery_heading;
        $obj->photo_gallery_status = $request->photo_gallery_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Photo gallery page is updated successfully!');
    }

    // Method to display the video gallery page and update its data
    public function video_gallery()
    {
        // Fetch video gallery page data from the database
        $video_gallery_data = Page::where('id', 1)->first();
        // Return the video gallery page view with the fetched data
        return view('admin.video_gallery_page', compact('video_gallery_data'));
    }

    public function video_gallery_update(Request $request)
    {
        // Fetch the video gallery page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the video gallery page fields with the submitted data
        $obj->video_gallery_heading = $request->video_gallery_heading;
        $obj->video_gallery_status = $request->video_gallery_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Video gallery page is updated successfully!');
    }

    // Method to display the FAQ page and update its data
    public function faq()
    {
        // Fetch FAQ page data from the database
        $faq_data = Page::where('id', 1)->first();
        // Return the FAQ page view with the fetched data
        return view('admin.faq_page', compact('faq_data'));
    }

    public function faq_update(Request $request)
    {
        // Fetch the FAQ page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the FAQ page fields with the submitted data
        $obj->faq_heading = $request->faq_heading;
        $obj->faq_status = $request->faq_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'FAQ page is updated successfully!');
    }

    // Method to display the blog page and update its data
    public function blog()
    {
        // Fetch blog page data from the database
        $blog_data = Page::where('id', 1)->first();
        // Return the blog page view with the fetched data
        return view('admin.blog_page', compact('blog_data'));
    }

    public function blog_update(Request $request)
    {
        // Fetch the blog page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the blog page fields with the submitted data
        $obj->blog_heading = $request->blog_heading;
        $obj->blog_status = $request->blog_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Blog page is updated successfully!');
    }

    // Method to display the cart page and update its data
    public function cart()
    {
        // Fetch cart page data from the database
        $cart_data = Page::where('id', 1)->first();
        // Return the cart page view with the fetched data
        return view('admin.cart_page', compact('cart_data'));
    }

    public function cart_update(Request $request)
    {
        // Fetch the cart page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the cart page fields with the submitted data
        $obj->cart_heading = $request->cart_heading;
        $obj->cart_status = $request->cart_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Cart page is updated successfully!');
    }

    // Method to display the checkout page and update its data
    public function checkout()
    {
        // Fetch checkout page data from the database
        $checkout_data = Page::where('id', 1)->first();
        // Return the checkout page view with the fetched data
        return view('admin.checkout_page', compact('checkout_data'));
    }

    public function checkout_update(Request $request)
    {
        // Fetch the checkout page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the checkout page fields with the submitted data
        $obj->checkout_heading = $request->checkout_heading;
        $obj->checkout_status = $request->checkout_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Checkout page is updated successfully!');
    }

    // Method to display the payment page and update its data
    public function payment()
    {
        // Fetch payment page data from the database
        $payment_data = Page::where('id', 1)->first();
        // Return the payment page view with the fetched data
        return view('admin.payment_page', compact('payment_data'));
    }

    public function payment_update(Request $request)
    {
        // Fetch the payment page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the payment page fields with the submitted data
        $obj->payment_heading = $request->payment_heading;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Payment page is updated successfully!');
    }

    // Method to display the sign in page and update its data
    public function signin()
    {
        // Fetch sign in page data from the database
        $signin_data = Page::where('id', 1)->first();
        // Return the sign in page view with the fetched data
        return view('admin.signin_page', compact('signin_data'));
    }

    public function signin_update(Request $request)
    {
        // Fetch the sign in page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the sign in page fields with the submitted data
        $obj->signin_heading = $request->signin_heading;
        $obj->signin_status = $request->signin_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Sign in page is updated successfully!');
    }

    // Method to display the sign up page and update its data
    public function signup()
    {
        // Fetch sign up page data from the database
        $signup_data = Page::where('id', 1)->first();
        // Return the sign up page view with the fetched data
        return view('admin.signup_page', compact('signup_data'));
    }

    public function signup_update(Request $request)
    {
        // Fetch the sign up page data from the database
        $obj = Page::where('id', 1)->first();

        // Update the sign up page fields with the submitted data
        $obj->signup_heading = $request->signup_heading;
        $obj->signup_status = $request->signup_status;
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Sign up page is updated successfully!');
    }
}