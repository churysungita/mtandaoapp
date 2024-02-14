<!-- resources/views/classes/edit.blade.php -->



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Subjects</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.subjects.update', $subject) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="subject_name">Subject Name:</label>
                            <input type="text" name="subject_name" id="subject_name" class="form-control"
                                value="{{ $subject->subject_name }}" required>

                        </div>

                        <!-- <div class="form-group">
                            <label for="class_name">Class Name:</label>
                            <input type="text" name="class_name" id="class_name" class="form-control" style="color:black;"
                                value="{{ $subject->classLevel->class_name }}" disabled>
                        </div> -->

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
                      


                      

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
