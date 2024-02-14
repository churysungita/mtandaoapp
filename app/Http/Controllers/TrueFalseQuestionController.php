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
use App\Models\TrueFalseQuestion; 
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;


class TrueFalseQuestionController extends Controller
{


public function index()
{
    
    $subtopics = Subtopic::all();
    $darasa = ClassLevel::all();
    $topics = Topic::all();
    $subjects = Subject::all();
    $trueFalseQuestions = TrueFalseQuestion::all();

    return view('admin.true_false_qns.index', compact('trueFalseQuestions','subjects', 'topics', 'subtopics'));
}

public function create()
{   

    $subtopics = Subtopic::all();
    $darasa = ClassLevel::all();
    $topics = Topic::all();
    $subjects = Subject::all();
    $trueFalseQuestions = TrueFalseQuestion::all();
    return view('admin.true_false_qns.create', compact('trueFalseQuestions','subjects', 'topics', 'subtopics'));
}

public function store(Request $request)
{
    $request->validate([
        'subject_id' => 'required',
        'topic_id' => 'nullable',
        'subtopic_id' => 'nullable',
        'question_text' => 'required',
        'marks' => 'required|integer|min:1',
        'correct_answer' => 'required|in:true,false', // Validate that correct_answer is either "true" or "false"
    ]);

    // Create a new True/False question
    TrueFalseQuestion::create([
        'subject_id' => $request->subject_id,
        'topic_id' => $request->topic_id,
        'subtopic_id' => $request->subtopic_id,
        'question_text' => $request->question_text,
        'marks' => $request->marks,
        'correct_answer' => $request->correct_answer,
    ]);

    return redirect()->route('admin.true_false_qns.index')->with('success', 'True/False question created successfully');
}


public function edit(TrueFalseQuestion $trueFalseQuestion)
{
    return view('admin.true_false_qns.edit', compact('trueFalseQuestion'));
}

public function update(Request $request, TrueFalseQuestion $trueFalseQuestion)
{
    $request->validate([
        'subject_id' => 'required',
        'topic_id' => 'nullable',
        'subtopic_id' => 'nullable',
        'question_text' => 'required',
        'marks' => 'required|integer|min:1',
        'correct_answer' => 'required|in:true,false', // Validate that correct_answer is either "true" or "false"
    ]);

    // Update the True/False question
    $trueFalseQuestion->update([
        'subject_id' => $request->subject_id,
        'topic_id' => $request->topic_id,
        'subtopic_id' => $request->subtopic_id,
        'question_text' => $request->question_text,
        'marks' => $request->marks,
        'correct_answer' => $request->correct_answer,
    ]);

    return redirect()->route('admin.true_false_qns.index')->with('success', 'True/False question updated successfully');
}

public function destroy(TrueFalseQuestion $trueFalseQuestion)
{
    $trueFalseQuestion->delete();

    return redirect()->route('admin.true_false_qns.index')->with('delete', 'True/False question deleted successfully');
}

}
