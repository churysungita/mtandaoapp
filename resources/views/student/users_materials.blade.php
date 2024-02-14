
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
           <!-- START CONTENT DISPLAYING CENTER (MATERIALS) -->
           <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                 
                                 
                                    <p class="card-description"> List of materials created</p>

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
                                                <th>Date Published</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($posts as $post)
                                            <tr>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->darasa->class_name }}</td> <!-- Display class level -->
                                                <td>{{ $post->subject->subject_name }}</td> <!-- Display subject -->
                                                <td>{{ $post->topic->topic_name }}</td> <!-- Display topic -->
                                                <td>{{ $post->subtopic->subtopic_name }}</td> <!-- Display subtopic -->
                                                <td>{{ $post->created_at->format('M d, Y') }}</td> 
                                                <td>
                                           

                                                        {{-- <a href="{{ route('student.users_materials_view', ['id' => $post->id]) }}" class="btn btn-success">View</a> --}}

                                                         <a href="{{ route('student.users_materials_view', ['hashedId' => $hashids->encode($post->id)]) }}" class="btn btn-success">View</a>
                                                        

                                                 
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7">No posts available.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

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
  </body>
</html>