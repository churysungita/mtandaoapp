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
                                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- SHOWING NOTES -->
                    <div class="col-lg-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-description">List of notes content created</p>
                                <div class="table-responsive">
                                    <div style="overflow-x: auto;">

                                        <table class="table" id="search">

                                            <thead>
                                                <tr>
                                                    <th>Class Name</th>
                                                    <th>Subject Name</th>
                                                    <th>Topic</th>
                                                    <th>Subtopic</th>
                                                    <th>File</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($content_materials as $contentMaterial)
                                                <tr>
                                                    <td>{{ $contentMaterial->darasa->class_name }}</td>
                                                    <td>{{ $contentMaterial->subject->subject_name }}</td>
                                                    <td>{{ $contentMaterial->topic->topic_name }}</td>
                                                    <td>{{ $contentMaterial->subtopic->subtopic_name }}</td>
                                                    <td>{{ pathinfo($contentMaterial->file_path, PATHINFO_EXTENSION) }}</td>
                                                    <!-- Display file type -->
                                                    <td>

                                                        <a href="{{ route('student.users_notes_view', ['hashedId' => $hashids->encode($contentMaterial->id)]) }}" class="btn btn-success">View</a>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>









                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- END SHOWING NOTES  -->

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
</body>

</html>
