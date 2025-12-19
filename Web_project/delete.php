<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM issues WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT * FROM issues";
$result = $conn->query($sql);
?>

<form method="post" action="">
    ID to Delete: <input type="number" name="id">
    <input type="submit" value="Delete">
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
