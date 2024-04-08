<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    // Method to display all FAQs
    public function index()
    {
        // Fetch all FAQs from the database
        $faqs = Faq::get();
        // Return a view with the fetched FAQs data
        return view('admin.faq_view', compact('faqs'));
    }

    // Method to display add FAQ form
    public function add()
    {
        // Return the add FAQ form view
        return view('admin.faq_add');
    }

    // Method to store a newly created FAQ
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        // Create a new Faq instance
        $obj = new Faq();
        // Set the question and answer attributes from the request
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        // Save the FAQ to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'FAQ is added successfully!');
    }

    // Method to display edit FAQ form
    public function edit($id)
    {
        // Fetch the FAQ data by ID
        $faq_data = Faq::where('id',$id)->first();
        // Return the edit FAQ form view with the fetched data
        return view('admin.faq_edit', compact('faq_data'));
    }

    // Method to update an existing FAQ
    public function update(Request $request, $id)
    {
        // Fetch the FAQ by ID
        $obj = Faq::where('id', $id)->first();

        // Update the question and answer attributes from the request
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        // Save the updated FAQ
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'FAQ is updated successfully!');
        
    }

    // Method to delete an existing FAQ
    public function delete($id)
    {
        // Fetch the FAQ by ID
        $single_data = Faq::where('id', $id)->first();
        // Delete the fetched FAQ
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'FAQ is deleted successfully!');
    }
}
