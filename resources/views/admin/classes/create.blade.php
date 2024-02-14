<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Class</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.classes.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="class_name">Class Name:</label>
                            <input type="text" name="class_name" id="class_name" class="form-control" required>
                            @error('class_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>