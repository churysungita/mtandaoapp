<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.post_contents.header')

    <style>
        
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.post_contents.sidebar')
        @include('admin.post_contents.navbar')

        <div class="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">View Video</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="content">


                                         <video controls width="100%" style="height: 450px;" >
                                            <source src="{{ asset($contentMaterial->file_path) }}" type="video/mp4">

                                        </video> 

                                  
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
