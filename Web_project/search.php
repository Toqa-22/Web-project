<?php
require_once 'db.php';

$keyword = '';
$results = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $keyword = $_POST['keyword'];
    $sql = "SELECT * FROM issues 
            WHERE full_name LIKE ? 
               OR student_id LIKE ? 
               OR room_number LIKE ? 
               OR issue_type LIKE ?";
    $stmt = $conn->prepare($sql);
    $like = "%$keyword%";
    $stmt->bind_param("ssss", $like, $like, $like, $like);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $results[] = $row;
    }
    $stmt->close();
}
?>
<form method="post" action="">
    Search: <input type="text" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>">
    <input type="submit" value="Search">
</form>

<table border="1">
<tr><th>ID</th><th>Full Name</th><th>Student ID</th><th>Room</th><th>Issue Type</th><th>Description</th><th>Urgency</th></tr>
<?php foreach ($results as $r): ?>
<tr>
    <td><?php echo $r['id']; ?></td>
    <td><?php echo $r['full_name']; ?></td>
    <td><?php echo $r['student_id']; ?></td>
    <td><?php echo $r['room_number']; ?></td>
    <td><?php echo $r['issue_type']; ?></td>
    <td><?php echo $r['description']; ?></td>
    <td><?php echo $r['urgency']; ?></td>
</tr>
<?php endforeach; ?>
</table>
