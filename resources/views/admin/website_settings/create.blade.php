
                             

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



                        <h3 class="page-title"> Classes</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Manage Classes</a></li>
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



                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                
                                    <button type="button" class="btn btn-success mb-3 btn-create-class"
                                        data-toggle="modal" data-target="#createAboutModal">create new about us</button>

                                    <p class="card-description"> About Us</code>
                                    </p>
                                

                                    <div class="container">
                                        <h1>Create About Us Content</h1>
                                        <form method="post" action="{{ route('admin.website_settings.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="image_path">Image</label>
                                                <input type="file" name="image_path" class="form-control" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </form>
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
<!-- 
@include('admin.table_datatable_js') -->

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

    


        // Automatically close the success message after 3 seconds
        setTimeout(function () {
            $('.alert').alert('close');
        }, 3000);

</script>

</body>

</html>


