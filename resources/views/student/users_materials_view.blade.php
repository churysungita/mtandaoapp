@include('student.users_head')

<body>
    <div class="container-scroller">
        @include('student.users_top_banner')
        <!-- partial:partials/_navbar.html -->
        @include('student.users_navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('student.users_sidebar')

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span> Dashboard
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i
                                        class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- START CONTENT DISPLAYING CENTER (MATERIALS) -->
                    <div class="col-lg-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-description">Title:{{ $post->title }}</p>
                                <div class="container">
                                  
                                    <div class="mb-3">
                                        <strong>Class Level:</strong> {{ $post->darasa->class_name }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Subject:</strong> {{ $post->subject->subject_name }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Topic:</strong> {{ $post->topic->topic_name }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Subtopic:</strong> {{ $post->subtopic->subtopic_name }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>Date Published:</strong> {{ $post->created_at->format('F j, Y H:i:s') }}
                                    </div>
                                    <div>
                                        {!! $post->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- END DISPLAY MATERIALS -->

                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('student.users_footer')

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('student.users_bottom_js')

    <!-- End custom js for this page -->
    <script>
        // Disable right-click menu
        window.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        // Disable inspecting
        window.addEventListener('keydown', function (e) {
            if (e.ctrlKey && (e.key === 'I' || e.key === 'i' || e.keyCode === 73)) {
                e.preventDefault();
            }
        });

        // Disable taking screenshots
        window.addEventListener('keydown', function (e) {
            if (e.ctrlKey && e.shiftKey && (e.key === 'S' || e.key === 's' || e.keyCode === 83)) {
                e.preventDefault();
            }
        });

        // Disable screen recording
        navigator.mediaDevices.getDisplayMedia = null;

        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'u') {
                e.preventDefault();
                alert("You're note allowed please.");
            }
        });

    </script>
</body>

</html>
