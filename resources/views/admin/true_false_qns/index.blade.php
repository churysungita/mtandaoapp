
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
@include('admin.css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    /* Add custom CSS to increase the row height, center the contents, and wrap long lines */
   body {
        text-align: center; /* Center the text horizontally */
        vertical-align: middle; /* Center the text vertically */
        white-space: normal; /* Wrap long lines onto the next line */
        line-height: 7.5; /* Adjust this value to add space between lines */
    }
</style>


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
                                <li class="breadcrumb-item active" aria-current="page">Normal Question</li>
                            </ol>
                        </nav>

                        <div class="row">
                            <a href="{{ route('admin.long_questions.create') }}" class="btn btn-primary" style="background-color: #007bff; border: 1px solid #007bff; color: #fff; padding: 5px 10px; text-decoration: none; border-radius: 5px; display: inline-block;">
                                <span style="margin-right: 5px;"><i class="fas fa-plus"></i></span> Create New Question
                            </a>
                        </div>

                    </div>

                    <div class="row">






<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">True /False Questions</div>

                <div class="card-body">
          

                    <div class="table-responsive">
                        <table class="table table-bordered table-contextual" id="search">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Topic</th>
                                    <th>Subtopic</th>
                                    <th>Question Text</th>
                                    <th>Marks</th>
                                    <th>Correct Answer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trueFalseQuestions as $question)
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
                                    <td>{!! $question->question_text !!}</td>
                                    <td>{{ $question->marks }}</td>
                                    <td>{!! $question->correct_answer !!}</td>
                                    <td>
                                        <a href="{{ route('admin.long_questions.edit', $question->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('admin.long_questions.destroy', $question->id) }}" method="POST"
                                            style="display: inline;">
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















