<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StudentNotesController;
use App\Http\Controllers\StudentVideosController;
use App\Http\Controllers\TeacherNotesController;
use App\Http\Controllers\TeacherVideosController;
use App\Http\Controllers\AdminNotesController;

use App\Http\Middleware\RoleMiddleware; 

use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SubtopicController;
use App\Http\Controllers\ContentMaterialController;
use App\Http\Controllers\PostController;


use App\Http\Controllers\UsersMaterialsController;
use App\Http\Controllers\UsersNoteController;
use App\Http\Controllers\UsersVideoController;


use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\OfficeContactController;

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MultipleChoiceQuestionController;
use App\Http\Controllers\TrueFalseQuestionController;
use App\Http\Controllers\LongQuestionController;
use App\Http\Controllers\QuestionsDisplayController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [AboutUsController::class, 'welcome']);
Route::get('/', [OfficeContactController::class, 'welcome']);


Route::get('aboutUs', function () {
    return view('about_us');
});

Route::get('notes', function () {
    return view('notes');
});
Route::get('videos', function () {
    return view('videos');
});

Route::get('contactUs', function () {
    return view('contact_us');
});
// Route::get('/home',[HomeController::class,'redirects']); //for home page for each user

Route::get('/home', [HomeController::class, 'redirects'])->name('home');

// Route::get('/home',[HomeController::class,'redirects']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');











