<!-- resources/views/content-materials/create.blade.php -->


<div class="container">
    <h1 class="display-4 mb-4">Create New Content Material</h1>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.content_materials.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="darasa_id">Select Class level:</label>
                    <select name="darasa_id" id="darasa_id" class="form-control">
                        <option value="" disabled selected>Select a class</option>
                        @foreach($darasa as $classes)
                        <option value="{{ $classes->id }}">{{ $classes->class_name }}</option>
                        @endforeach
                    </select>
                    @error('class_name_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

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
                    <label for="subtopic_id">Select Subtopic:</label>
                    <select name="subtopic_id" class="form-control" id="subtopic-dropdown">
                        <option value="" >Select a subtopic</option>
                    </select>
                    <div id="no-subtopics-msg" style="display: none; color: red;">No subtopics available for the selected topic.</div>
                </div>

                <div class="form-group">
                    <label for="file">Upload File (Video or PPT):</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Content Material</button>
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