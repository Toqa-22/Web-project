<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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

        $results = [];
        $res = $conn->query("SELECT score, total FROM quiz_results");

        while ($row = $res->fetch_assoc()) {
            $results[] = new QuizResult($row['score'], $row['total']);
        }

        echo "<h2>Quiz Results</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Score</th><th>Total</th></tr>";

        foreach ($results as $r) {
            echo "<tr>";
            echo "<td>{$r->score}</td>";
            echo "<td>{$r->total}</td>";
            echo "</tr>";
        }

        echo "</table>";
    ?>
    <br><br>
    <a href="Questionnaire.php">
        <button type="button">Go back</button>
    </a>
</body>
</html>