<?php
$answers = array(
    'q1' => 'b',
    'q2' => 'a',
    'q3' => 'b',
    'q4' => 'a',
    'q5' => 'b'
);

$score = 0;
$results = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($answers as $question => $answer) {
        $userAnswer = test_input($_POST[$question]);
        if ($userAnswer == $answer) {
            $score++;
            $results[$question] = array('userAnswer' => $userAnswer, 'correctAnswer' => $answer, 'result' => 'Correct');
        } else {
            $results[$question] = array('userAnswer' => $userAnswer, 'correctAnswer' => $answer, 'result' => 'Incorrect');
        }
    }

    echo 'Your score is: ' . $score . '/' . count($answers);
    echo '<br><br>';
    echo '<table border="1">';
    echo '<tr><th>Question</th><th>User Answer</th><th>Correct Answer</th><th>Result</th></tr>';
    foreach ($results as $question => $result) {
        echo '<tr>';
        echo '<td>' . $question . '</td>';
        echo '<td>' . $result['userAnswer'] . '</td>';
        echo '<td>' . $result['correctAnswer'] . '</td>';
        echo '<td>' . $result['result'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
