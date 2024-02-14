<!-- resources/views/layouts/app.blade.php -->






<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.css')
       <!-- Include Viewer.js from the CDN -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.2/viewer.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.2/viewer.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Custom CSS for beautifying the modal */

    </style>


</head>


<body>










    <div class="container">
    <h1>PowerPoint Presentation Viewer</h1>

<!-- Increase the height of the viewer container -->
<div id="viewer" style="height: 600px;"></div>

<script>
    // Load the PowerPoint file using the asset helper function
    const viewer = new Viewer(document.getElementById('viewer'), {
        // Viewer.js options
        navbar: true, // Show the navigation bar
        title: true,  // Show the title bar
    });

    // Load the PowerPoint file from your server
    viewer.load('{{ asset($contentMaterial->file_path) }}');
    </script>
    </div>

    @include('admin.script')
</body>
</html>
