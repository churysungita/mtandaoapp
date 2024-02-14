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
                                <li class="breadcrumb-item"><a href="#">Questions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Questions</li>
                            </ol>
                        </nav>

                      

                    </div>

                    <div class="row">


                        @if(session('success'))
                        <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert" style="max-width: 300px;">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(session('delete'))
                        <div id="flash-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="max-width: 300px;">
                            {{ session('delete') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>



                        <script>
                            // Auto close the flash message after 3 seconds
                            setTimeout(function() {
                                $('#flash-message').alert('close');
                            }, 3000);

                        </script>
                        @endif



                        <style>
                            /* Add custom CSS to increase the row height, center the contents, and wrap long lines */
                            .table tbody tr td {
                                padding: 20px;
                                /* Adjust this value to control the height */
                                text-align: center;
                                /* Center the text horizontally */
                                vertical-align: middle;
                                /* Center the text vertically */
                                white-space: normal;
                                /* Wrap long lines onto the next line */
                                line-height: 1.5;
                                /* Adjust this value to add space between lines */
                            }

                        </style>



                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="container">
                                        <h1>Filter Questions</h1>
                                        <form method="GET" action="{{ route('admin.DisplayQuestions.index') }}">
                                            <select id="subject-dropdown" name="subject_id">
                                                <option value="" selected>Select a subject</option>
                                                @foreach($subjects as $subjectId)
                                                @php
                                                $subject = \App\Models\Subject::find($subjectId);
                                                @endphp
                                                <option value="{{ $subjectId }}" {{ request('subject_id') == $subjectId ? 'selected' : '' }}>
                                                    {{ $subject->subject_name }} <!-- Display the subject name -->
                                                </option>
                                                @endforeach
                                            </select>

                                            <select id="topic-dropdown" name="topic_id">
                                                <option value="" selected>Select a topic</option>
                                                @foreach($topics as $topicId)
                                                @php
                                                $topic = \App\Models\Topic::find($topicId);
                                                @endphp
                                                <option value="{{ $topicId }}" {{ request('topic_id') == $topicId ? 'selected' : '' }}>
                                                    {{ $topic->topic_name }} <!-- Display the topic name -->
                                                </option>
                                                @endforeach
                                            </select>

                                            <select id="subtopic-dropdown" name="subtopic_id">
                                                <option value="" selected>Select a subtopic</option>
                                                @foreach($subtopics as $subtopicId)
                                                @php
                                                $subtopic = \App\Models\Subtopic::find($subtopicId);
                                                @endphp
                                                <option value="{{ $subtopicId }}" {{ request('subtopic_id') == $subtopicId ? 'selected' : '' }}>
                                                    {{ $subtopic->subtopic_name }} <!-- Display the subtopic name -->
                                                </option>
                                                @endforeach
                                            </select>


                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </form>
                                        <br>
                                        <br>
                                        <hr>
                                        <br>
                                        <br>
                                        <h2>Long Questions</h2>
                                        <br>
                                        <br>
                                        <hr>
                                        <br>
                                        <br>
                                        @foreach ($longQuestions as $question)
                                        <h3>Long Question {{ $loop->iteration }}:</h3>
                                        {!! $question->question_text !!}
                                        <p><strong>Marks:</strong> {{ $question->marks }}</p>
                                        <p><strong>Correct Answer:</strong> {!! $question->correct_answer !!}
                                            @endforeach

                                            <br>
                                            <br>
                                            <hr>
                                            <br>
                                            <br>
                                            <h2>True/False Questions</h2>
                                            <br>
                                            <br>
                                            <hr>
                                            <br>
                                            <br>
                                            @foreach($trueFalseQuestions as $question)
                                            <h3>True/False Question {{ $loop->iteration }}:</h3>
                                            <p>{!! $question->question_text !!}</p>
                                            <p><strong>Marks:</strong> {{ $question->marks }}</p>
                                            <p><strong>Correct Answer:</strong>{!! $question->correct_answer !!}
                                                @endforeach
                                                <br>
                                                <br>
                                                <hr>
                                                <br>
                                                <br>
                                                <h2>Multiple-Choice Questions</h2>
                                                <br>
                                                <br>
                                                <hr>
                                                <br>
                                                <br>
                                                @foreach ($multipleChoiceQuestions as $question)
                                                <h3>Multiple Choice Question {{ $loop->iteration }}:</h3>
                                                <p>{{ $question->question_text }}</p>
                                                <p><strong>Marks:</strong> {{ $question->marks }}</p>
                                                <ol type="A">
                                                    <li>{{ $question->option_a }}</li>
                                                    <li>{{ $question->option_b }}</li>
                                                    <li>{{ $question->option_c }}</li>
                                                    <li>{{ $question->option_d }}</li>
                                                    @if (!empty($question->option_e))
                                                    <li>{{ $question->option_e }}</li>
                                                    @endif
                                                </ol>
                                                <p><strong>Correct Answer:</strong>
                                                    @if ($question->correct_answer === 'option_a')
                                                    A
                                                    @elseif ($question->correct_answer === 'option_b')
                                                    B
                                                    @elseif ($question->correct_answer === 'option_c')
                                                    C
                                                    @elseif ($question->correct_answer === 'option_d')
                                                    D
                                                    @elseif ($question->correct_answer === 'option_e')
                                                    E
                                                    @endif
                                                </p>
                                                @endforeach
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
                                                            $('#subtopic-dropdown').empty();
                                                            $('#topic-dropdown').append($('<option value="" disabled>Select a topic</option>'));
                                                            $('#subtopic-dropdown').append($('<option value="" disabled>Select a subtopic</option>'));
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
        @include('admin.table_datatable_js')



    </div>
</body>
</html>





















