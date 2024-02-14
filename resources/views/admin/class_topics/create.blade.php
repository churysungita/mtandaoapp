<!-- resources/views/admin/topics/create.blade.php -->
<div class="container-fluid">
    <h1 class="mt-4">Create Topic</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#">Manage Topics</a></li>
        <li class="breadcrumb-item active">Create Topic</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.class_topics.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="topic_name">Topic Name:</label>
                    <input type="text" name="topic_name" id="topic_name" class="form-control @error('topic_name') is-invalid @enderror">
                   
                </div>
                <div class="form-group">
                    <label for="subject_id">Select Subject:</label>
                    <select name="subject_id" id="subject_id" class="form-control @error('subject_id') is-invalid @enderror">
                        <option value="" disabled selected>Select a subject</option>
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>