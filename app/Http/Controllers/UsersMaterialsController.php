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

use Hashids\Hashids;

use File;



class UsersMaterialsController extends Controller
{
    
        protected $hashids;
    
        public function __construct()
        {
            $this->hashids = new Hashids(config('hashids.connections.main.salt'), config('hashids.connections.main.length'));
        }
    
        public function index()
        {


             // Retrieve posts with related data (class level, subject, topic, subtopic) in descending order
            $posts = Post::with(['darasa', 'subject', 'topic', 'subtopic'])
            ->orderBy('created_at', 'desc')
            ->get();
            $hashids = $this->hashids; // Pass the $hashids variable to the view

            
    
            return view('student.users_materials', compact('posts','hashids'));
        }

        public function show($hashedId)
        {   
            $hashids = new Hashids(config('hashids.connections.main.salt'), config('hashids.connections.main.length'));
            $decodedId = $hashids->decode($hashedId);
            $post = Post::find($decodedId[0]); // Assuming you're expecting a single ID in the array
        
        
            // Retrieve the post by its ID along with related data (class level, subject, topic, subtopic)
            $post = Post::with(['darasa', 'subject', 'topic', 'subtopic'])
                ->findOrFail($decodedId[0]);
        
            // Pass the retrieved post to the show view
            return view('student.users_materials_view', compact('post','hashids'));
        }
        





        public function index_teachers()
        {
        // Retrieve posts with related data (class level, subject, topic, subtopic) in descending order
        $posts = Post::with(['darasa', 'subject', 'topic', 'subtopic'])
        ->orderBy('created_at', 'desc')
        ->get();
        $hashids = $this->hashids; // Pass the $hashids variable to the view


            
    
            return view('teacher.teachers_materials', compact('posts','hashids'));
        }

        public function show_teachers($hashedId)
        {
            $hashids = new Hashids(config('hashids.connections.main.salt'), config('hashids.connections.main.length'));
            $decodedId = $hashids->decode($hashedId);
            $post = Post::find($decodedId[0]); // Assuming you're expecting a single ID in the array
        
        
            // Retrieve the post by its ID along with related data (class level, subject, topic, subtopic)
            $post = Post::with(['darasa', 'subject', 'topic', 'subtopic'])
                ->findOrFail($decodedId[0]);
        
            // Pass the retrieved post to the show view
            return view('teacher.teachers_materials_view', compact('post','hashids'));
        }


        

    }