// Admin Routes
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/add_users', [AdminController::class, 'addview'])->name('admin.addUsers');
    Route::post('/create_users', [AdminController::class, 'adminAddUsers'])->name('admin.createUsers');
    Route::get('/user_list', [AdminController::class, 'userList'])->name('admin.userList');
    Route::get('/edit_user/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::post('/update_user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::get('/delete_user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/edit_user_modal', [AdminController::class, 'editUserModal'])->name('admin.editUserModal');
    Route::get('/get_users_data', [AdminController::class, 'getUsersData'])->name('admin.getUsersData');

  



    // Classes Routes
    Route::resource('admin.classes', ClassController::class);

        // List all classes
    Route::get('/classes', [ClassController::class, 'index'])->name('admin.classes.index');

    // Show the form to create a new class
    Route::get('/classes/create', [ClassController::class, 'create'])->name('admin.classes.create');

    // Store a new class
    Route::post('/classes', [ClassController::class, 'store'])->name('admin.classes.store');

    // Show a specific class
    Route::get('/classes/{darasa}', [ClassController::class, 'show'])->name('admin.classes.show');

    // Show the form to edit a class
    Route::get('/classes/{darasa}/edit', [ClassController::class, 'edit'])->name('admin.classes.edit');

    // Update a specific class
    Route::put('/classes/{darasa}', [ClassController::class, 'update'])->name('admin.classes.update');

    // Delete a specific class
    Route::delete('/classes/{darasa}', [ClassController::class, 'destroy'])->name('admin.classes.destroy');



    // Subjects Routes
    Route::resource('admin.subjects', SubjectController::class);
    
        // List all subjects
        Route::get('/subjects', [SubjectController::class, 'index'])->name('admin.subjects.index');

        // Show the form to create a new class
        Route::get('/subjects/create', [SubjectController::class, 'create'])->name('admin.subjects.create');
    
        // Store a new class
        Route::post('/subjects', [SubjectController::class, 'store'])->name('admin.subjects.store');
    
        // Show a specific class
        Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('admin.subjects.show');
    
        // Show the form to edit a class
        Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('admin.subjects.edit');
    
        // Update a specific class
        Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('admin.subjects.update');
    
        // Delete a specific class
        Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('admin.subjects.destroy');






    // Topics Routes
    Route::resource('admin.class_topics', TopicController::class);
        // List all topics
        Route::get('/class_topics', [TopicController::class, 'index'])->name('admin.class_topics.index');

        // Show the form to create a new class
        Route::get('/class_topics/create', [TopicController::class, 'create'])->name('admin.class_topics.create');

        // Store a new class
        Route::post('/class_topics', [TopicController::class, 'store'])->name('admin.class_topics.store');

        // Show a specific class
        Route::get('/class_topics/{topic}', [TopicController::class, 'show'])->name('admin.class_topics.show');

        // Show the form to edit a class
        Route::get('/class_topics/{topic}/edit', [TopicController::class, 'edit'])->name('admin.class_topics.edit');

        // Update a specific class
        Route::put('/class_topics/{topic}', [TopicController::class, 'update'])->name('admin.class_topics.update');

        // Delete a specific class
        Route::delete('/class_topics/{topics}', [TopicController::class, 'destroy'])->name('admin.class_topics.destroy');




    // Subtopics Routes
    Route::resource('admin.class_subtopics', SubtopicController::class);
      // List all subtopics
      Route::get('/class_subtopics', [SubtopicController::class, 'index'])->name('admin.class_subtopics.index');

      // Show the form to create a new class
      Route::get('/class_subtopics/create', [SubtopicController::class, 'create'])->name('admin.class_subtopics.create');

      // Store a new class
      Route::post('/class_subtopics', [SubtopicController::class, 'store'])->name('admin.class_subtopics.store');

      // Show a specific class
      Route::get('/class_subtopics/{subtopic}', [SubtopicController::class, 'show'])->name('admin.class_subtopics.show');

      // Show the form to edit a class
      Route::get('/class_subtopics/{subtopic}/edit', [SubtopicController::class, 'edit'])->name('admin.class_subtopics.edit');

      // Update a specific class
      Route::put('/class_subtopics/{subtopic}', [SubtopicController::class, 'update'])->name('admin.class_subtopics.update');

      // Delete a specific class
      Route::delete('/class_subtopics/{subtopic}', [SubtopicController::class, 'destroy'])->name('admin.class_subtopics.destroy');

      
    // Content Materials Routes
    Route::resource('admin.content_materials', ContentMaterialController::class);

           // List all contents materials
      Route::get('/content_materials', [ContentMaterialController::class, 'index'])->name('admin.content_materials.index');

      // Show the form to create a new class
      Route::get('/content_materials/create', [ContentMaterialController::class, 'create'])->name('admin.content_materials.create');

      // Store a new class
      Route::post('/content_materials', [ContentMaterialController::class, 'store'])->name('admin.content_materials.store');

      // Show a specific class
      Route::get('/content_materials/{content}', [ContentMaterialController::class, 'show'])->name('admin.content_materials.show');

      // Show the form to edit a class
      Route::get('/content_materials/{content}/edit', [ContentMaterialController::class, 'edit'])->name('admin.content_materials.edit');

      // Update a specific class
      Route::put('/content_materials/{content}', [ContentMaterialController::class, 'update'])->name('admin.content_materials.update');

      // Delete a specific class
      Route::delete('/content_materials/{content}', [ContentMaterialController::class, 'destroy'])->name('admin.content_materials.destroy');
             // Define a route to get topics based on the selected subject
      Route::get('get-subjects', 'QuestionController@getSubjects')->name('getSubjects');
      Route::get('/get-topics', [QuestionController::class, 'getTopics'])->name('getTopics');

             // Define a route to get subtopics based on the selected topic
      Route::get('/get-subtopics', [QuestionController::class, 'getSubtopics'])->name('getSubtopics');
         
  

       // Posts  Routes
    Route::resource('admin.post_contents', PostController::class);

            // List all posts materials
        Route::get('/post_contents', [PostController::class, 'index'])->name('admin.post_contents.index');

        // Show the form to create a new class
        Route::get('/post_contents/create', [PostController::class, 'create'])->name('admin.post_contents.create');
         // Show the form to create a new class
        // Route::get('/post_contents/newpost', [PostController::class, 'newpost'])->name('admin.post_contents.create_posts');

        // Store a new class
        Route::post('/post_contents', [PostController::class, 'store'])->name('admin.post_contents.store');

        // Show a specific class
        Route::get('/post_contents/{post}', [PostController::class, 'show'])->name('admin.post_contents.show');

        // Show the form to edit a class
        Route::get('/post_contents/{post}/edit', [PostController::class, 'edit'])->name('admin.post_contents.edit');

        // Update a specific class
        Route::put('/post_contents/{post}', [PostController::class, 'update'])->name('admin.post_contents.update');

        // Delete a specific class
        Route::delete('/post_contents/{post}', [PostController::class, 'destroy'])->name('admin.post_contents.destroy');

        // Define the route for CKEditor file uploads when creating a post 
        Route::post('/post_contents/uploadSummernoteImage', [PostController::class, 'uploadSummernoteImage'])->name('post_contents.uploadSummernoteImage');


            
        // About us Routes
        Route::resource('admin.website_settings', AboutUsController::class);
        
        // List all subjects
        Route::get('/website_settings', [AboutUsController::class, 'index'])->name('admin.website_settings.index');

        // Show the form to create a new class
        Route::get('/website_settings/create', [AboutUsController::class, 'create'])->name('admin.website_settings.create');

        // Store a new class
        Route::post('/website_settings', [AboutUsController::class, 'store'])->name('admin.website_settings.store');

        // Show a specific class
        Route::get('/website_settings/{aboutUs}', [AboutUsController::class, 'show'])->name('admin.website_settings.show');

        // Show the form to edit a class
        Route::get('/website_settings/{aboutUsContent}/edit', [AboutUsController::class, 'edit'])->name('admin.website_settings.edit');

        // Update a specific class
        Route::put('/website_settings/{aboutUs}', [AboutUsController::class, 'update'])->name('admin.website_settings.update');

        // Delete a specific class
        Route::delete('/website_settings/{aboutUs}', [AboutUsController::class, 'destroy'])->name('admin.website_settings.destroy');

        

         // Office contact Routes
         Route::resource('admin.office_contacts', OfficeContactController::class);
        
         // List all subjects
         Route::get('/office_contacts', [OfficeContactController::class, 'index'])->name('admin.office_contacts.index');
 
         // Show the form to create a new class
         Route::get('/office_contacts/create', [OfficeContactController::class, 'create'])->name('admin.office_contacts.create');
 
         // Store a new class
         Route::post('/office_contacts', [OfficeContactController::class, 'store'])->name('admin.office_contacts.store');
 
         // Show a specific class
         Route::get('/office_contacts/{officeContact}', [OfficeContactController::class, 'show'])->name('admin.office_contacts.show');
 
         // Show the form to edit a class
         Route::get('/office_contacts/{officeContact}/edit', [OfficeContactController::class, 'edit'])->name('admin.office_contacts.edit');
 
         // Update a specific class
         Route::put('/office_contacts/{officeContact}', [OfficeContactController::class, 'update'])->name('admin.office_contacts.update');
 
         // Delete a specific class
         Route::delete('/office_contacts/{officeContact}', [OfficeContactController::class, 'destroy'])->name('admin.office_contacts.destroy');
 
       

         // Questions Routes
    Route::resource('admin.Questions', QuestionController::class);

           // List all contents materials
      Route::get('/Questions', [QuestionController::class, 'index'])->name('admin.Questions.index');

      // Show the form to create a new class
      Route::get('/Questions/create', [QuestionController::class, 'create'])->name('admin.Questions.create');

      // Store a new class
      Route::post('/Questions', [QuestionController::class, 'store'])->name('admin.Questions.store');

      // Show a specific class
      Route::get('/Questions/{qn}', [QuestionController::class, 'show'])->name('admin.Questions.show');

      // Show the form to edit a class
      Route::get('/Questions/{qn}/edit', [QuestionController::class, 'edit'])->name('admin.Questions.edit');

      // Update a specific class
      Route::put('/Questions/{qn}', [QuestionController::class, 'update'])->name('admin.Questions.update');

      // Delete a specific class
      Route::delete('/Questions/{qn}', [QuestionController::class, 'destroy'])->name('admin.Questions.destroy');

 
        // Define a route to get topics based on the selected subject
    Route::get('/get-topics', [QuestionController::class, 'getTopics'])->name('getTopics');

        // Define a route to get subtopics based on the selected topic
     Route::get('/get-subtopics', [QuestionController::class, 'getSubtopics'])->name('getSubtopics');

     // Define a route to filter questions
    Route::get('/filter-questions', [QuestionController::class, 'filterQuestions'])->name('filterQuestions');





      // Multiple choice questions
      Route::resource('admin.multiple_choices', MultipleChoiceQuestionController::class);
        
      // List all subjects
      Route::get('/multiple_choices', [MultipleChoiceQuestionController::class, 'index'])->name('admin.multiple_choices.index');

      // Show the form to create a new class
      Route::get('/multiple_choices/create', [MultipleChoiceQuestionController::class, 'create'])->name('admin.multiple_choices.create');

      // Store a new class
      Route::post('/multiple_choices', [MultipleChoiceQuestionController::class, 'store'])->name('admin.multiple_choices.store');

      // Show a specific class
      Route::get('/multiple_choices/{question}', [MultipleChoiceQuestionController::class, 'show'])->name('admin.multiple_choices.show');

      // Show the form to edit a class
      Route::get('/multiple_choices/{question}/edit', [MultipleChoiceQuestionController::class, 'edit'])->name('admin.multiple_choices.edit');

      // Update a specific class
      Route::put('/multiple_choices/{question}', [MultipleChoiceQuestionController::class, 'update'])->name('admin.multiple_choices.update');

      // Delete a specific class
      Route::delete('/multiple_choices/{question}', [MultipleChoiceQuestionController::class, 'destroy'])->name('admin.multiple_choices.destroy');
              // Define a route to get topics based on the selected subject
     Route::get('/get-topics', [QuestionController::class, 'getTopics'])->name('getTopics');

    // Define a route to get subtopics based on the selected topic
     Route::get('/get-subtopics', [QuestionController::class, 'getSubtopics'])->name('getSubtopics');


     
      // True/False questions
      Route::resource('admin.true_false_qns', TrueFalseQuestionController::class);
        
      // List all subjects
      Route::get('/true_false_qns', [TrueFalseQuestionController::class, 'index'])->name('admin.true_false_qns.index');
      // Show the form to create a new class
      Route::get('/true_false_qns/create', [TrueFalseQuestionController::class, 'create'])->name('admin.true_false_qns.create');

      // Store a new class
      Route::post('/true_false_qns', [TrueFalseQuestionController::class, 'store'])->name('admin.true_false_qns.store');

      // Show a specific class
      Route::get('/true_false_qns/{trueFalseQuestion}', [TrueFalseQuestionController::class, 'show'])->name('admin.true_false_qns.show');

      // Show the form to edit a class
      Route::get('/true_false_qns/{trueFalseQuestion}/edit', [TrueFalseQuestionController::class, 'edit'])->name('admin.true_false_qns.edit');

      // Update a specific class
      Route::put('/true_false_qns/{trueFalseQuestion}', [TrueFalseQuestionController::class, 'update'])->name('admin.true_false_qns.update');

      // Delete a specific class
      Route::delete('/true_false_qns/{trueFalseQuestion}', [TrueFalseQuestionController::class, 'destroy'])->name('admin.true_false_qns.destroy');
              // Define a route to get topics based on the selected subject
     Route::get('/get-topics', [QuestionController::class, 'getTopics'])->name('getTopics');

    // Define a route to get subtopics based on the selected topic
     Route::get('/get-subtopics', [QuestionController::class, 'getSubtopics'])->name('getSubtopics');


       // NormalLongQuestionController questions
       Route::resource('admin.long_questions', LongQuestionController::class);
        
       // List all subjects
       Route::get('/long_questions', [LongQuestionController::class, 'index'])->name('admin.long_questions.index');
       // Show the form to create a new class
       Route::get('/long_questions/create', [LongQuestionController::class, 'create'])->name('admin.long_questions.create');
 
       // Store a new class
       Route::post('/long_questions', [LongQuestionController::class, 'store'])->name('admin.long_questions.store');
 
       // Show a specific class
       Route::get('/long_questions/{longQuestion}', [LongQuestionController::class, 'show'])->name('admin.long_questions.show');
 
       // Show the form to edit a class
       Route::get('/long_questions/{longQuestion}/edit', [LongQuestionController::class, 'edit'])->name('admin.long_questions.edit');
 
       // Update a specific class
       Route::put('/long_questions/{longQuestion}', [LongQuestionController::class, 'update'])->name('admin.long_questions.update');
 
       // Delete a specific class
       Route::delete('/long_questions/{longQuestion}', [LongQuestionController::class, 'destroy'])->name('admin.long_questions.destroy');
               // Define a route to get topics based on the selected subject
       Route::get('/get-topics', [QuestionController::class, 'getTopics'])->name('getTopics');
 
     // Define a route to get subtopics based on the selected topic
       Route::get('/get-subtopics', [QuestionController::class, 'getSubtopics'])->name('getSubtopics');



      
         //Display  Questions Routes
    Route::resource('admin.DisplayQuestions', QuestionsDisplayController::class);

    // List all contents materials
      Route::get('/DisplayQuestions', [QuestionsDisplayController::class, 'index'])->name('admin.DisplayQuestions.index');


                // Define a route to get topics based on the selected subject
                Route::get('/get-topics', [QuestionController::class, 'getTopics'])->name('getTopics');
 
                // Define a route to get subtopics based on the selected topic
                  Route::get('/get-subtopics', [QuestionController::class, 'getSubtopics'])->name('getSubtopics');


    



    
  




});





