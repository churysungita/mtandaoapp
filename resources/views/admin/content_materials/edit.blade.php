<!-- resources/views/content-materials/edit.blade.php -->

<div class="container">
    <h1 class="display-4 mb-4">Edit Content Material</h1>
    <form method="POST" action="{{ route('admin.content_materials.update', $contentMaterial->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $contentMaterial->title }}" required>
        </div>
        <div class="form-group">
            <label for="darasa_id">Select Class:</label>
            <select name="darasa_id" id="darasa_id" class="form-control" required>
                <!-- Populate options from the 'classes' table -->
            </select>
        </div>
        <div class="form-group">
            <label for="subject_id">Select Subject:</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <!-- Populate options based on the selected class -->
            </select>
        </div>
        <div class="form-group">
            <label for="topic_id">Select Topic:</label>
            <select name="topic_id" id="topic_id" class="form-control" required>
                <!-- Populate options based on the selected subject -->
            </select>
        </div>
        <div class="form-group">
            <label for="subtopic_id">Select Subtopic:</label>
            <select name="subtopic_id" id="subtopic_id" class="form-control" required>
                <!-- Populate options based on the selected topic -->
            </select>
        </div>
        <div class="form-group">
            <label for="file">Update File (Video or PPT):</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update Content Material</button>
    </form>
</div>
