<?php
<<<<<<< HEAD
include "db.php";

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $message = test_input($_POST["message"]);

    if (empty($full_name) || empty($email) || empty($message)) {
        exit("Please fill out all fields");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Invalid email format");
    }

    if (strlen($full_name) < 3 || strlen($message) < 10) {
        exit("Invalid input length");
    }

    $stmt = $conn->prepare(
        "INSERT INTO feedback (full_name, email, message) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $full_name, $email, $message);
    $stmt->execute();
    $stmt->close();

    header("Location: Contact Us.php?success=1");
    exit;
}
=======
require_once 'db.php';

$sql = "CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    message TEXT
)";

if ($conn->query($sql) === TRUE) {
    echo "Table contact created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM contact";
$result = $conn->query($sql);



$conn->close();
>>>>>>> d91495608d6738f62457654184f07482cabfcdb2
?>
