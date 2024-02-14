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
                        <h3 class="page-title"> Edit About Us </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Welcome page</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.website_settings.index') }}">About Us</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert"
                                            style="max-width: 400px;">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="container">
                                        <h1>Edit About Us</h1>

                                        <form method="post" action="{{ route('admin.website_settings.update', $aboutUsContent) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <!-- Add your form fields here. For example: -->
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    value="{{ $aboutUsContent->title }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control"
                                                    rows="4">{{ $aboutUsContent->description }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input type="file" name="image" id="image" class="form-control-file">
                                            </div>

                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>
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
