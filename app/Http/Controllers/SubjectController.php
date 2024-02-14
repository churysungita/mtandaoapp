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

class SubjectController extends Controller
{
    //
     //
     public function index()
     {
         // Retrieve all subjects from the database
         $subjects = Subject::all();
         $darasa = ClassLevel::all();
 
         // Return the view with the list of classes
         return view('admin.subjects.index', compact('subjects','darasa'));
     }
 
     public function create()
     {
         // Show the form to create a new class
         $darasa = ClassLevel::all();
         return view('admin.subjects.create',compact('darasa'));
     }
 
     public function store(Request $request)
     {
        
            // Validate the form data
        $validatedData = $request->validate([
            'subject_name' => [
                'required',
                'max:255',
                Rule::unique('subjects', 'subject_name')->where(function ($query) use ($request) {
                    return $query->where('class_name_id', $request->input('class_name_id'));
                }),
            ],
            'class_name_id' => 'required|exists:darasa,id',
            // Add any other validation rules or fields as needed
        ]);



     
         // Create a new subject instance and store it in the database
         $subject = new Subject();
         $darasa = ClassLevel::all();
         $subject->subject_name = $validatedData['subject_name'];
         $subject->class_name_id = $validatedData['class_name_id']; // Assign the selected class ID
         // Add any other fields as needed
     
         // Save the subject instance to the database
         $subject->save();
     
         // Flash a success message
         session()->flash('success', 'Subject created successfully.');
     
         // Redirect to the index page with a success message
         return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully');
     }
     
     
 
     public function show(Subject $subject)
     {   

         // Show the details of a specific class
     
         return view('admin.subjects.show', compact('subject'));
     }
 
     public function edit(Subject $subject)
     
     {  
        $darasa = ClassLevel::all();
        $subjects = Subject::all();
         // Show the form to edit a specific subject
         return view('admin.subjects.edit', compact('subject','darasa'));
     }
     
    public function update(Request $request, Subject $subject)
{
    // Validate the request data
    $validatedData = $request->validate([
        'subject_name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('subjects', 'subject_name')
                ->where('class_name_id', $request->input('class_name_id'))
                ->ignore($subject->id), // Ignore the current subject's ID
        ],
        'class_name_id' => 'required|exists:darasa,id',
        // Add any other validation rules or fields as needed
    ]);

    // Update the subject details
    $subject->subject_name = $validatedData['subject_name'];
    $subject->class_name_id = $validatedData['class_name_id'];
    // Update any other fields as needed

    // Save the updated subject to the database
    $subject->save();

    // Redirect to the index page or show a success message
    return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully');
}

     

 
         public function destroy(Subject $subject)
     {
         // Delete the specific class from the database
         $subject->delete();
 
         // Redirect to the index page or show a success message
         return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully');
     }
 
}
