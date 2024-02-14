
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
@include('admin.css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->


        <div class="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Normal Questions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create </li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">

                        <div id="error-message" style="color: red; display: none;">Please fill in all required fields.</div>
                        <div id="error-options-message" style="color: red; display: none;">Please fill in at least one option (A, B, C, D, or E).</div>

                        <div class="container">
                            <h2>Normal Questions</h2> <br>


                            <form method="POST" action="{{ route('admin.post_contents.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Title" required>
                                        </div>
                                        <!-- Existing form fields for class levels, subjects, topics, and subtopics -->
                                        <div class="form-group">
                                            <label for="darasa_id">Select Class level:</label>
                                            <select name="darasa_id" id="darasa_id" class="form-control">
                                                <option value="" disabled selected>Select a class</option>
                                                @foreach($darasa as $classes)
                                                <option value="{{ $classes->id }}">{{ $classes->class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject_id">Select Subject:</label>
                                            <select name="subject_id" id="subject_id"
                                                class="form-control @error('subject_id') is-invalid @enderror">
                                                <option value="" disabled selected>Select a subject</option>
                                                @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="topic_id">Select Topic:</label>
                                            <select name="topic_id" id="topic_id" class="form-control" required>
                                                <option value="" disabled selected>Select a topic</option>
                                                @foreach($topics as $topic)
                                                <option value="{{ $topic->id }}">{{ $topic->topic_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subtopic_id">Select Subtopic:</label>
                                            <select name="subtopic_id" id="subtopic_id" class="form-control" required>
                                                <option value="" disabled selected>Select a subtopic</option>
                                                @foreach($subtopics as $subtopic)
                                                <option value="{{ $subtopic->id }}">{{ $subtopic->subtopic_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editor">Content</label>
                                            <textarea id="summernote" name="content" class="form-control"
                                                rows="10"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="draft">Draft</option>
                                                <option value="published">Published</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#summernote').summernote({
                                                height: 500,
                                            });
                                        });

                                    </script>

                        
                     

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

                        </div>


                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer"></footer>
                <!-- partial -->
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->

    </div>
</body>
</html>
