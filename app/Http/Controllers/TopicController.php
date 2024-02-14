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

class TopicController extends Controller
{
    //
    public function index()
    {
        $topics = Topic::all();
        return view('admin.class_topics.index', compact('topics'));
    }

    
    public function create()
    {
        // Retrieve a list of subjects to pass to the view
        $subjects = Subject::all();

        return view('admin.class_topics.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        // Validate and store the new topic
         // Validate the request data
         $request->validate([
            'topic_name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id', // Ensure subject_id exists in the subjects table
        ]);

        // Create a new topic instance with the provided data
        $topics = new Topic([
            'topic_name' => $request->input('topic_name'),
            'subject_id' => $request->input('subject_id'),
        ]);

        // Save the new topic record to the database
        $topics->save();
          // Flash a success message
        session()->flash('success', 'Subject created successfully.');

        // Redirect back to the index page or a success page
        return redirect()->route('admin.class_topics.index');
        // ...

    
    }

    public function show(Topic $topic)
    {   
        // Show the details of a specific class
    
        return view('admin.class_topics.show', compact('topic'));
    }

    public function edit(Topic $topic)

    {    // Retrieve a list of subjects to pass to the view
        $subjects = Subject::all();
      
        return view('admin.class_topics.edit', compact('topic','subjects'));
    }

    public function update(Request $request, Topic $topics)
    {
        // Validate and update the topic
        // ...

        return redirect()->route('admin.class_topics.index')->with('success', 'Topic updated successfully');;
    }

    public function destroy(Topic $topics)
    {
        // Delete the topic
        // ...
           // Delete the specific class from the database
        $topics->delete();

        return redirect()->route('admin.class_topics.index')->with('success', 'Topic deleted successfully');;
    }
}
