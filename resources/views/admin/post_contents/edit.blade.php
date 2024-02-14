<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e1e1e;
            /* Night-themed background color */


        }

        .container-scroller {
            position: relative;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .main-panel {
            background-color: #333;
            /* Main panel background color */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            /* Rounded corners for the main panel */
        }

        .page-header {
            background-color: #444;
            /* Page header background color */
            padding: 20px;
            border-radius: 10px;
            /* Rounded corners for the page header */
        }

        .form-control {
            background-color: #333;
            /* Form input background color */
            color: #fff;
            /* Form input text color */
        }

        .btn-primary {
            background-color: #007bff;
            /* Primary button background color */
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Primary button background color on hover */
            border-color: #0056b3;
        }

    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- ... Your existing code ... -->
                    <div class="page-header">
                        <h3 class="page-title">Edit Post</h3>
                        <a href="{{ url('home') }}" class="btn btn-primary">Back to Dashboard</a> <!-- Add this line -->
                    </div>
                    <!-- ... Your existing code ... -->

                    <div class="row">
                        <div class="col-lg-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.post_contents.update', $post->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <!-- Use the PUT method for updates -->
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Title" value="{{ $post->title }}" required>
                                        </div>

                                        <!-- Class Level -->
                                        <div class="form-group">
                                            <label for="darasa_id">Select Class level:</label>
                                            <select name="darasa_id" id="darasa_id" class="form-control">
                                                <option value="" disabled>Select a class</option>
                                                @foreach($darasa as $classes)
                                                <option value="{{ $classes->id }}" @if($classes->id ===
                                                    $post->darasa_id) selected @endif>{{ $classes->class_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Subject -->
                                        <div class="form-group">
                                            <label for="subject_id">Select Subject:</label>
                                            <select name="subject_id" id="subject_id"
                                                class="form-control @error('subject_id') is-invalid @enderror">
                                                <option value="" disabled>Select a subject</option>
                                                @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}" @if($subject->id ===
                                                    $post->subject_id) selected @endif>{{ $subject->subject_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Topic -->
                                        <div class="form-group">
                                            <label for="topic_id">Select Topic:</label>
                                            <select name="topic_id" id="topic_id" class="form-control" required>
                                                <option value="" disabled>Select a topic</option>
                                                @foreach($topics as $topic)
                                                <option value="{{ $topic->id }}" @if($topic->id === $post->topic_id)
                                                    selected @endif>{{ $topic->topic_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Subtopic -->
                                        <div class="form-group">
                                            <label for="subtopic_id">Select Subtopic:</label>
                                            <select name="subtopic_id" id="subtopic_id" class="form-control" required>
                                                <option value="" disabled>Select a subtopic</option>
                                                @foreach($subtopics as $subtopic)
                                                <option value="{{ $subtopic->id }}" @if($subtopic->id ===
                                                    $post->subtopic_id) selected @endif>{{ $subtopic->subtopic_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="editor">Content</label>
                                            <textarea id="summernote" name="content" class="form-control" rows="10"
                                                style="color: black !important;">{!! $post->content !!}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="draft" @if ($post->status === 'draft') selected
                                                    @endif>Draft</option>
                                                <option value="published" @if ($post->status === 'published') selected
                                                    @endif>Published</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <footer class="footer">
                </footer>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 300,
            });

            // Insert the HTML content into Summernote
            $('#summernote').summernote('code', {
                !!json_encode($post - > content) !!
            });
        });

    </script>
</body>

</html>
