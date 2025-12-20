<?php
include "db.php";

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Insert Operation
if(isset($_POST['insert'])) {
    $college = test_input($_POST["college"]);
    $year = test_input($_POST["year"]);
    $freq = test_input($_POST["freq"]);
    $quality = test_input($_POST["quality"]);
    $taste = test_input($_POST["taste"]);
    $food = test_input($_POST["food"]);
    $drinks = test_input($_POST["drinks"]);
    $suggestions = test_input($_POST["suggestions"]);

    if($college && $year && $freq && $quality && $taste && $food) {
        $stmt = $conn->prepare("INSERT INTO feedback (college, year, freq, quality, taste, food, drinks, suggestions)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $college, $year, $freq, $quality, $taste, $food, $drinks, $suggestions);
        $stmt->execute();
        $stmt->close();
        echo "Inserted successfully.<br>";
    } else {
        echo "All required fields must be filled.<br>";
    }
}

// Search Operation
$searchResults = [];
if(isset($_POST['search'])) {
    $searchUrgency = test_input($_POST['searchUrgency']);
    $stmt = $conn->prepare("SELECT * FROM feedback WHERE freq=?");
    $stmt->bind_param("s", $searchUrgency);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
    $stmt->close();
}

// Delete Operation
if(isset($_POST['delete'])) {
    $deleteId = test_input($_POST['deleteId']);
    $stmt = $conn->prepare("DELETE FROM feedback WHERE id=?");
    $stmt->bind_param("i", $deleteId);
    if($stmt->execute()) {
        echo "Deleted record ID: $deleteId<br>";
    } else {
        echo "Error deleting record.<br>";
    }
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Operations</title>
</head>
<body>

<section>
    <h2>Insert Feedback</h2>
    <form method="post">
        College: <input type="text" name="college" required><br>
        Year: <input type="text" name="year" required><br>
        Frequency: <input type="text" name="freq" required><br>
        Quality: <input type="text" name="quality" required><br>
        Taste: <input type="text" name="taste" required><br>
        Food: <input type="text" name="food" required><br>
        Drinks: <input type="text" name="drinks"><br>
        Suggestions: <textarea name="suggestions"></textarea><br>
        <button type="submit" name="insert">Insert</button>
    </form>
</section>

<br>

<section>
    <h2>Search Feedback by Frequency</h2>
    <form method="post">
        Frequency: <input type="text" name="searchUrgency" required>
        <button type="submit" name="search">Search</button>
    </form>
    <?php
    if($searchResults) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>College</th><th>Year</th><th>Freq</th><th>Quality</th><th>Taste</th><th>Food</th><th>Drinks</th><th>Suggestions</th></tr>";
        foreach($searchResults as $row){
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['college']}</td>";
            echo "<td>{$row['year']}</td>";
            echo "<td>{$row['freq']}</td>";
            echo "<td>{$row['quality']}</td>";
            echo "<td>{$row['taste']}</td>";
            echo "<td>{$row['food']}</td>";
            echo "<td>{$row['drinks']}</td>";
            echo "<td>{$row['suggestions']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</section>

<br>

<section>
    <h2>Delete Feedback</h2>
    <form method="post">
        Record ID to Delete: <input type="number" name="deleteId" required>
        <button type="submit" name="delete">Delete</button>
    </form>
</section>

<section>
    <br><br>
    <a href="Survey.php">
        <button type="button">Go back</button>
    </a>
</section>

</body>
</html>
