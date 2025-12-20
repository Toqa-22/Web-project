<?php
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
?>
