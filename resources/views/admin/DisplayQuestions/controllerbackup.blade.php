<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassLevel;
use App\Models\Topic;
use App\Models\Image;
use App\Models\ContentMaterial;
use App\Models\Subtopic;
use App\Models\Subject;
use App\Models\Post;
use App\Models\Question;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;

class QuestionsDisplayController extends Controller
{
    

public function index()
{
    $multipleChoiceQuestions = DB::table('multiple_choice_questions')
        ->select('question_text', 'marks', 'option_a', 'option_b', 'option_c', 'option_d', 'option_e', 'correct_answer')
        ->get();

    $trueFalseQuestions = DB::table('true_false_questions')
        ->select('question_text', 'marks', 'correct_answer')
        ->get();

    $longQuestions = DB::table('long_questions')
        ->select('question_text', 'marks', 'correct_answer')
        ->get();

    return view('admin.DisplayQuestions.index', compact('multipleChoiceQuestions', 'trueFalseQuestions', 'longQuestions'));
}


public function filter(Request $request)
{
    $filter = $request->input('filter');
    $questions = [];

    if ($filter === 'subjects') {
        // Filter by subjects
        $subjectId = $request->input('subject_id');
        $questions = MultipleChoiceQuestion::where('subject_id', $subjectId)->get();
    } elseif ($filter === 'topics') {
        // Filter by topics
        $topicId = $request->input('topic_id');
        $questions = MultipleChoiceQuestion::where('topic_id', $topicId)->get();
    } elseif ($filter === 'subtopics') {
        // Filter by subtopics
        $subtopicId = $request->input('subtopic_id');
        $questions = MultipleChoiceQuestion::where('subtopic_id', $subtopicId)->get();
    } elseif ($filter === 'multipleChoice') {
        // Filter for multiple choice questions
        $questions = MultipleChoiceQuestion::all();
    } elseif ($filter === 'trueFalse') {
        // Filter for true/false questions
        $questions = TrueFalseQuestion::all();
    } elseif ($filter === 'longQuestions') {
        // Filter for long questions
        $questions = LongQuestion::all();
    } elseif ($filter === 'all') {
        // Show all questions
        $questions = MultipleChoiceQuestion::all()->concat(TrueFalseQuestion::all())->concat(LongQuestion::all());
    }

    return view('admin.DisplayQuestions.filtered', compact('questions'));
}

}



     <div class="top-bar-card">
        <select id="subject-dropdown">
            <option value="">Select a subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
            @endforeach
        </select>
        <select id="topic-dropdown">
            <option value="">Select a topic</option>
            @foreach($topics as $topic)
                <option value="{{ $topic->id }}">{{ $topic->topic_name }}</option>
            @endforeach
        </select>
        <select id="subtopic-dropdown">
            <option value="">Select a subtopic</option>
            @foreach($subtopics as $subtopic)
                <option value="{{ $subtopic->id }}">{{ $subtopic->subtopic_name }}</option>
            @endforeach
        </select>
    </div> 

    <!-- Display questions here based on the selected filters -->
    <h2>Questions</h2>
    <div id="filtered-questions">
        <!-- Questions will be displayed here -->
           <div id="multiple-choice-questions">
    @include('admin.DisplayQuestions.multiple-choice-questions') 
</div>

<h2>True/False Questions</h2>
<div id="true-false-questions">
    @include('admin.DisplayQuestions.true-false-questions')
</div>

<h2>Long Questions</h2>
<div id="long-questions">
    @include('admin.DisplayQuestions.long-questions') 
</div>



    </div>

