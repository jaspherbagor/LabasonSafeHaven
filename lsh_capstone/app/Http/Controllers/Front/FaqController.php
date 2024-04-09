<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of frequently asked questions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all FAQs
        $faq_all = Faq::get();

        // Return the view with FAQ data
        return view('front.faq', compact('faq_all'));
    }
}
