<!DOCTYPE html>
<html lang="en">

<head>
    @include("admin.css")

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Custom CSS for beautifying the modal */

    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        {{-- @include('admin.sidebar') --}}

        @include('admin.sidebar')
        <!-- partial -->
        {{-- @include('admin.navbar') --}}

        @include('admin.navbar')

        <div class="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Create Questions</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Questions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Questions</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert" style="max-width: 400px;">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="col-lg-12 stretch-card">
                            <div class="container">

                                <div>
                                    <div class="container">
                                        <h2 class="my-4">Create New Question</h2>

                                        <form id="question-form" action="{{ route('admin.Questions.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-3 form-group">
                                                    <label for="subject_id">Select Subject:</label>
                                                    <select name="subject_id" class="form-control" id="subject-dropdown">
                                                        <option value="" disabled>Select a subject</option>
                                                        @foreach($subjects as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label for="topic_id">Select Topic:</label>
                                                    <select name="topic_id" class="form-control" id="topic-dropdown">
                                                        <option value="" disabled>Select a topic</option>
                                                    </select>
                                                    <div id="no-topics-msg" style="display: none; color: red;">No topics available for the selected subject.</div>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label for="subtopic_id">Select Subtopic:</label>
                                                    <select name="subtopic_id" class="form-control" id="subtopic-dropdown">
                                                        <option value="" disabled>Select a subtopic</option>
                                                    </select>
                                                    <div id="no-subtopics-msg" style="display: none; color: red;">No subtopics available for the selected topic.</div>
                                                </div>

                                                <div class="col-md-3 form-group">
                                                    <label for="question-type">Select Question Type:</label>
                                                    <select name="type" class="form-control" id="question-type">
                                                        <option value="" disabled>Select a question type</option>
                                                        <option value="Multiple Choice">Multiple Choice</option>
                                                        <option value="Short Answer">Short Answer</option>
                                                        <option value="True/False">True/False</option>
                                                        <!-- Add more question types here -->
                                                    </select>
                                                </div>

                                            </div>




                                    </div>

                                    <!-- Question Type Selection -->



                                    <div id="question-form-qn" style="display: none;">

                                        <!-- Form for Multiple Choice -->
                                        <div id="multiple-choice-fields" style="display: none;">
                                            <div class="row">
                                                <!-- First Column - First Row -->
                                                <div class="col-md-6">
                                                    <!-- Main form fields -->
                                                    <div class="form-group" required>
                                                        <label for="question_text">Question Text:</label>
                                                        <textarea class="form-control" rows="8" name="question_text"></textarea>
                                                    </div>
                                                </div>
                                                <!-- First Column - Second Row -->
                                                <div class="col-md-6" required>
                                                    <div class="form-group">
                                                        <label for="marks">Marks:</label>
                                                        <input type="number" class="form-control" name="marks">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Second Column - First Row -->
                                                <div class="col-md-6" required>
                                                    <label>Multiple Choice Options:</label>
                                                    <div class="form-group">
                                                        <label for="option-a">Option A:</label>
                                                        <input type="text" class="form-control" name="option_a" id="option-a">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="option-c">Option C:</label>
                                                        <input type="text" class="form-control" name="option_c" id="option-c">
                                                    </div>
                                                </div>
                                                <!-- Second Column - Second Row -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="option-b">Option B:</label>
                                                        <input type="text" class="form-control" name="option_b" id="option-b">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="option-d">Option D:</label>
                                                        <input type="text" class="form-control" name="option_d" id="option-d">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="option-e">Option E:</label>
                                                        <input type="text" class="form-control" name="option_e" id="option-e">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correct-answer">Correct Answer:</label>
                                                        <select class="form-control" name="answer" id="answer">
                                                            <option value="option_a" >Option A</option>
                                                            <option value="option_b" >Option B</option>
                                                            <option value="option_c" >Option C</option>
                                                            <option value="option_d" >Option D</option>
                                                            <option value="option_e" >Option E</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>




                                    <!-- Form for Short Answer -->
                                     <div id="short-answer-fields" style="display: none;">
                                        <div class="form-group">
                                            <label for="short-answer">Short Answer:</label>
                                            <input type="text" class="form-control" id="short-answer">
                                        </div>
                                    </div>

                                    <!-- Form for True/False -->
                                    <div id="true-false-fields" style="display: none;">
                                        <div class="form-group">
                                            <label for="true-false-answer">True/False Answer:</label>
                                            <select class="form-control" id="true-false-answer">
                                                <option value="true">True</option>
                                                <option value="false">False</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 


                                <!-- ... Rest of the form fields ... -->
<button id="save-button" type="submit" class="btn btn-primary my-3" disabled>Save Questions</button>
                               
                               
                           
                                </form>

                               <script>
    $(document).ready(function() {
        // Function to check if all required fields are filled
        function checkRequiredFields() {
            var requiredFields = [
                'subject_id',
                'topic_id',
                'subtopic_id',
                'type',
                'question_text',
                'marks',
            ];

            for (var i = 0; i < requiredFields.length; i++) {
                var fieldName = requiredFields[i];
                var fieldValue = $('[name="' + fieldName + '"]').val();
                if (!fieldValue) {
                    return false;
                }
            }

            // Additional validation checks can be added here

            return true;
        }

        // Function to enable or disable the "Save Questions" button
        function toggleSaveButton() {
            var allFieldsFilled = checkRequiredFields();
            if (allFieldsFilled) {
                $('#save-button').prop('disabled', false);
            } else {
                $('#save-button').prop('disabled', true);
            }
        }

        // Check required fields on page load
        toggleSaveButton();

        // Handle input changes
        $('input, select, textarea').on('input change', function() {
            toggleSaveButton();
        });

        // Handle form submission
        $('#question-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize the form data
            var formData = $(this).serialize();

            // Send the data to the server using an AJAX POST request
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Use the form's action attribute
                data: formData,
                success: function(response) {
                    // Handle the response from the server (e.g., show success message)
                    if (response.success) {
                        // Display a success message or redirect the user
                        alert('Questions saved successfully');
                    } else {
                        // Handle errors, if any
                        alert('Failed to save questions');
                    }
                },
           
            });
        });
    });
</script>


                      

                                <script>
                                    $(document).ready(function() {
                                        $('#question-type').on('change', function() {
                                            var selectedType = $(this).val();
                                            if (selectedType) {
                                                $('#question-form-qn').show();

                                                // Hide all question type specific fields
                                                $('#multiple-choice-fields').hide();
                                                $('#short-answer-fields').hide();
                                                $('#true-false-fields').hide();

                                                if (selectedType === 'Multiple Choice') {
                                                    $('#multiple-choice-fields').show();
                                                } else if (selectedType === 'Short Answer') {
                                                    $('#short-answer-fields').show();
                                                } else if (selectedType === 'True/False') {
                                                    $('#true-false-fields').show();
                                                }
                                                // Add similar blocks for other question types
                                            } else {
                                                $('#question-form-qn').hide();
                                            }
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


    <!-- Your existing HTML code -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Add JavaScript/jQuery to fade out the error message
        $(document).ready(function() {
            // Delay the fading out of the error message by 3 seconds (adjust as needed)
            setTimeout(function() {
                $('#error-message').fadeOut('slow');
            }, 3000); // 3000 milliseconds (3 seconds)
        });

    </script>
</body>

</html>

<script>
    // Automatically close the success message after 3 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 3000);

</script>
