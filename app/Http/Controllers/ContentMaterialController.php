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
use Illuminate\Support\Facades\Storage; // Import Storage facade for file handling
use Illuminate\Support\Facades\File;


class ContentMaterialController extends Controller
{
    //
    public function index()
    {   $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subject = Subject::all();
        $content_materials = ContentMaterial::all();


        return view('admin.content_materials.index', compact('content_materials','subtopics','topics','subject','darasa'));
    }

    public function create()
    {   $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subjects = Subject::all();
        $content_materials = ContentMaterial::all();

        return view('admin.content_materials.create',compact('content_materials','subtopics','topics','subjects','darasa'));
    }


    public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'darasa_id' => 'required|exists:darasa,id',
        'subject_id' => 'required|exists:subjects,id',
        'topic_id' => 'required|exists:topics,id',
        'subtopic_id' => 'required|exists:subtopics,id',
        'file' => 'required|file|mimes:mp4,pdf,ppt,pptx',
    ]);

    // Get the uploaded file
    $uploadedFile = $request->file('file');

    // Generate a unique filename (you can customize this as needed)
    $filename = time() . '_' . $uploadedFile->getClientOriginalName();

    // Specify the destination path within the 'public' folder
    $destinationPath = public_path('uploads'); // Change 'uploads' to your desired folder name

    // Move the file to the 'public' folder with the unique filename
    $uploadedFile->move($destinationPath, $filename);

    // Store the uploaded file in the 'storage/app/public/content_material' directory
    $filePath = 'uploads/' . $filename; // Change 'uploads' to your desired folder name

    // Create a new ContentMaterial instance and store it in the database
    $content_material = new ContentMaterial([
        'darasa_id' => $validatedData['darasa_id'],
        'subject_id' => $validatedData['subject_id'],
        'topic_id' => $validatedData['topic_id'],
        'subtopic_id' => $validatedData['subtopic_id'],
        'file_path' => $filePath,
    ]);

    $content_material->save();

    // Redirect back or to a success page
    return redirect()->route('admin.content_materials.index')->with('success', 'Content material uploaded successfully.');
}


   

public function show($id)
{
    $contentMaterial = ContentMaterial::findOrFail($id);

    // Determine the file type based on the file extension
    $fileExtension = pathinfo($contentMaterial->file_path, PATHINFO_EXTENSION);

    if (in_array($fileExtension, ['pdf'])) {
        // For PDF files, you can use a PDF viewer like PDF.js or display it using an iframe.
        return view('admin.content_materials.pdf_viewer', compact('contentMaterial'));
    } elseif (in_array($fileExtension, ['mp4'])) {
        // For video files, you can use an HTML5 video player.
        return view('admin.content_materials.video_player', compact('contentMaterial'));
    } elseif (in_array($fileExtension, ['ppt', 'pptx'])) {
        // For PowerPoint files, you can provide a viewer or a download link.
        return view('admin.content_materials.powerpoint_viewer', compact('contentMaterial'));
       
    } else {
        // Handle other file types as needed.
        // You can add more cases for different file types.
        return view('admin.content_materials.default_viewer', compact('contentMaterial'));
    }
}


    

    public function edit(ContentMaterial $contentMaterial)
    {
        return view('admin.content_materials.edit', compact('contentMaterial'));
    }

    public function update(Request $request, ContentMaterial $contentMaterial)
    {
        // Validation logic here

        // Update the content material

        // Redirect to index or show a success message
    }

   


    public function destroy(ContentMaterial $content)
    {
        // Get the file path associated with the content material
        $filePath = public_path('contentmaterials/' . $content->file_path);
    
        // Check if the file exists before deleting it
        if (File::exists($filePath) && File::isFile($filePath)) {
            // Delete the file
            File::delete($filePath);
        }
        // dd($contentMaterials);
    
        // Delete the specific content material instance from the database
        $content->delete();
    
        // Redirect to index or show a success message
        return redirect()->route('admin.content_materials.index')->with('delete', 'Content and associated file deleted successfully.');
    }
    





    // Your other controller methods...

    public function getSubjects($classId)
    {
        $subjects = Subject::where('class_name_id', $classId)->pluck('subject_name', 'id');
        return response()->json($subjects);
    }

    public function getTopics($subjectId)
    {
        $topics = Topic::where('subject_id', $subjectId)->pluck('topic_name', 'id');
        return response()->json($topics);
    }

    public function getSubtopics($topicId)
    {
        $subtopics = Subtopic::where('topic_id', $topicId)->pluck('subtopic_name', 'id');
        return response()->json($subtopics);
    }

    // Your other controller methods...
}
