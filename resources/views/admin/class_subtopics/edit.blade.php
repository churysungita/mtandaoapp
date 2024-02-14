

<div class="container">
    <h1 class="display-4 mb-4">Edit Subtopic</h1>
    <form method="POST" action="{{ route('admin.class_subtopics.update', $subtopic->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="subtopic_name">Subtopic Name</label>
            <input type="text" class="form-control" id="subtopic_name" name="subtopic_name" value="{{ $subtopic->subtopic_name }}" required>
        </div>
        <div class="form-group">
            <label for="topic_id">Topic</label>
            <select class="form-control" id="topic_id" name="topic_id" required>
                @foreach($topics as $topic)
                    <option value="{{ $topic->id }}" {{ $topic->id == $subtopic->topic_id ? 'selected' : '' }}>
                        {{ $topic->topic_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Subtopic</button>
    </form>
</div>

