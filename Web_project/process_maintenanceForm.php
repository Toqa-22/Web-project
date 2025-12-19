
<?php
require_once 'db.php';
$sql = "CREATE TABLE IF NOT EXISTS maintenanceRequest (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255),
    student_id VARCHAR(255),
    room_number VARCHAR(255),
    issue_type VARCHAR(255),
    description TEXT,
    urgency INT
)";

if ($conn->query($sql) === TRUE) {
    echo "Table maintenanceRequest created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'];
    $studentId = $_POST['studentId'];
    $roomNumber = $_POST['roomNumber'];
    $issueType = implode(", ", $_POST['issueType']);
    $description = $_POST['description'];
    $urgency = $_POST['urgency'];

    $sql = "INSERT INTO maintenanceRequest (full_name, student_id, room_number, issue_type, description, urgency) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $fullName, $studentId, $roomNumber, $issueType, $description, $urgency);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM maintenanceRequest";
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Full Name</th><th>Student ID</th><th>Room Number</th><th>Issue Type</th><th>Description</th><th>Urgency</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['full_name'] . "</td>";
    echo "<td>" . $row['student_id'] . "</td>";
    echo "<td>" . $row['room_number'] . "</td>";
    echo "<td>" . $row['issue_type'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['urgency'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>
