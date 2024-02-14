<!-- resources/views/content-materials/index.blade.php -->





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
        @include('admin.navbar')

        <div class="container">




            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">



                        <h3 class="page-title">Post Contents</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Manage Post Contents</a></li>
                                <li class="breadcrumb-item active" aria-current="page">list</li>
                            </ol>
                        </nav>
                    </div>
                    @if(session('success'))
                    <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert"
                        style="max-width: 300px;">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('delete'))
                    <div id="flash-message" class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="max-width: 300px;">
                        {{ session('delete') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="row">


                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Button to trigger the modal -->
                                    <a href="{{ route('admin.post_contents.create') }}" class="btn btn-primary">Create
                                        New Post</a>
                                    <p class="card-description"> List of posts content created</p>

                                    <!-- <table class="table" id="search"> -->

                                    <div class="table-responsive">
                                        <div style="overflow-x: auto;">

                                            <table class="table" id="search">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Class Level</th> <!-- New Column -->
                                                        <th>Subject</th> <!-- New Column -->
                                                        <th>Topic</th> <!-- New Column -->
                                                        <th>Subtopic</th> <!-- New Column -->
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($posts as $post)
                                                    <tr>
                                                        <td>{{ $post->title }}</td>
                                                        <td>{{ $post->darasa->class_name }}</td>
                                                        <!-- Display class level -->
                                                        <td>{{ $post->subject->subject_name }}</td>
                                                        <!-- Display subject -->
                                                        <td>{{ $post->topic->topic_name }}</td> <!-- Display topic -->
                                                        <td>{{ $post->subtopic->subtopic_name }}</td>
                                                        <!-- Display subtopic -->
                                                        <td>{{ ucfirst($post->status) }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.post_contents.edit', $post) }}"
                                                                class="btn btn-primary">Edit</a>
                                                            <a href="{{ route('admin.post_contents.show', $post) }}"
                                                                class="btn btn-success">View</a>
                                                            <!-- Add View button -->
                                                            <form
                                                                action="{{ route('admin.post_contents.destroy', $post) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                  
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>
                </div>


                <script>
                    // Function to hide the flash message after 3 seconds
                    $(document).ready(function () {
                        setTimeout(function () {
                            $('#flash-message').alert('close');
                        }, 3000); // 3 seconds
                    });

                </script>

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

</body>

</html>
