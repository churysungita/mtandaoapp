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
use App\Models\LongQuestion;

use App\Models\TrueFalseQuestion;
use App\Models\MultipleChoiceQuestion;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;

class QuestionsDisplayController extends Controller
{
    

    public function index(Request $request)
    {

        $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subjects = Subject::all();
        $longQuestions = LongQuestion::all();
        $trueFalseQuestions = TrueFalseQuestion::all();
        $multipleChoiceQuestions = MultipleChoiceQuestion::all();

         // Define the query for Multiple Choice Questions
         $multipleChoiceQuery = MultipleChoiceQuestion::query();
         // Retrieve unique subjects, topics, and subtopics from the LongQuestion model
         $subjects = LongQuestion::distinct()->pluck('subject_id');
         $topics = LongQuestion::distinct()->pluck('topic_id');
         $subtopics = LongQuestion::distinct()->pluck('subtopic_id');
         $query = LongQuestion::query();
 
 
         // Retrieve unique subjects, topics, and subtopics from the TrueFalseQuestion model
         $subjects = TrueFalseQuestion::distinct()->pluck('subject_id');
         $topics = TrueFalseQuestion::distinct()->pluck('topic_id');
         $subtopics = TrueFalseQuestion::distinct()->pluck('subtopic_id');
         $query = TrueFalseQuestion::query();
 
 
         // Retrieve unique subjects, topics, and subtopics from the MultipleChoiceQuestion model
         $subjects = MultipleChoiceQuestion::distinct()->pluck('subject_id');
         $topics = MultipleChoiceQuestion::distinct()->pluck('topic_id');
         $subtopics = MultipleChoiceQuestion::distinct()->pluck('subtopic_id');
         $query = MultipleChoiceQuestion::query();

         if ($request->has('subject_id')) {
            $query->where('subject_id', $request->input('subject_id'));
        }
    
        if ($request->has('topic_id')) {
            $query->where('topic_id', $request->input('topic_id'));
        }
    
        if ($request->has('subtopic_id')) {
            $query->where('subtopic_id', $request->input('subtopic_id'));
        }

        $longQuestions = $query->get();
        $trueFalseQuestions = $query->get();
        $multipleChoiceQuestions = $query->get();
 

     
    if ($request->ajax()) {
        // Return the filtered questions view as a response to the AJAX request
        $longQuestions = LongQuestion::paginate(2); // Change the number of items per page
        $trueFalseQuestions = TrueFalseQuestion::paginate(2);
        $multipleChoiceQuestions = MultipleChoiceQuestion::paginate(2);
    
        return view('admin.DisplayQuestions.filtered', compact('longQuestions','trueFalseQuestions','multipleChoiceQuestions'));
    }

  
    
        return view('admin.DisplayQuestions.index', compact('longQuestions','trueFalseQuestions','multipleChoiceQuestions', 'subjects', 'topics', 'subtopics'));
    }
    
    


    
    public function getTopics(Request $request)
{
    $subjectId = $request->input('subject_id');
    $topics = Topic::where('subject_id', $subjectId)->pluck('topic_name', 'id');
    return response()->json($topics);
}

public function getSubtopics(Request $request)
{
    $topicId = $request->input('topic_id');
    $subtopics = Subtopic::where('topic_id', $topicId)->pluck('subtopic_name', 'id');
    return response()->json($subtopics);
}




    

}
