<?php
include "db.php";

class QuizResult {
    public $id;
    public $score;
    public $total;

    function __construct($id, $score, $total) {
        $this->id = $id;
        $this->score = $score;
        $this->total = $total;
    }
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Insert Quiz Result
if(isset($_POST['insert'])) {
    $score = intval($_POST['score']);
    $total = intval($_POST['total']);

    if($score >=0 && $total >0) {
        $stmt = $conn->prepare("INSERT INTO quiz_results (score, total) VALUES (?, ?)");
        $stmt->bind_param("ii", $score, $total);
        $stmt->execute();
        $stmt->close();
        echo "Quiz result inserted.<br>";
    } else {
        echo "Enter valid score and total.<br>";
    }
}

// Delete Quiz Result
if(isset($_POST['delete'])) {
    $deleteId = intval($_POST['deleteId']);
    $stmt = $conn->prepare("DELETE FROM quiz_results WHERE id=?");
    $stmt->bind_param("i", $deleteId);
    if($stmt->execute()) {
        echo "Deleted Quiz Result ID: $deleteId<br>";
    } else {
        echo "Error deleting record.<br>";
    }
    $stmt->close();
}

// Fetch all results
$quizResults = [];
$res = $conn->query("SELECT id, score, total FROM quiz_results");
while($row = $res->fetch_assoc()){
    $quizResults[] = new QuizResult($row['id'], $row['score'], $row['total']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Operations</title>
</head>
<body>

<section>
    <h2>Insert Quiz Result</h2>
    <form method="post">
        Score: <input type="number" name="score" required><br>
        Total: <input type="number" name="total" required><br>
        <button type="submit" name="insert">Insert</button>
    </form>
</section>

<hr>

<section>
    <h2>Quiz Results</h2>
    <table border="1">
        <tr><th>ID</th><th>Score</th><th>Total</th></tr>
        <?php
        foreach($quizResults as $q){
            echo "<tr>";
            echo "<td>{$q->id}</td>";
            echo "<td>{$q->score}</td>";
            echo "<td>{$q->total}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</section>

<hr>

<section>
    <h2>Delete Quiz Result</h2>
    <form method="post">
        Quiz ID to Delete: <input type="number" name="deleteId" required>
        <button type="submit" name="delete">Delete</button>
    </form>
</section>

<section>
    <br><br>
    <a href="Questionnaire.php">
        <button type="button">Go back</button>
    </a>
</section>
</body>
</html>
