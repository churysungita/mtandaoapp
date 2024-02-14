<!-- resources/views/subjects/show.blade.php -->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subject Details</div>

                <div class="card-body">
                    <div class="card-text">
                        <h1>Subject Details</h1>

                        <div><strong>ID:</strong> {{ $subject->id }}</div>
                        <div><strong>Subject Name:</strong> {{ $subject->subject_name }}</div>
                        <div><strong>Class Name:</strong> {{ $subject->classLevel->class_name }}</div>

                        <!-- Add a delete button here if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

