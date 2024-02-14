
    <h2>True/False Questions</h2>
    @foreach ($trueFalseQuestions as $question)
        <h3>True/False Question {{ $loop->iteration }}:</h3>
        <p>{{ $question->question_text }}</p>
        <p><strong>Marks:</strong> {{ $question->marks }}</p>
        <p><strong>Correct Answer:</strong> {{ $question->correct_answer }}</p>
    @endforeach