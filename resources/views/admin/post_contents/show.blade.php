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
