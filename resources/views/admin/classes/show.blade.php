<!-- resources/views/classes/show.blade.php -->



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Class Details</div>

                <div class="card-body">
                    <div class="class-details">
                        <h1>Class Details</h1>

                        <p><strong>ID:</strong> {{ $darasa->id }}</p>
                        <p><strong>Class Name:</strong> {{ $darasa->class_name }}</p>

                       
                        <!-- Add a delete button here if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
