<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;


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

use Hashids\Hashids;



class UsersNoteController extends Controller
{
    protected $hashids;
    
    public function __construct()
    {
        $this->hashids = new Hashids(config('hashids.connections.main.salt'), config('hashids.connections.main.length'));
    }

    
    
    //Working with showing only notes materials ppt/pdf
      public function index_notes()
      {
          $subtopics = Subtopic::all();
          $darasa = ClassLevel::all();
          $topics = Topic::all();
          $subjects = Subject::all();

          // Retrieve files with related data (class level, subject, topic, subtopic)
          $content_materials = ContentMaterial::with(['darasa', 'subject', 'topic', 'subtopic'])
              ->where(function ($query) {
                  $query->where('file_path', 'like', '%.pdf')
                      ->orWhere('file_path', 'like', '%.ppt')
                      ->orWhere('file_path', 'like', '%.pptx');
              })
              ->orderBy('created_at', 'desc')
              ->get();

         $hashids = $this->hashids; // Pass the $hashids variable to the view




          return view('student.users_notes', compact('content_materials', 'subtopics', 'darasa', 'topics', 'subjects','hashids'));
      }




      public function show_notes($hashedId)
      {

        $hashids = new Hashids(config('hashids.connections.main.salt'), config('hashids.connections.main.length'));
        $decodedId = $hashids->decode($hashedId);
        $contentMaterial = ContentMaterial::find($decodedId[0]); // Assuming you're expecting a single ID in the array

      
        $contentMaterial = ContentMaterial::with(['darasa', 'subject', 'topic', 'subtopic'])
          ->findOrFail($decodedId[0]);

          // Determine the file type based on the file extension
        $fileExtension = pathinfo($contentMaterial->file_path, PATHINFO_EXTENSION);
      
         
         return view('student.users_notes_view', compact('contentMaterial','hashids'));
          
      }
      


    //Working with showing only notes materials ppt/pdf
    public function index_teachers_notes()
    {
        $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subjects = Subject::all();

        // Retrieve files with related data (class level, subject, topic, subtopic)
        $content_materials = ContentMaterial::with(['darasa', 'subject', 'topic', 'subtopic'])
            ->where(function ($query) {
                $query->where('file_path', 'like', '%.pdf')
                    ->orWhere('file_path', 'like', '%.ppt')
                    ->orWhere('file_path', 'like', '%.pptx');
            })
            ->orderBy('created_at', 'desc')
            ->get();

            $hashids = $this->hashids; // Pass the $hashids variable to the view


        return view('teacher.teachers_notes', compact('content_materials', 'subtopics', 'darasa', 'topics', 'subjects','hashids'));
    }




    public function show_teachers_notes($hashedId)
    {   
        $hashids = new Hashids(config('hashids.connections.main.salt'), config('hashids.connections.main.length'));
        $decodedId = $hashids->decode($hashedId);
        $contentMaterial = ContentMaterial::find($decodedId[0]); // Assuming you're expecting a single ID in the array


        // Determine the file type based on the file extension
        $fileExtension = pathinfo($contentMaterial->file_path, PATHINFO_EXTENSION);


            // Handle other file types as needed.
            // You can add more cases for different file types.
         return view('teacher.teachers_notes_view', compact('contentMaterial','hashids'));
        
}








      
  
  


}
