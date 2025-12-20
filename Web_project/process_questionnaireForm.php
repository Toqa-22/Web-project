
<?php
<<<<<<< HEAD
require_once "db.php";
=======
require_once 'db.php';


$sql = "CREATE TABLE IF NOT EXISTS quiz (
    id INT AUTO_INCREMENT PRIMARY KEY,
    q1 VARCHAR(255),
    q2 VARCHAR(255),
    q3 VARCHAR(255),
    q4 VARCHAR(255),
    q5 VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table quiz created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
>>>>>>> d91495608d6738f62457654184f07482cabfcdb2

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $q5 = $_POST['q5'];

<<<<<<< HEAD
$answers = [
    'q1' => 'b',
    'q2' => 'a',
    'q3' => 'b',
    'q4' => 'a',
    'q5' => 'b'
];
=======
    $sql = "INSERT INTO quiz (q1, q2, q3, q4, q5) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $q1, $q2, $q3, $q4, $q5);
>>>>>>> d91495608d6738f62457654184f07482cabfcdb2

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

<<<<<<< HEAD
    header("Location: quiz.php?done=1");
    exit;
}
=======
$sql = "SELECT * FROM quiz";
$result = $conn->query($sql);


$conn->close();
>>>>>>> d91495608d6738f62457654184f07482cabfcdb2
?>
