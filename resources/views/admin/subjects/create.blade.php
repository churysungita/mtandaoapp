


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Subject</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.subjects.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="subject_name">Subject Name:</label>
                            <input type="text" name="subject_name" id="subject_name" class="form-control" required>
                            @error('subject_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="class_name_id">Select Class level:</label>
                            <select name="class_name_id" id="class_name_id" class="form-control">
                                <option value="" disabled selected>Select a class</option>
                                @foreach($darasa as $classes)
                                    <option value="{{ $classes->id }}">{{ $classes->class_name }}</option>
                                @endforeach
                            </select>
                            @error('class_name_id')
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























