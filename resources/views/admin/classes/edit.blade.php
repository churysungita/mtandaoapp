<!-- resources/views/classes/edit.blade.php -->



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Class</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.classes.update', $darasa) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="class_name">Class Name:</label>
                            <input type="text" name="class_name" id="class_name" class="form-control" value="{{ $darasa->class_name }}" required>
                        
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>