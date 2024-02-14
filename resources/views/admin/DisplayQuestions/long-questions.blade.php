  <h2>Long Questions</h2>
    @foreach ($longQuestions as $question)
        <h3>Long Question {{ $loop->iteration }}:</h3>
        {!! $question->question_text !!} 
        <p><strong>Marks:</strong> {{ $question->marks }}</p>
        <p><strong>Correct Answer:</strong> {!! $question->correct_answer !!}
    @endforeach