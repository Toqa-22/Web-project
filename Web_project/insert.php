<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'];
    $studentId = $_POST['studentId'];
    $roomNumber = $_POST['roomNumber'];
    $issueType = implode(", ", $_POST['issueType']);
    $description = $_POST['description'];
    $urgency = $_POST['urgency'];

    $sql = "INSERT INTO issues (full_name, student_id, room_number, issue_type, description, urgency) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $fullName, $studentId, $roomNumber, $issueType, $description, $urgency);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT * FROM issues";
$result = $conn->query($sql);

?>
<form method="post" action="">
    Full Name: <input type="text" name="fullName"><br>
    Student ID: <input type="text" name="studentId"><br>
    Room Number: <input type="text" name="roomNumber"><br>
    Issue Type: <input type="text" name="issueType[]"><br>
    Description: <input type="text" name="description"><br>
    Urgency: <input type="number" name="urgency"><br>
    <input type="submit" value="Add Issue">
</form>

<table border="1">
<tr><th>ID</th><th>Full Name</th><th>Student ID</th><th>Room</th><th>Issue Type</th><th>Description</th><th>Urgency</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['full_name']; ?></td>
    <td><?php echo $row['student_id']; ?></td>
    <td><?php echo $row['room_number']; ?></td>
    <td><?php echo $row['issue_type']; ?></td>
    <td><?php echo $row['description']; ?></td>
    <td><?php echo $row['urgency']; ?></td>
</tr>
<?php endwhile; ?>
</table>
