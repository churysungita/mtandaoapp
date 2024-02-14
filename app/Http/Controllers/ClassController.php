<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\ClassLevel;
use App\Models\Topic;
use App\Models\ContentMaterial;
use App\Models\Subtopic;
use App\Models\Subject;
use Yajra\DataTables\DataTables;

class ClassController extends Controller
{
    //
    public function index()
    {
        // Retrieve all classes from the database
        $darasa = ClassLevel::all();

        // Return the view with the list of classes
        return view('admin.classes.index', compact('darasa'));
    }

    public function create()
    {
        // Show the form to create a new class
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'class_name' => 'required|unique:darasa|max:255', // Make sure the class_name is unique
            // Add any other validation rules or fields as needed
        ]);
    
        // Create a new class instance and store it in the database
        $darasa = new ClassLevel();
        $darasa->class_name = $validatedData['class_name'];
        // Add any other fields as needed
    
        // Save the class instance to the database
        $darasa->save();

          // Flash a success message
        session()->flash('success', 'Class created successfully.');
    
        // Redirect to the index page with a success message
        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully');
    }
    

    public function show(ClassLevel $darasa)
    {   
        // Show the details of a specific class
    
        return view('admin.classes.show', compact('darasa'));
    }

     public function edit(ClassLevel $darasa)
    {
        // Show the form to edit a specific class
        return view('admin.classes.edit', compact('darasa'));
    }

   

   

        public function update(Request $request, ClassLevel $darasa)
    {
        // Validate the request data
        $request->validate([
            'class_name' => 'required|string|max:255|unique:darasa,class_name,' . $darasa->id, // Check uniqueness except for the current record
        ]);

        // Update the class details
        $darasa->update([
            'class_name' => $request->input('class_name'),
        ]);

        // Redirect to the index page or show a success message
        return redirect()->route('admin.classes.index')->with('success', 'Class updated successfully');
    }








        public function destroy(ClassLevel $darasa)
    {
        // Delete the specific class from the database
        $darasa->delete();

        // Redirect to the index page or show a success message
        return redirect()->route('admin.classes.index')->with('success', 'Class deleted successfully');
    }


    
}
