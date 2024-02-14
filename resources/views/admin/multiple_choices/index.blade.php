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
    

        <div class="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Questions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Multiple Choices </li>
                            </ol>
                        </nav>

                        <div class="row">
                            <a href="{{ route('admin.multiple_choices.create') }}" class="btn btn-primary" style="background-color: #007bff; border: 1px solid #007bff; color: #fff; padding: 5px 10px; text-decoration: none; border-radius: 5px; display: inline-block;">
                                <span style="margin-right: 5px;"><i class="fas fa-plus"></i></span> Create New Question
                            </a>
                        </div>

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
        padding: 20px; /* Adjust this value to control the height */
        text-align: center; /* Center the text horizontally */
        vertical-align: middle; /* Center the text vertically */
        white-space: normal; /* Wrap long lines onto the next line */
        line-height: 1.5; /* Adjust this value to add space between lines */
    }
</style>


                        <div class="container">

                            <div class="container">
                                <h1>Multiple Choice Questions</h1>



                                <div class="table-responsive">
                                    <table class="table table-bordered table-contextual" id="search">
                                        <thead>
                                            <tr>

                                                <th>Subject</th>
                                                <th>Topic</th>
                                                <th>Subtopic</th>
                                                <th>Question Text</th>
                                                <th>Marks</th>
                                                <th>Options</th>
                                                <th>Correct Answer</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($multipleChoiceQuestions as $question)
                                            <tr>
                                                <td>

                                                    @if ($question->subject)
                                                    {{ $question->subject->subject_name }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($question->topic)
                                                    {{ $question->topic->topic_name }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($question->subtopic)
                                                    {{ $question->subtopic->subtopic_name }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td>{{ $question->question_text }}</td>
                                                <td>{{ $question->marks }}</td>
                                                <td>
                                                    A: {{ $question->option_a }}<br>
                                                    B: {{ $question->option_b }}<br>
                                                    C: {{ $question->option_c }}<br>
                                                    D: {{ $question->option_d }}<br>
                                                    @if ($question->option_e)
                                                    E: {{ $question->option_e }}<br>
                                                    @endif
                                                </td>
                                                <td>{{ $question->correct_answer }}</td>
                                                <td>
                                                    <!-- Delete button -->
                                                    <form action="{{ route('admin.multiple_choices.destroy', $question->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
