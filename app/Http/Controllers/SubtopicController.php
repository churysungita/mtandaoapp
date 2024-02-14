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

class SubtopicController extends Controller
{
    //
    public function index()
    {
        $subtopics = Subtopic::all();
        $topics = Topic::all();
        $subject = Subject::all();
        return view('admin.class_subtopics.index', compact('subject','subtopics','topics'));
    }

    
    public function create()
    {
        // Retrieve a list of subjects to pass to the view
        $topics = Topic::all();
        $subjects = Subject::all();

        return view('admin.class_subtopics.create', compact('topics','subjects'))->with('success', 'Created successful.');;
    }

    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'subtopic_name' => 'required|string|max:255',
        'topic_id' => 'required|exists:topics,id',
        'subject_id' => 'required|exists:subjects,id',
    ]);

    // Create a new subtopic instance with the provided data
    $subtopic = new Subtopic([
        'subtopic_name' => $request->input('subtopic_name'),
        'topic_id' => $request->input('topic_id'),
        'subject_id' => $request->input('subject_id'),
    ]);

    // Save the new subtopic record to the database
    $subtopic->save();

    // Redirect back to the index page or a success page
    return redirect()->route('admin.class_subtopics.index')->with('success', 'Subtopic created successfully.');
}


    // public function store(Request $request)
    // {
    //     // Validate and store the new subtopic
    //      // Validate the request data
    //      $request->validate([
    //         'subtopic_name' => 'required|string|max:255',
    //         'topic_id' => 'required|exists:topics,id', //
    //         'subject_name' => 'required|string|max:255', // Add validation for subject_name
       
    //     ]);

    //     // Create a new topic instance with the provided data
    //     $subtopics = new Subtopic([
    //         'subtopic_name' => $request->input('subtopic_name'),
    //         'topic_id' => $request->input('topic_id'),
    //         'subject_id' => $request->input('subject_id'), // Store subject_name
    //     ]);

    //      // Create a new subject instance and store it in the database
     
    //      $subject->subject_id = $validatedData['subject_id'];
    //      $subject->class_name_id = $validatedData['class_name_id']; // Assign the selected class ID
    //      // Add any other fields as needed

    //     // Save the new topic record to the database
    //     $subtopics->save();

    //     // Redirect back to the index page or a success page
    //     return redirect()->route('admin.class_subtopics.index');
    //     // ...
    //         // Flash a success message
    //     session()->flash('success', 'Subject created successfully.');

    
    // }

    public function show(Subtopic $subtopic)
    {   
        // Show the details of a specific class
    
        return view('admin.class_subtopics.show', compact('subtopic'));
    }

    public function edit(Subtopic $subtopic)

    {    // Retrieve a list of subjects to pass to the view
        $topics = Topic::all();
        $subjects = Subject::all();
      
        return view('admin.class_subtopics.edit', compact('subtopic','subjects','topics'));
    }

  
        public function update(Request $request, Subtopic $subtopic)
    {
        // Validate and update the topic
        $request->validate([
            'subtopic_name' => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
        ]);

        // Update the Subtopic model with the new data
        $subtopic->subtopic_name = $request->input('subtopic_name');
        $subtopic->topic_id = $request->input('topic_id');
        $subtopic->save();

        // Redirect back to the index page or a success page
        return redirect()->route('admin.class_subtopics.index')->with('success', 'Updated successful.');;
    }

    public function destroy(Subtopic $subtopic)
    {
        // Delete the topic
        // ...
         // Delete the topic (you should implement your delete logic here)
        $subtopic->delete();

        return redirect()->route('admin.class_subtopics.index')->with('success', 'Deleted successful.');;
    }
}
