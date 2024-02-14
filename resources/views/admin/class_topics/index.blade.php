<!-- resources/views/admin/topics/index.blade.php -->


<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Custom CSS for beautifying the modal */

    </style>


</head>


<body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
    

        <div class="container">

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">

                        <h3 class="page-title"> Topics </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Manage Topics</a></li>
                                <li class="breadcrumb-item active" aria-current="page">list</li>
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


                        @if($errors->has('topic_name'))
                            <div class="alert alert-danger" style="max-width: 400px;">
                                <span class="text-danger" id="error-message" aria-hidden="true">
                                    {{ $errors->first('topic_name') }} &times;
                                </span>
                            </div>
                        @endif

                    
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">  <a href="{{ route('admin.classes.create') }}" class="btn btn-success mb-3">Create New Class</a></h4> -->
                                    <!-- Button to trigger the modal -->
                                    <button type="button" class="btn btn-success mb-3 btn-create-class"
                                        data-toggle="modal" data-target="#createClassModal">Create New Topic</button>

                                    <p class="card-description"> List of topics created</code>
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-contextual" id="search">
                                            <thead>
                                                <tr>
                                                <th>Subject</th> <!-- Add Subject column -->
                                                <th>Topic Name</th>
                                                <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                             
                                                @foreach($topics as $topic)

                                                    <tr>
                                                    <td>{{ $topic->subject->subject_name }}</td> <!-- Display subject_name -->
                                                    <td>{{ $topic->topic_name }}</td>

                                                        <td>

                                                            <!-- show button  -->

                                                            <button type="button"
                                                                class="btn btn-primary badge-success btn-show-class"
                                                                data-url="{{ route('admin.class_topics.show', ['topic' => $topic->id]) }}">
                                                                View
                                                            </button>



                                                            <!-- Edit button with data-url attribute -->
                                                            <a href="#"
                                                                data-url="{{ route('admin.class_topics.edit', ['topic' => $topic->id]) }}"
                                                                class="btn btn-warning badge-warning btn-edit-class">Edit</a>

                                                             

                                                            <!-- Delete button with a form -->
                                                            <form method="POST"
                                                                action="{{ route('admin.class_topics.destroy', ['topics' => $topic->id]) }}"

                            
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger  badge-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this class?')">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- Create Class Modal -->
                                        <div class="modal fade" id="createClassModal" tabindex="-1" role="dialog"
                                            aria-labelledby="createClassModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal content will be loaded here using AJAX -->
                                                </div>
                                            </div>
                                        </div>





                                        <!-- Edit Class Modal -->
                                        <div class="modal fade" id="editClassModal" tabindex="-1" role="dialog"
                                            aria-labelledby="editClassModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal content will be loaded here using AJAX -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Show Class Modal -->
                                        <div class="modal fade" id="showClassModal" tabindex="-1" role="dialog"
                                            aria-labelledby="showClassModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="showClassModalLabel">Class Details
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Modal content will be loaded here using AJAX -->
                                                        <div id="showClassModalContent">
                                                            <!-- The content fetched via AJAX will be inserted here -->
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Close button within the modal footer -->
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
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
                <footer class="footer">

                </footer>
                <!-- partial -->
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

<!-- Your existing HTML code -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script>
@include('admin.table_datatable_js')

<script>
    // Add JavaScript/jQuery to fade out the error message
    $(document).ready(function () {
        // Delay the fading out of the error message by 3 seconds (adjust as needed)
        setTimeout(function () {
            $('#error-message').fadeOut('slow');
        }, 3000); // 3000 milliseconds (3 seconds)
    });

</script>
<script>
    $(document).ready(function () {
        // Function to load the "Create New Class" modal content
        function loadCreateClassModal() {
            $.get('{{ route('admin.class_topics.create') }}', function (data) {
                $('#createClassModal .modal-content').html(data);
            });
        }

        // Handle the modal show event to open the "Create New Class" modal
        $('#createClassModal').on('show.bs.modal', function (e) {
            loadCreateClassModal();
        });

        // Handle the click event to open the "Create New Class" modal
        $('.btn-create-class').click(function () {
            $('#createClassModal').modal('show');
        });



        // JavaScript code to handle the Edit button click event
        $(document).ready(function () {
            // Click event for the Edit button
            $('.btn-edit-class').on('click', function (e) {
                e.preventDefault(); // Prevent the default link behavior

                // Get the URL from the data-url attribute
                var editUrl = $(this).data('url');

                // Make an AJAX request to fetch the data for editing
                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    dataType: 'html',
                    success: function (data) {
                        // Populate the modal content with the fetched data
                        $('#editClassModal .modal-content').html(data);

                        // Open the modal
                        $('#editClassModal').modal('show');
                    },
                    error: function () {
                        alert('An error occurred while fetching data for editing.');
                    }
                });
            });
        });

        // JavaScript code to handle the form submission within the modal
        $(document).on('submit', '#editClassForm', function (e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: $(this).attr('action'), // Form action URL
                type: 'POST',
                data: formData,
                success: function (response) {
                    // Handle success, e.g., close the modal or display a success message
                    $('#editClassModal').modal('hide');
                    // You can also update the page content with the updated data here without a full page refresh.

                    // Optionally, trigger a page reload after a short delay (e.g., 1 second)
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                error: function () {
                    alert('An error occurred while updating the data.');
                }
            });
        });





        // show modal

        $(document).ready(function () {
            // Click event for the Show button
            $('.btn-show-class').on('click', function (e) {
                e.preventDefault(); // Prevent the default link behavior

                // Get the URL from the data-url attribute
                var showUrl = $(this).data('url');

                // Make an AJAX request to fetch the data for showing
                $.ajax({
                    url: showUrl,
                    type: 'GET',
                    dataType: 'html',
                    success: function (data) {
                        // Populate the modal content with the fetched data
                        $('#showClassModal .modal-content').html(data);

                        // Open the modal
                        $('#showClassModal').modal('show');
                    },
                    error: function () {
                        alert('An error occurred while fetching data for showing.');
                    }
                });
            });
        });







        // Automatically close the success message after 3 seconds
        setTimeout(function () {
            $('.alert').alert('close');
        }, 3000);
    });

</script>

</body>

</html>


