<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Create SubTopic</h1>
        </div>
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.class_subtopics.index') }}">Manage
                            SubTopics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>





            <form action="{{ route('admin.class_subtopics.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="subject_id">Select Subject:</label>
                    <select name="subject_id" class="form-control" id="subject-dropdown">
                        <option value="" >Select a subject</option>
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>


                </div>
                <div class="form-group">
                    <label for="topic_id">Select Topic:</label>
                    <select name="topic_id" class="form-control" id="topic-dropdown">
                        <option value="" >Select a topic</option>
                    </select>
                    <div id="no-topics-msg" style="display: none; color: red;">No topics available for the selected subject.</div>
                </div>

                <div class="form-group">
                    <label for="subtopic_name">SubTopic Name:</label>
                    <input type="text" name="subtopic_name" id="subtopic_name" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // When the page loads, hide the topic and subtopic dropdowns
        $('#topic-dropdown, #subtopic-dropdown').hide();

        // When the subject dropdown changes
        $('#subject-dropdown').on('change', function() {
            var subjectId = $(this).val();
            if (subjectId) {
                // Make an AJAX request to get topics for the selected subject
                $.ajax({
                    url: '{{ route('getTopics') }}'
                    , type: 'GET'
                    , data: {
                        subject_id: subjectId
                    }
                    , success: function(data) {
                        // Clear existing options and append new options
                        $('#topic-dropdown').empty();
                        $('#topic-dropdown').append($('<option value="" disabled>Select a topic</option>'));
                        $.each(data, function(key, value) {
                            $('#topic-dropdown').append($('<option value="' + key + '">' + value + '</option>'));
                        });
                        // Show the topic dropdown
                        $('#topic-dropdown').show();
                    }
                });
            } else {
                // If no subject is selected, hide the topic and subtopic dropdowns
                $('#topic-dropdown, #subtopic-dropdown').hide();
            }
        });

        // When the topic dropdown changes
        $('#topic-dropdown').on('change', function() {
            var topicId = $(this).val();
            if (topicId) {
                // Make an AJAX request to get subtopics for the selected topic
                $.ajax({
                    url: '{{ route('getSubtopics') }}'
                    , type: 'GET'
                    , data: {
                        topic_id: topicId
                    }
                    , success: function(data) {
                        // Clear existing options and append new options
                        $('#subtopic-dropdown').empty();
                        $('#subtopic-dropdown').append($('<option value="" disabled>Select a subtopic</option>'));
                        $.each(data, function(key, value) {
                            $('#subtopic-dropdown').append($('<option value="' + key + '">' + value + '</option>'));
                        });
                        // Show the subtopic dropdown
                        $('#subtopic-dropdown').show();
                    }
                });
            } else {
                // If no topic is selected, hide the subtopic dropdown
                $('#subtopic-dropdown').hide();
            }
        });



    });

</script>
