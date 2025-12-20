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

// Search Quiz Results
$searchResults = [];

if (isset($_POST['search'])) {
    $minScore = intval($_POST['minScore']);

    $stmt = $conn->prepare(
        "SELECT id, score, total FROM quiz_results WHERE score >= ?"
    );
    $stmt->bind_param("i", $minScore);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $searchResults[] = new QuizResult(
            $row['id'],
            $row['score'],
            $row['total']
        );
    }
    $stmt->close();
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

<br>

<section>
    <h2>Delete Quiz Result</h2>
    <form method="post">
        Quiz ID to Delete: <input type="number" name="deleteId" required>
        <button type="submit" name="delete">Delete</button>
    </form>
</section>
<br>

<section>
    <h2>Search Results</h2>
    <form method="post">
        Minimum Score:
        <input type="number" name="minScore" required>
        <button type="submit" name="search">Search</button>
    </form>

    <?php if (isset($_POST['search'])): ?>
        <?php if (count($searchResults) > 0): ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Score</th>
                    <th>Total</th>
                </tr>

                <?php foreach ($searchResults as $q): ?>
                    <tr>
                        <td><?= $q->id ?></td>
                        <td><?= $q->score ?></td>
                        <td><?= $q->total ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    <?php endif; ?>
</section>

<section>
    <br><br>
    <a href="Questionnaire.php">
        <button type="button">Go back</button>
    </a>
</section>
</body>
</html>
