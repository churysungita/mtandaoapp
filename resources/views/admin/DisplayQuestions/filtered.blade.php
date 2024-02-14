<!DOCTYPE html>
<html>
<head>
    <!-- Include DataTables styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Include DataTables and DataTables Buttons scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <!-- Include DataTables Buttons CSS for styling -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <style>
        /* Custom styles for the table */
        body {
            background-color: #f0f0f0;
            /* Change this color to your desired background color */
        }

        #questions-table {
            background-color: #fff;
            /* Change this color to your desired background color */
            color: #333;
            /* Change this color to your desired text color */
        }

        #questions-table th {
            background-color: #444;
            /* Change this color to your desired header background color */
            color: white;
        }

        #questions-table tr {
            background-color: #555;
            /* Change this color to your desired row background color */
            color: white;
        }

        /* Center-align text and make long lines break */
        #questions-table td {
            text-align: center;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div id="pagination-container">
        <table id="questions-table" class="display">
            <thead>
                <tr>
                    <th>Question Text</th>
                    <th>Correct Answer</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($longQuestions as $question)
                <tr class="question-container normal-question">
                    <td>{!! $question->question_text !!}</td>
                    <td>{!! $question->correct_answer !!}</td>
                    <td>{{ $question->marks }}</td>
                </tr>
                @endforeach

                @foreach ($trueFalseQuestions as $question)
                <tr class="question-container true-false-question">
                    <td>{!! $question->question_text !!}</td>
                    <td>{!! $question->correct_answer !!}</td>
                    <td>{{ $question->marks }}</td>
                </tr>
                @endforeach

                @foreach ($multipleChoiceQuestions as $question)
                <tr class="question-container mcq-question">
                    <td>{!! $question->question_text !!}</td>
                    <td>
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
                    </td>
                    <td>{{ $question->marks }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#questions-table').DataTable({
                paging: true
                , searching: true
                , responsive: true
                , dom: 'Bfrtip', // Add export buttons to the table
                buttons: [
                    'copy', 'csv', 'excel', {
                        extend: 'pdf'
                        , orientation: 'landscape'
                    }, 'print'
                ]
            });
        });
    </script>
</body>
</html>
