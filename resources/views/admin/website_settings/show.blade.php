<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

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
                        <h3 class="page-title"> About Us </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Welcome page</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.website_settings.index') }}">About Us</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Show</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <h1>About Us Details</h1>
                                        @if ($aboutUsContent)
                                            <div class="card mb-3" style="max-width: 540px;">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4">
                                                        <img src="{{ asset($aboutUsContent->image_path) }}"
                                                            alt="About Us Image" class="img-fluid">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $aboutUsContent->title }}</h5>
                                                            <p class="card-text">{{ $aboutUsContent->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
