<!-- resources/views/content-materials/show.blade.php -->



<div class="container">
    <h1>Show Content Material</h1>

    <div>
        <h2>{{ $contentMaterial->title }}</h2>
        <p>{{ $contentMaterial->description }}</p>
    </div>

    <hr>

    <div>
        <h3>View File</h3>

        @if (strpos($mimeType, 'pdf') !== false)
        <!-- Embed PDF file -->
        <embed src="{{ asset($filePath) }}" width="800" height="600" type="application/pdf">
        @else
        <!-- Display a message for unsupported file types -->
        <p>This file format is not supported for direct embedding. You can <a href="{{ asset($filePath) }}" target="_blank">download it here</a>.</p>
        @endif
    </div>
</div>