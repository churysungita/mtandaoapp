<!-- resources/views/admin/topics/edit.blade.php -->
<div class="container-fluid">
    <h1 class="mt-4">Edit Topic</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#">Manage Topics</a></li>
        <li class="breadcrumb-item active">Edit Topic</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.class_topics.update', $topic->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="topic_name">Topic Name:</label>
                    <input type="text" name="topic_name" id="topic_name" value="{{ $topic->topic_name }}"
                        class="form-control @error('topic_name') is-invalid @enderror">
                    @error('topic_name')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="subject_id">Select Subject:</label>
                    <select name="subject_id" id="subject_id"
                        class="form-control @error('subject_id') is-invalid @enderror">
                        <option value="" disabled>Select a subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" @if($subject->id == $topic->subject_id) selected
                                @endif>
                                {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
