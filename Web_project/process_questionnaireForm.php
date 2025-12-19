<?php
include "db.php";
class QuizResult {
    public $score;
    public $total;

    function __construct($score, $total) {
        $this->score = $score;
        $this->total = $total;
    }
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$answers = array(
    'q1' => 'b',
    'q2' => 'a',
    'q3' => 'b',
    'q4' => 'a',
    'q5' => 'b'
);

$score = 0;
$total = count($answers);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($answers as $q => $correct) {
        $user = isset($_POST[$q]) ? test_input($_POST[$q]) : '';
        if ($user === $correct) {
            $score++;
        }
    }

    $stmt = $conn->prepare(
        "INSERT INTO quiz_results (score, total) VALUES (?, ?)"
    );
    $stmt->bind_param("ii", $score, $total);
    $stmt->execute();
    $stmt->close();
}


$quizResults = [];
$res = $conn->query("SELECT score, total FROM quiz_results");

while ($row = $res->fetch_assoc()) {
    $quizResults[] = new QuizResult($row['score'], $row['total']);
}


function printQuizResults($list) {
    echo "<table border='1'>";
    echo "<tr><th>Score</th><th>Total</th></tr>";
    foreach ($list as $obj) {
        echo "<tr>";
        echo "<td>{$obj->score}</td>";
        echo "<td>{$obj->total}</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
