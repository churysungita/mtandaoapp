
@include('student.users_head')
  <body>
    <div class="container-scroller">
    @include('student.users_top_banner')
      <!-- partial:partials/_navbar.html -->
    @include('student.users_navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('teacher.teachers_sidebar')

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
            @include('student.users_center_content')

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