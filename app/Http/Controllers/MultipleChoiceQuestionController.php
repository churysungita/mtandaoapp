<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MultipleChoiceQuestion;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\ClassLevel;
use App\Models\Topic;
use App\Models\Image;
use App\Models\ContentMaterial;
use App\Models\Subtopic;
use App\Models\Subject;
use App\Models\Post;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;


class MultipleChoiceQuestionController extends Controller
{   

    public function index()
{
    $multipleChoiceQuestions = MultipleChoiceQuestion::all();
 
    $subtopics = Subtopic::all();
    $darasa = ClassLevel::all();
    $topics = Topic::all();
    $subjects = Subject::all();

    return view('admin.multiple_choices.index', compact('multipleChoiceQuestions','subjects', 'topics', 'subtopics'));
}

    public function create()
    {
        // You might want to retrieve subjects and other necessary data here
        $subjects = Subject::all();
        
        return view('admin.multiple_choices.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'topic_id' => 'nullable',
            'subtopic_id' => 'nullable',
            'question_text' => 'required',
            'marks' => 'required|integer|min:1', // Validate that marks is an integer and greater than or equal to 1
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'option_e' => 'nullable',
            'correct_answer' => 'required|in:option_a,option_b,option_c,option_d,option_e', // Validate that correct_answer is one of the specified options
        ]);

        // Create a new multiple-choice question
        MultipleChoiceQuestion::create([
            'subject_id' => $request->subject_id,
            'topic_id' => $request->topic_id,
            'subtopic_id' => $request->subtopic_id,
            'question_text' => $request->question_text,
            'marks' => $request->marks,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'option_e' => $request->option_e,
            'correct_answer' => $request->correct_answer,
        ]);

        return redirect()->route('admin.multiple_choices.index')->with('success', 'Multiple-choice question created successfully');
    }

    public function destroy($id)
{
    // Find the question by its ID
    $question = MultipleChoiceQuestion::find($id);

    // Check if the question exists
    if (!$question) {
        return redirect()->route('admin.multiple_choices.index')->with('error', 'Question not found.');
    }

    // Delete the question
    $question->delete();

    return redirect()->route('admin.multiple_choices.index')->with('delete', 'Question deleted successfully');
}

}
