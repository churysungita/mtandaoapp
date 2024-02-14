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
                    <select wire:model="type" class="form-control">
                        <option value="" disabled>Select Type</option>
                        <option value="Multiple Choice">Multiple Choice</option>
                        <option value="Short Answer">Short Answer</option>
                        <option value="True/False">True/False</option>
                        <!-- Add other question types here -->
                    </select>
                </div>
            </div>
            <div wire:loading.remove>
                @if ($type === 'Multiple Choice')
                <div class="form-group">
                    <label for="question_text">Question Text:</label>
                    <textarea wire:model.debounce.2700000ms="questionText" class="form-control" rows="4"></textarea>


                    <label for="answer">Answer:</label>
                    <input wire:model.debounce.2700000ms="answer" type="text" class="form-control">


                    <label for="marks">Marks:</label>
                    <input wire:model.debounce.2700000ms="marks" type="number" class="form-control">

                </div>


                @elseif ($type === 'Short Answer')
                <div class="form-group">
                    <label for="question_text">Question Text:</label>
                    <textarea wire:model.debounce.2700000ms="questionText" class="form-control" rows="4"></textarea>


                    <label for="answer">Answer:</label>
                    <input wire:model.debounce.2700000ms="answer" type="text" class="form-control">


                    <label for="marks">Marks:</label>
                    <input wire:model.debounce.2700000ms="marks" type="number" class="form-control">

                </div>
                <!-- Add Short Answer fields here -->
                @elseif ($type === 'True/False')
                <div class="form-group">
                    <label for="question_text">Question Text:</label>
                    <textarea wire:model.debounce.2700000ms="questionText" class="form-control" rows="4"></textarea>


                    <label for="answer">Answer:</label>
                    <input wire:model.debounce.2700000ms="answer" type="text" class="form-control">


                    <label for="marks">Marks:</label>
                    <input wire:model.debounce.2700000ms="marks" type="number" class="form-control">

                </div>
                <!-- Add True/False fields here -->
                @endif
                <!-- Common fields (Answer and Marks) -->
                @if ($type)
                <button wire:click="addQuestion" class="btn btn-success">Add Another Question</button>
                <button wire:click="removeQuestion" class="btn btn-danger">Remove Last Question</button>
                @endif
            </div>
            <!-- Conditionally display a button to add more questions -->
            <button type="submit" class="btn btn-primary my-3">Save Questions</button>


        </form>
    </div>
</div>
