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
                                <li class="breadcrumb-item"><a href="#">Welcome page</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Office contacts</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert"
                            style="max-width: 400px;">
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
                                                <div class="col-md-6 form-group">
                                                    <label for="subject_id">Select Subject:</label>
                                                    <select name="subject_id" class="form-control" id="subject-dropdown">
                                                        <option value="" disabled>Select a subject</option>
                                                        @foreach($subjects as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="topic_id">Select Topic:</label>
                                                    <select name="topic_id" class="form-control" id="topic-dropdown">
                                                        <option value="" disabled>Select a topic</option>
                                                    </select>
                                                    <div id="no-topics-msg" style="display: none; color: red;">No topics available
                                                        for the selected subject.</div>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="subtopic_id">Select Subtopic:</label>
                                                    <select name="subtopic_id" class="form-control" id="subtopic-dropdown">
                                                        <option value="" disabled>Select a subtopic</option>
                                                    </select>
                                                    <div id="no-subtopics-msg" style="display: none; color: red;">No
                                                        subtopics available for the selected topic.</div>
                                                </div>
                                            </div>

                                            <!-- Question Type Selection -->
                                            <div class="form-group">
                                                <label for="question-type">Select Question Type:</label>
                                                <select name="question_type" class="form-control" id="question-type">
                                                    <option value="" disabled>Select a question type</option>
                                                    <option value="Multiple Choice">Multiple Choice</option>
                                                    <option value="Short Answer">Short Answer</option>
                                                    <option value="True/False">True/False</option>
                                                    <!-- Add more question types here -->
                                                </select>
                                            </div>
                                            <div id="question-form-qn" style="display: none;">
                                                <!-- Main form fields -->
                                                <div class="form-group">
                                                    <label for="question_text">Question Text:</label>
                                                    <textarea class="form-control" rows="4"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="answer">Answer:</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="marks">Marks:</label>
                                                    <input type="number" class="form-control">
                                                </div>

                                                <!-- Form for Multiple Choice -->
                                                <div id="multiple-choice-fields" style="display: none;">
                                                    <label>Multiple Choice Options:</label>
                                                    <div class="form-group">
                                                        <label for="option-a">Option A:</label>
                                                        <input type="text" class="form-control" id="option-a">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="option-b">Option B:</label>
                                                        <input type="text" class="form-control" id="option-b">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="option-c">Option C:</label>
                                                        <input type="text" class="form-control" id="option-c">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="option-d">Option D:</label>
                                                        <input type="text" class="form-control" id="option-d">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="option-e">Option E:</label>
                                                        <input type="text" class="form-control" id="option-e">
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
                                        </form>

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
                                    </div>
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
