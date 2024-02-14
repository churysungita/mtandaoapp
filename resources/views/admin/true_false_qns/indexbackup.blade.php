
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
@include('admin.css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

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
                                <li class="breadcrumb-item active" aria-current="page">True/False Questions </li>
                            </ol>
                        </nav>

                        <div class="row">
                            <a href="{{ route('admin.true_false_qns.create') }}" class="btn btn-primary" style="background-color: #007bff; border: 1px solid #007bff; color: #fff; padding: 5px 10px; text-decoration: none; border-radius: 5px; display: inline-block;">
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





<div class="container">
    <div class="card">
        <div class="card-header">True/False Questions</div>
        <div class="card-body">
            <div class="table-responsive">
                    @foreach ($trueFalseQuestions as $question)
        <h3>True/False Question {{ $loop->iteration }}:</h3>
        <p>{{ $question->question_text }}</p>
        <p><strong>Marks:</strong> {{ $question->marks }}</p>
        <p><strong>Correct Answer:</strong> {{ $question->correct_answer }}
    @endforeach

            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    // Initialize the DataTable
    $(document).ready(function () {
        $('#questionTable').DataTable();
    });
</script>
@endpush




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


                        <script>
                            // Auto close the flash message after 3 seconds
                            setTimeout(function() {
                                $('#flash-message').alert('close');
                            }, 3000);

                        </script>
                        @endif



    </div>
</body>
</html>















