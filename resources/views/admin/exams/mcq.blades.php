<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multiple Choice Questions</title>
</head>
<body>
    <h1>Multiple Choice Questions</h1>
    <ol>
        @php $questionNumber = 1; @endphp
        @foreach ($mcqQuestions as $question)
            <li>
                {{ $questionNumber }}. {{ $question->question_text }}
                <ol type="A">
                    <li>{{ $question->option_a }}</li>
                    <li>{{ $question->option_b }}</li>
                    <li>{{ $question->option_c }}</li>
                    <li>{{ $question->option_d }}</li>
                    <li>{{ $question->option_e }}</li>
                </ol>
            </li>
            @php $questionNumber++; @endphp
        @endforeach
    </ol>
</body>
</html>
