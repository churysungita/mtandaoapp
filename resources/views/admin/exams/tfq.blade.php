<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>True/False Questions</title>
</head>
<body>
    <h1>True/False Questions</h1>
    <ol>
        @php $questionNumber = 1; @endphp
        @foreach ($tfQuestions as $question)
            <li>
                {{ $questionNumber }}. {{ $question->question_text }}
                <ul style="list-style-type: none;">
                    <li>
                        A) True@if($question->correct_answer === 'true') - Correct Answer@endif
                    </li>
                    <li>
                        B) False@if($question->correct_answer === 'false') - Correct Answer@endif
                    </li>
                </ul>
            </li>
            @php $questionNumber++; @endphp
        @endforeach
    </ol>
</body>
</html>
