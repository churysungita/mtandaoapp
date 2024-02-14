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


class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subjects = Subject::all();


        return view('admin.post_contents.index', compact('posts', 'subtopics', 'darasa', 'topics', 'subjects'));

    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $posts = Post::all();
        $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subjects = Subject::all();
      
        return view('admin.post_contents.create',compact('posts','subtopics','darasa','topics','subjects'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */




public function store(Request $request)
{   
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'status' => 'in:draft,published',
        'darasa_id' => 'required|exists:darasa,id',
        'subject_id' => 'required|exists:subjects,id',
        'topic_id' => 'required|exists:topics,id',
        'subtopic_id' => 'required|exists:subtopics,id',
    ]);

    $dom = new \DomDocument();
        $dom->loadHtml($validatedData['content'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $image_file = $dom->getElementsByTagName('img');

        if (!File::exists(public_path('uploads'))) {
            File::makeDirectory(public_path('uploads'));
        }
 
        foreach($image_file as $key => $image) {
            $data = $image->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $img_data = base64_decode($data);
            $image_name = "/uploads/" . time().$key.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $img_data);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }
 
        
    // Update the content in the validated data
    $validatedData['content'] = $dom->saveHTML();

    // Create a new post instance with the modified content
    $post = Post::create($validatedData);

    return redirect()->route('admin.post_contents.index')->with('success', 'Post created successfully.');
}

    /**
     * Display the specified post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {   
        $posts = Post::all();
        return view('admin.post_contents.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
     {
        $subtopics = Subtopic::all();
        $darasa = ClassLevel::all();
        $topics = Topic::all();
        $subjects = Subject::all();
        return view('admin.post_contents.edit', compact('post','subtopics','darasa','topics','subjects'));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {   

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'in:draft,published',
            'darasa_id' => 'required|exists:darasa,id', // Adjust as needed
            'subject_id' => 'required|exists:subjects,id', // Adjust as needed
            'topic_id' => 'required|exists:topics,id', // Adjust as needed
            'subtopic_id' => 'required|exists:subtopics,id', // Adjust as needed
        ]);
       

        // Update the Summernote content
        $post->content = $request->input('content');

        $post->update($validatedData);

        return redirect()->route('admin.post_contents.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.post_contents.index')->with('delete', 'Post deleted successfully.');
    }



 

  


}





