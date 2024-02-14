<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Long Questions</title>
</head>
<body>
    <h1>Long Questions</h1>
    @foreach ($longQuestions as $question)
        <div style="page-break-after: always;">
            <strong>Question {{ $loop->iteration }}:</strong>
            <div>{!! $question->question_text !!}</div>
            <p><strong>Marks:</strong> {{ $question->marks }}</p>
            <p><strong>Correct Answer:</strong> {{ $question->correct_answer }}</p>
        </div>
    @endforeach
</body>
</html>
