

<!-- resources/views/admin/topics/show.blade.php -->
<div class="container-fluid">
    <h1 class="mt-4">Topic Details</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#">Manage Topics</a></li>
        <li class="breadcrumb-item active">Topic Details</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Subject:</strong> {{ $topic->subject->subject_name }}</p> <!-- Display subject_name -->
            <p><strong>ID:</strong> {{ $topic->id }}</p>
            <p><strong>Topic Name:</strong> {{ $topic->topic_name }}</p>
           
        </div>
    </div>
</div>