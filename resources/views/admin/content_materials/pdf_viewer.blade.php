
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
                        <h3 class="page-title">View PDF</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="content">
                                  
           
            <iframe src="{{ asset($contentMaterial->file_path) }}" width="100%" height="600px" frameborder="0"></iframe>
     

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





