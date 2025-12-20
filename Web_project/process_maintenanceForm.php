<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName   = trim($_POST['fullName']);
    $studentId  = trim($_POST['studentId']);
    $roomNumber = trim($_POST['roomNumber']);
    $issueType  = isset($_POST['issueType']) ? implode(", ", $_POST['issueType']) : "";
    $description = trim($_POST['description']);
    $urgency    = intval($_POST['urgency']);

    if ($fullName === "" || $studentId === "" || $roomNumber === "" || $issueType === "" || $urgency === 0) {
        exit("Please fill out all required fields");
    }

    $stmt = $conn->prepare(
        "INSERT INTO issues (full_name, student_id, room_number, issue_type, description, urgency)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssi", $fullName, $studentId, $roomNumber, $issueType, $description, $urgency);
    $stmt->execute();
    $stmt->close();

    header("Location: Maintenance.php?success=1");
    exit;
}
?>
