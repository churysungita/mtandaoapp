

<!-- resources/views/admin/topics/show.blade.php -->


<div class="container">
    <h1 class="display-4 mb-4">Subtopic Details</h1>
    <ul class="list-group">
        <li class="list-group-item">
            <strong>ID:</strong> {{ $subtopic->id }}
        </li>
        <li class="list-group-item">
            <strong>Subtopic Name:</strong> {{ $subtopic->subtopic_name }}
        </li>
        <li class="list-group-item">
            <strong>Topic:</strong> {{ optional($subtopic->topic)->topic_name ?? 'N/A' }}
        </li>
    </ul>

    <div class="mt-4">
        <a href="{{ route('admin.class_subtopics.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>
