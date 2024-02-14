<div class="container">
    <h1>Questions List</h1>

    <!-- Filter Form -->
    {{-- <form action="{{ route('filterQuestions') }}" method="GET">
        @csrf

        <div class="form-group">
            <label for="filter">Filter by:</label>
            <select name="filter" id="filter" class="form-control">
                <option value="subjects">Subjects</option>
                <option value="topics">Topics</option>
                <option value="subtopics">Subtopics</option>
            </select>
        </div>

        <div id="subject-filter" class="form-group">
            <label for="subject_id">Select Subject:</label>
            <select name="subject_id" class="form-control">
                <option value="" disabled>Select a subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                @endforeach
            </select>
        </div>

        <div id="topic-filter" class="form-group" style="display: none;">
            <label for="topic_id">Select Topic:</label>
            <select name="topic_id" class="form-control">
                <option value="" disabled>Select a topic</option>
            </select>
        </div>

        <div id="subtopic-filter" class="form-group" style="display: none;">
            <label for="subtopic_id">Select Subtopic:</label>
            <select name="subtopic_id" class="form-control">
                <option value="" disabled>Select a subtopic</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Apply Filter</button>
    </form> --}}

    <!-- List of Filtered Questions -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question Text</th>
                <th>Subject</th>
                <th>Topic</th>
                <th>Subtopic</th>
            </tr>
        </thead>
        <tbody>
            @foreach($filteredQuestions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->question_text }}</td>
                    <td>{{ $question->subject->subject_name }}</td>
                    <td>{{ $question->topic->topic_name }}</td>
                    <td>{{ $question->subtopic->subtopic_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Show/hide filter fields based on the selected filter criteria
    $('#filter').on('change', function () {
        var selectedFilter = $(this).val();
        $('#subject-filter, #topic-filter, #subtopic-filter').hide();
        
        if (selectedFilter === 'subjects') {
            $('#subject-filter').show();
        } else if (selectedFilter === 'topics') {
            $('#subject-filter').show();
            $('#topic-filter').show();
        } else if (selectedFilter === 'subtopics') {
            $('#subject-filter').show();
            $('#topic-filter').show();
            $('#subtopic-filter').show();
        }
    });

    // Populate topics based on the selected subject
    $('#subject-filter select').on('change', function () {
        var subjectId = $(this).val();
        var $topicSelect = $('#topic-filter select');
        $topicSelect.empty();

        if (subjectId) {
            $.ajax({
                url: '{{ route('getTopics') }}',
                type: 'GET',
                data: {
                    subject_id: subjectId
                },
                success: function(data) {
                    $topicSelect.append('<option value="" disabled>Select a topic</option>');
                    $.each(data, function(key, value) {
                        $topicSelect.append('<option value="' + key + '">' + value + '</option>');
                    });
                    $('#topic-filter').show();
                }
            });
        }
    });

    // Populate subtopics based on the selected topic
    $('#topic-filter select').on('change', function () {
        var topicId = $(this).val();
        var $subtopicSelect = $('#subtopic-filter select');
        $subtopicSelect.empty();

        if (topicId) {
            $.ajax({
                url: '{{ route('getSubtopics') }}',
                type: 'GET',
                data: {
                    topic_id: topicId
                },
                success: function(data) {
                    $subtopicSelect.append('<option value="" disabled>Select a subtopic</option>');
                    $.each(data, function(key, value) {
                        $subtopicSelect.append('<option value="' + key + '">' + value + '</option>');
                    });
                    $('#subtopic-filter').show();
                }
            });
        }
    });
</script>
