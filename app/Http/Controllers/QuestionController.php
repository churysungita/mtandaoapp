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
use File;


class QuestionController extends Controller
{
    
    public function index(Request $request)
    {
        $questions = Question::query();
        $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subjects = Subject::all();
    
        // Check if filter parameters are provided
        if ($request->has('filter')) {
            $filterBy = $request->input('filter');
            $subjectId = $request->input('subject_id');
            $topicId = $request->input('topic_id');
            $subtopicId = $request->input('subtopic_id');
    
            if ($filterBy === 'subjects' && $subjectId) {
                $questions->where('subject_id', $subjectId);
            } elseif ($filterBy === 'topics' && $subjectId && $topicId) {
                $questions->where('subject_id', $subjectId)->where('topic_id', $topicId);
            } elseif ($filterBy === 'subtopics' && $subjectId && $topicId && $subtopicId) {
                $questions->where('subject_id', $subjectId)
                          ->where('topic_id', $topicId)
                          ->where('subtopic_id', $subtopicId);
            }
        }
    
        // Get the filtered or all questions
        $filteredQuestions = $questions->get();
    
        return view('admin.Questions.index', compact('questions', 'subjects', 'topics', 'subtopics', 'filteredQuestions'));
    }
    

    public function create()
    {  
        $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subjects = Subject::all();
        // $questions = Question::all();
        return view('admin.Questions.create', compact('subjects','topics','subtopics'));
    }

//     public function getSubjects(Request $request)
//     {
//         $classLevelId = $request->input('class_level_id');
    
//         // Assuming you have a "class_name_id" foreign key column in your "subjects" table.
//         $subjects = Subject::where('class_name_id', $classLevelId)->pluck('subject_name', 'id');
    
//         return response()->json($subjects);
//     }
    

//     public function getTopics(Request $request)
//     {
//         $subjectId = $request->input('subject_id');
//         $topics = Topic::where('subject_id', $subjectId)->pluck('topic_name', 'id');
//         return response()->json($topics);
//     }

//     public function getSubtopics(Request $request)
// {
//     $topicId = $request->input('topic_id');
//     $subtopics = Subtopic::where('topic_id', $topicId)->pluck('subtopic_name', 'id');
//     return response()->json($subtopics);
// }

public function getSubjects(Request $request)
{
    $classLevelId = $request->input('darasa_id');
    $subjects = Subject::where('darasa_id', $classLevelId)->pluck('subject_name', 'id');
    return response()->json($subjects);
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



    public function store(Request $request)
    {    
    


        $request->validate([
            'subject_id' => 'required',
            'topic_id' => 'required',
            'subtopic_id' => 'required',
            'type' => 'required',
            'question_text' => 'required',
            'answer' => 'required',
            'marks' => 'required',
        ]);

        Question::create($request->all());

        return redirect()->route('admin.Questions.index')->with('success', 'Question created successfully');
    }

    public function show(Question $question)
    {
        return view('admin.Questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        return view('admin.Questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'subject_id' => 'required',
            'topic_id' => 'required',
            'subtopic_id' => 'required',
            'type' => 'required',
            'question_text' => 'required',
            'answer' => 'required',
            'marks' => 'required',
        ]);

        $question->update($request->all());

        return redirect()->route('admin.Questions.index')->with('success', 'Question updated successfully');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.Questions.index')->with('success', 'Question deleted successfully');
    }


    public function filterQuestions(Request $request)
    {
        $filterBy = $request->input('filter');
        $subjectId = $request->input('subject_id');
        $topicId = $request->input('topic_id');
        $subtopicId = $request->input('subtopic_id');
    
        // Query the database based on the selected filter
        $questions = Question::query();
    
        if ($filterBy === 'subjects' && $subjectId) {
            $questions->where('subject_id', $subjectId);
        } elseif ($filterBy === 'topics' && $topicId) {
            $questions->where('topic_id', $topicId);
        } elseif ($filterBy === 'subtopics' && $subtopicId) {
            $questions->where('subtopic_id', $subtopicId);
        }
    
        $filteredQuestions = $questions->get();
    
        // Load the view with the filtered questions
        $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subjects = Subject::all();
    
        return view('admin.Questions.index', compact('filteredQuestions', 'subjects', 'topics', 'subtopics'));
    }
    

}
