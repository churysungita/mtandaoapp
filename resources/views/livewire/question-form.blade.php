<div>
    <div class="container">
        <h2 class="my-4">Create New Question</h2>
        <form wire:submit.prevent="createQuestion">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="subject_id">Select Subject:</label>
                    <select wire:model="selectedSubject" class="form-control">
                        <option value="" disabled>Select a subject</option>
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="topic_id">Select Topic:</label>
                    <select wire:model="selectedTopic" class="form-control">
                        <option value="" disabled>Select a topic</option>
                        @foreach($topics as $topic)
                        <option value="{{ $topic->id }}">{{ $topic->topic_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="subtopic_id">Select Subtopic:</label>
                    <select wire:model="selectedSubtopic" class="form-control">
                        <option value="" disabled>Select a subtopic</option>
                        @foreach($subtopics as $subtopic)
                        <option value="{{ $subtopic->id }}">{{ $subtopic->subtopic_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="type">Question Type:</label>
                    <select id="question-type" class="form-control">
                        <option value="" disabled>Select Type</option>
                        <option value="Multiple Choice">Multiple Choice</option>
                        <option value="Short Answer">Short Answer</option>
                        <option value="True/False">True/False</option>
                        <!-- Add other question types here -->
                    </select>
                </div>
            </div>
            <div id="question-form" style="display: none;">
                <!-- The form for adding questions will be displayed here -->
                <div class="form-group">
                    <label for="question_text">Question Text:</label>
                    <textarea class="form-control" rows="4"></textarea>
                    <label for="answer">Answer:</label>
                    <input type="text" class="form-control">
                    <label for="marks">Marks:</label>
                    <input type="number" class="form-control">
                </div>
                <button id="add-question-button" class="btn btn-success">Add Another Question</button>
            </div>
            <button type="submit" class="btn btn-primary my-3">Save Questions</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#question-type').on('change', function () {
            var selectedType = $(this).val();
            if (selectedType) {
                $('#question-form').show(); // Show the form for adding questions
                // Set the question type as a data attribute for further reference
                $('#question-form').data('question-type', selectedType);
            } else {
                $('#question-form').hide(); // Hide the form if no type is selected
            }
        });

        $('#add-question-button').on('click', function () {
            var selectedType = $('#question-form').data('question-type');
            if (selectedType) {
                var fields = $('#question-form .form-group').first().clone();
                fields.find('input, textarea').val('');
                $('#question-form').append(fields);
            }
        });
    });
</script>
