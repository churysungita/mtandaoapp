<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.post_contents.header')
</head>

<body>
    <div class="container-scroller">
        @include('admin.post_contents.sidebar')
        @include('admin.post_contents.navbar')

        <div class="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">View Post Contents</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="content">
                                        <h4>Title: {{ $post->title }}</h4>
                                        <h5>Status: {{ $post->status }}</h5>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Class Level</h5>
                                                <p class="card-text">{{ $post->darasa->class_name }}</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Subject</h5>
                                                <p class="card-text">{{ $post->subject->subject_name }}</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Topic</h5>
                                                <p class="card-text">{{ $post->topic->topic_name }}</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Subtopic</h5>
                                                <p class="card-text">{{ $post->subtopic->subtopic_name }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4>Content:</h4>
                                        <div class="card">
                                            <div class="card-body" style="overflow: auto; max-height: 200px;">
                                                <div style="color: #FFFFFF !important;">
                                                    {!! $post->content !!}
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                </footer>
            </div>
        </div>
    </div>

    <!-- scripts -->
    @include('admin.post_contents.script')
    <!-- End custom js for this page -->
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Viewer</title>
    <!-- Add your CSS for card styling here -->
    <style>
        .card {
            /* Add your card styling properties here */
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            position: relative; /* Add this line to allow positioning of the overlay */
        }

        .card-header {
            /* Add your card header styling properties here */
            background-color: #f4f4f4;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .card-body {
            /* Add your card body styling properties here */
            padding: 20px;
        }

        /* Add CSS for overlay */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            pointer-events: none;
        }
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
                  
                <div class="card">
        <div class="card-header">
            <h2>PDF Viewer Card</h2>
        </div>
        <div class="card-body">
            <div class="overlay"></div>
            <iframe src="{{ asset($contentMaterial->file_path) }}" width="100%" height="600px" frameborder="0"></iframe>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script>
</html>