//Students routes

Route::middleware(['auth', 'role:3'])->group(function () {

       // Posts/ Materials which created using ckeditor  Routes 
    Route::resource('student', UsersMaterialsController::class);

            // List all posts materials
        Route::get('users_materials', [UsersMaterialsController::class, 'index'])->name('student.users_materials');
        Route::get('users_materials_view/{hashedId}', [UsersMaterialsController::class, 'show'])->name('student.users_materials_view');

        Route::get('users_notes', [UsersNoteController::class, 'index_notes'])->name('student.users_notes');
        Route::get('users_notes_view/{hashedId}', [UsersNoteController::class, 'show_notes'])->name('student.users_notes_view');

        Route::get('users_videos', [UsersVideoController::class, 'index_videos'])->name('student.users_videos');
        Route::get('users_videos_view/{hashedId}', [UsersVideoController::class, 'show_videos'])->name('student.users_videos_view');



        






});

//Teachers toutes

Route::middleware(['auth', 'role:2'])->group(function () {

      // Posts/ Materials which created using ckeditor  Routes 
      Route::resource('teacher', UsersMaterialsController::class);

      // List all posts materials
  Route::get('teachers_materials', [UsersMaterialsController::class, 'index_teachers'])->name('teacher.teachers_materials');
  Route::get('teachers_materials_view/{hashedId}', [UsersMaterialsController::class, 'show_teachers'])->name('teacher.teachers_materials_view');

  Route::get('teachers_notes', [UsersNoteController::class, 'index_teachers_notes'])->name('teacher.teachers_notes');
  Route::get('teachers_notes_view/{hashedId}', [UsersNoteController::class, 'show_teachers_notes'])->name('teacher.teachers_notes_view');

  Route::get('teachers_videos', [UsersVideoController::class, 'index_teachers_videos'])->name('teacher.teachers_videos');
  Route::get('teachers_videos_view/{hashedId}', [UsersVideoController::class, 'show_teachers_videos'])->name('teacher.teachers_videos_view');







});











// Student Routes
Route::get('/student/notes', [StudentNotesController::class, 'snotes'])->name('student.notes');
Route::get('/student/videos', [StudentVideosController::class, 'svideos'])->name('student.videos');

// Teacher Routes
Route::get('/teacher/notes', [TeacherNotesController::class, 'tnotes'])->name('teacher.notes');
Route::get('/teacher/videos', [TeacherVideosController::class, 'tvideos'])->name('teacher.videos');
});
