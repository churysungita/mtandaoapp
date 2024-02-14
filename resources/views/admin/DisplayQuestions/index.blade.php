<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
       
        <div class="container">
            <div class="main-panel">

                <div class="container">
                    <div class="row">
         
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="background-color:#0d6efd;">
                                    <h1>Filter Questions</h1>
                                    <form method="GET" action="{{ route('admin.DisplayQuestions.index') }}">
                                        <div class="row">
                                          <div class="col-md-3">
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
                                        </div>

                                            <div class="col-md-3">
                                                <select id="topic-dropdown" name="topic_id" class="form-control">
                                                    <option value="" selected>Select a topic</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="subtopic-dropdown" name="subtopic_id" class="form-control">
                                                    <option value="" selected>Select a subtopic</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" id="filter-button" class="btn btn-primary">Filter Questions</button>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <button type="button" id="show-all" class="btn btn-primary" style="padding: 5px 10px;">Show All</button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" id="show-mcq" class="btn btn-primary" style="padding: 5px 10px;">Show MCQ</button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" id="show-normal" class="btn btn-primary" style="padding: 5px 10px;">Show Normal</button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" id="show-true-false" class="btn btn-primary" style="padding: 5px 10px;">Show True/False</button>
                                            </div>
                                        </div>

                                        <script>
                                            function changeBackgroundColor(button, color) {
                                                button.style.backgroundColor = color;
                                            }

                                        </script>


                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="page-header">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Exam Questions</a></li>
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
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#topic-dropdown, #subtopic-dropdown').hide();

                        $('#subject-dropdown').on('change', function() {
                            var subjectId = $(this).val();
                            if (subjectId) {
                                $.ajax({
                                    url: '{{ route('getTopics') }}'
                                    , type: 'GET'
                                    , data: {
                                        subject_id: subjectId
                                    }
                                    , success: function(data) {
                                        $('#topic-dropdown').empty();
                                        $('#subtopic-dropdown').empty();
                                        $('#topic-dropdown').append($('<option value="" disabled>Select a topic</option>'));
                                        $('#subtopic-dropdown').append($('<option value="" disabled>Select a subtopic</option>'));
                                        $.each(data, function(key, value) {
                                            $('#topic-dropdown').append($('<option value="' + key + '">' + value + '</option>'));
                                        });
                                        $('#topic-dropdown').show();
                                    }
                                });
                            } else {
                                $('#topic-dropdown, #subtopic-dropdown').hide();
                            }
                        });

                        $('#topic-dropdown').on('change', function() {
                            var topicId = $(this).val();
                            if (topicId) {
                                $.ajax({
                                    url: '{{ route('getSubtopics') }}'
                                    , type: 'GET'
                                    , data: {
                                        topic_id: topicId
                                    }
                                    , success: function(data) {
                                        $('#subtopic-dropdown').empty();
                                        $('#subtopic-dropdown').append($('<option value="" disabled>Select a subtopic</option>'));
                                        $.each(data, function(key, value) {
                                            $('#subtopic-dropdown').append($('<option value="' + key + '">' + value + '</option>'));
                                        });
                                        $('#subtopic-dropdown').show();
                                    }
                                });
                            } else {
                                $('#subtopic-dropdown').hide();
                            }
                        });

                        $('#filter-button').click(function() {
                            var subjectId = $('#subject-dropdown').val();
                            var topicId = $('#topic-dropdown').val();
                            var subtopicId = $('#subtopic-dropdown').val();

                            // Make an AJAX request to fetch filtered data
                            $.ajax({
                                url: '{{ route('admin.DisplayQuestions.index') }}'
                                , type: 'GET'
                                , data: {
                                    subject_id: subjectId
                                    , topic_id: topicId
                                    , subtopic_id: subtopicId
                                }
                                , success: function(data) {
                                    // Update the page with the filtered questions
                                    $('.content-wrapper').html(data);
                                }
                            });
                        });

                        // Initial visibility of question types
                        $('.question-container').show();

                        // Add an event listener for the "Show All" button
                        $('#show-all').click(function() {
                            $('.question-container').show();
                        });

                        // Add an event listener for the "Show MCQ" button
                        $('#show-mcq').click(function() {
                            $('.question-container').hide();
                            $('.mcq-question').show();
                        });

                        // Add an event listener for the "Show Normal" button
                        $('#show-normal').click(function() {
                            $('.question-container').hide();
                            $('.normal-question').show();
                        });

                        // Add an event listener for the "Show True/False" button
                        $('#show-true-false').click(function() {
                            $('.question-container').hide();
                            $('.true-false-question').show();
                        });
                    });
                    

                </script>
         
                <footer class="footer"></footer>


                      @include('admin.script')
                         @include('admin.table_datatable_js')

            </div>
        </div>
    </div>
</body>
</html>
