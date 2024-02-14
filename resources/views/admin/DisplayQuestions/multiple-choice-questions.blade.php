    <h2>Multiple-Choice Questions</h2>
    @foreach ($multipleChoiceQuestions as $question)
        <h3>Multiple Choice Question {{ $loop->iteration }}:</h3>
        <p>{{ $question->question_text }}</p>
        <p><strong>Marks:</strong> {{ $question->marks }}</p>
        <ol type="A">
            <li>{{ $question->option_a }}</li>
            <li>{{ $question->option_b }}</li>
            <li>{{ $question->option_c }}</li>
            <li>{{ $question->option_d }}</li>
            @if (!empty($question->option_e))
                <li>{{ $question->option_e }}</li>
            @endif
        </ol>
        <p><strong>Correct Answer:</strong>
        @if ($question->correct_answer === 'option_a')
            A
        @elseif ($question->correct_answer === 'option_b')
            B
        @elseif ($question->correct_answer === 'option_c')
            C
        @elseif ($question->correct_answer === 'option_d')
            D
        @elseif ($question->correct_answer === 'option_e')
            E
        @endif
        </p>
    @endforeach