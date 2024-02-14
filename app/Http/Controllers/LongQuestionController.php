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
use App\Models\LongQuestion;
use App\Models\Post;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;

class LongQuestionController extends Controller
{
    
    public function index()
{
    $longQuestions = LongQuestion::all();
 
    $subtopics = Subtopic::all();
    $darasa = ClassLevel::all();
    $topics = Topic::all();
    $subjects = Subject::all();

    return view('admin.long_questions.index', compact('longQuestions','subjects', 'topics', 'subtopics'));
}

    public function create()
    {
            // Retrieve subjects, topics, and subtopics
        $subjects = Subject::all();
        $topics = Topic::all();
        $subtopics = Subtopic::all();
        
     return view('admin.long_questions.create', compact('subjects', 'topics', 'subtopics'));    }

     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'subject_id' => 'required',
             'topic_id' => 'required',
             'subtopic_id' => 'required',
             'marks' => 'required|integer|min:1',
         ]);
     
         $fieldsToProcess = ['question_text', 'correct_answer'];
     
         foreach ($fieldsToProcess as $field) {
             if ($request->has($field)) {
                 $dom = new \DOMDocument();
                 $dom->loadHtml($request->{$field}, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                 $image_files = $dom->getElementsByTagName('img');
     
                 if (!File::exists(public_path('uploads'))) {
                     File::makeDirectory(public_path('uploads'));
                 }
     
                 foreach ($image_files as $key => $image) {
                     $data = $image->getAttribute('src');
                     $extension = pathinfo($data, PATHINFO_EXTENSION);
                     $validExtensions = ['png', 'jpg', 'jpeg', 'gif']; // Add more valid extensions as needed
     
                     if (in_array($extension, $validExtensions)) {
                         list($type, $data) = explode(';', $data);
                         list(, $data) = explode(',', $data);
     
                         $img_data = base64_decode($data);
                         $image_name = "/uploads/" . time() . $key . '.' . $extension;
                         $path = public_path() . $image_name;
                         file_put_contents($path, $img_data);
     
                         $image->removeAttribute('src');
                         $image->setAttribute('src', $image_name);
                     }
                 }
     
                 // Update the content in the request data
                 $request->merge([$field => $dom->saveHTML()]);
             }
         }
     
         // Create a new LongQuestion instance with the modified fields
         LongQuestion::create($request->all());
     
         return redirect()->route('admin.long_questions.index')->with('success', 'Long question created successfully');
     }
     
     
    
    public function edit(LongQuestion $longQuestion)
    {
        $subjects = Subject::all();
        $topics = Topic::all();
        $subtopics = Subtopic::all();

        return view('admin.long_questions.edit', compact('longQuestion', 'subjects', 'topics', 'subtopics'));
    }

    public function update(Request $request, LongQuestion $longQuestion)
    {
        $request->validate([
            'subject_id' => 'required',
            'topic_id' => 'required',
            'subtopic_id' => 'required',
            'question_text' => 'required',
            'marks' => 'required|integer|min:1',
            'correct_answer' => 'required',
        ]);

        $longQuestion->update([
            'subject_id' => $request->subject_id,
            'topic_id' => $request->topic_id,
            'subtopic_id' => $request->subtopic_id,
            'question_text' => $request->question_text,
            'marks' => $request->marks,
            'correct_answer' => $request->correct_answer,
        ]);

        return redirect()->route('admin.long_questions.index')->with('success', 'Long question updated successfully');
    }

    public function destroy(LongQuestion $longQuestion)
    {
        $longQuestion->delete();

        return redirect()->route('admin.long_questions.index')->with('delete', 'Long question deleted successfully');
    }
}
