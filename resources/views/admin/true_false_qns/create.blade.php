<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
@include('admin.css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.navbar')

        <div class="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">True/False Questions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create </li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">

                        <div id="error-message" style="color: red; display: none;">Please fill in all required fields.</div>
                        <div id="error-options-message" style="color: red; display: none;">Please fill in at least one option (A, B, C, D, or E).</div>

                        <div class="container">
                            <h2>True/False Question</h2> <br>


                            <form method="POST" action="{{ route('admin.true_false_qns.store') }}" onsubmit="return validateForm()">
                                @csrf
                                <div class="container">
                                    <div class="row">

                                        <div class="col-md-4 form-group">
                                            <label for="subject_id">Select Subject:</label>
                                            <select name="subject_id" class="form-control" id="subject-dropdown">
                                                <option value="" disabled>Select a subject</option>
                                                @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                                @endforeach
                                            </select>


                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="topic_id">Select Topic:</label>
                                            <select name="topic_id" class="form-control" id="topic-dropdown">
                                                <option value="" disabled>Select a topic</option>
                                            </select>
                                            <div id="no-topics-msg" style="display: none; color: red;">No topics available for the selected subject.</div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="subtopic_id">Select Subtopic:</label>
                                            <select name="subtopic_id" class="form-control" id="subtopic-dropdown">
                                                <option value="" disabled>Select a subtopic</option>
                                            </select>
                                            <div id="no-subtopics-msg" style="display: none; color: red;">No subtopics available for the selected topic.</div>
                                        </div>
                                    </div>



                                    
                                    <div class="row">
                                        <div class="col -md-6 form-group">
                                            <label for="question_text">Question Text:</label>
                                            <textarea class="form-control" rows="4" name="question_text" id="question_text" required></textarea>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="marks">Marks:</label>

                                            <input type="number" class="form-control" name="marks" id="marks" min="1" max="10" required>

                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="correct_answer">Correct Answer</label>
                                                    <select name="correct_answer" class="form-control">
                                                        <option value="true">True</option>
                                                        <option value="false">False</option>
                                                    </select>
                                                </div>


                                            </div>

                                            <button type="submit" class="btn btn-primary">Create Question</button>
                            </form>
                            <script>
                                function validateForm() {
                                    // Get values of required fields
                                    const questionText = document.getElementById('question_text').value;
                                    const marks = document.getElementById('marks').value;

                                    // Get values of options
                                    const optionA = document.getElementById('option_a').value;
                                    const optionB = document.getElementById('option_b').value;
                                    const optionC = document.getElementById('option_c').value;
                                    const optionD = document.getElementById('option_d').value;


                                    // Check if required fields are empty
                                    if (questionText === '' || marks === '') {
                                        // Display the error message
                                        document.getElementById('error-message').style.display = 'block';
                                        return false; // Prevent form submission
                                    }

                                    // Check if at least one option is filled
                                    if (optionA === '' && optionB === '' && optionC === '' && optionD) {
                                        // Display the error message for options
                                        document.getElementById('error-options-message').style.display = 'block';
                                        return false; // Prevent form submission
                                    }

                                    return true; // Allow form submission
                                }

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
