<?php
<<<<<<< HEAD
require_once "../db.php";

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $college = test_input($_POST["college"]);
    $year = test_input($_POST["year"]);
    $freq = test_input($_POST["freq"]);
    $quality = test_input($_POST["quality"]);
    $taste = test_input($_POST["taste"]);
    $food = test_input($_POST["food"]);
    $drinks = test_input($_POST["drinks"] ?? "");
    $suggestions = test_input($_POST["suggestions"] ?? "");

    if (empty($college) || empty($year) || empty($freq) || empty($quality) || empty($taste) || empty($food)) {
        exit;
    }

    $stmt = $conn->prepare(
        "INSERT INTO feedback 
        (college, year, freq, quality, taste, food, drinks, suggestions)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssssssss",
        $college, $year, $freq, $quality,
        $taste, $food, $drinks, $suggestions
    );

    $stmt->execute();
    $stmt->close();

    header("Location: feedback_form.php?done=1");
    exit;
}
=======
include "../db.php";


$sql = "CREATE TABLE IF NOT EXISTS survey (
    id INT AUTO_INCREMENT PRIMARY KEY,
    college VARCHAR(255),
    year VARCHAR(255),
    freq VARCHAR(255),
    quality INT,
    taste INT,
    food VARCHAR(255),
    drinks VARCHAR(255),
    suggestions TEXT
)";

if ($conn->query($sql) === TRUE) {
    echo "Table survey created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $college = $_POST['college'];
    $year = $_POST['year'];
    $freq = $_POST['freq'];
    $quality = $_POST['quality'];
    $taste = $_POST['taste'];
    $food = $_POST['food'];
    $drinks = $_POST['drinks'];
    $suggestions = $_POST['suggestions'];

    $sql = "INSERT INTO survey (college, year, freq, quality, taste, food, drinks, suggestions) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $college, $year, $freq, $quality, $taste, $food, $drinks, $suggestions);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM survey";
$result = $conn->query($sql);


$conn->close();
>>>>>>> d91495608d6738f62457654184f07482cabfcdb2
?>
