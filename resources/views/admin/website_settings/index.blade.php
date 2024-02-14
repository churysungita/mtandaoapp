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
                        <h3 class="page-title"> About Us </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Welcome page</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About us</li>
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
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ route('admin.website_settings.create') }}">CREATE NEW ABOUT</a>

                                    <div class="container">
                                        <h1>About Us</h1>
                                        @if ($aboutUsContent)
                                            <div class="table-responsive" style="color:white !important;">
                                                <table class="table table-bordered table-striped" style="color: white;">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>Image</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="color: white;">{{ $aboutUsContent->title }}</td>
                                                            <td style="color: white;">{{ $aboutUsContent->description }}</td>
                                                            <td>
                                                                <img src="{{ asset($aboutUsContent->image_path) }}"
                                                                    alt="About Us Image" class="img-responsive">
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.website_settings.show', $aboutUsContent) }}"
                                                                    class="btn btn-primary">View</a>
                                                                <a href="{{ route('admin.website_settings.edit', $aboutUsContent) }}"
                                                                    class="btn btn-success">Edit</a>
                                                                <form method="post"
                                                                    action="{{ route('admin.website_settings.destroy', $aboutUsContent) }}"
                                                                    style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger"
                                                                        onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p>No About Us content found.</p>
                                        @endif
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
    </div>

    <!-- Your existing HTML code -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Add JavaScript/jQuery to fade out the error message
        $(document).ready(function () {
            // Delay the fading out of the error message by 3 seconds (adjust as needed)
            setTimeout(function () {
                $('#error-message').fadeOut('slow');
            }, 3000); // 3000 milliseconds (3 seconds)
        });
    </script>
</body>

</html>

<script>
    // Automatically close the success message after 3 seconds
    setTimeout(function () {
        $('.alert').alert('close');
    }, 3000);
</script>
