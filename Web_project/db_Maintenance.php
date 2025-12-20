<?php
require_once 'db.php';

$message = '';
$searchResults = [];

// Insert Operation
if(isset($_POST['insert'])) {
    $fullName = $_POST['fullName'];
    $studentId = $_POST['studentId'];
    $roomNumber = $_POST['roomNumber'];
    $issueType = implode(", ", $_POST['issueType']);
    $description = $_POST['description'];
    $urgency = $_POST['urgency'];

    $sql = "INSERT INTO issues (full_name, student_id, room_number, issue_type, description, urgency) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $fullName, $studentId, $roomNumber, $issueType, $description, $urgency);
    if($stmt->execute()) $message = "Record inserted successfully!";
    else $message = "Error: " . $stmt->error;
    $stmt->close();
}

// Delete Operation
if(isset($_POST['delete'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM issues WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if($stmt->execute()) $message = "Record deleted successfully!";
    else $message = "Error: " . $stmt->error;
    $stmt->close();
}

// Search by Urgency
if(isset($_POST['search'])) {
    $urgency = $_POST['urgency'];
    if(in_array($urgency, ['1','2','3','4','5'])) {
        $sql = "SELECT * FROM issues WHERE urgency = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $urgency);
        $stmt->execute();
        $res = $stmt->get_result();
        while($row = $res->fetch_assoc()) $searchResults[] = $row;
        $stmt->close();
    } else {
        $message = "Invalid urgency level selected.";
    }
}

// Fetch all issues
$allIssues = [];
$result = $conn->query("SELECT * FROM issues");
while($row = $result->fetch_assoc()) $allIssues[] = $row;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Maintenance Issues</title>
</head>
<body>

<h2>Maintenance Database Operations</h2>

<?php if($message) echo "<p>$message</p>"; ?>

<h3>Insert New Issue</h3>
<form method="post">
    <input type="hidden" name="insert" value="1">
    Full Name: <input type="text" name="fullName" required><br>
    Student ID: <input type="text" name="studentId" required><br>
    Room Number: <input type="text" name="roomNumber" required><br>
    Issue Type:<br>
    <input type="checkbox" name="issueType[]" value="Electrical"> Electrical
    <input type="checkbox" name="issueType[]" value="Plumbing"> Plumbing
    <input type="checkbox" name="issueType[]" value="Furniture"> Furniture
    <input type="checkbox" name="issueType[]" value="Internet"> Internet
    <input type="checkbox" name="issueType[]" value="Other"> Other<br>
    Description:<br>
    <textarea name="description"></textarea><br>
    Urgency: 
    <select name="urgency" required>
        <option value="">--Select--</option>
        <option value="1">1 - High</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5 - Low</option>
    </select><br>
    <button type="submit">Insert</button>
</form>

<h3>Delete Issue</h3>
<form method="post">
    <input type="hidden" name="delete" value="1">
    ID: <input type="number" name="delete_id" required>
    <button type="submit">Delete</button>
</form>

<h3 id="searchSection">Search Issues by Urgency</h3>
<form method="post">
    <input type="hidden" name="search" value="1">
    Urgency: 
    <select name="urgency" required>
        <option value="">--Select--</option>
        <option value="1">1 - High</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5 - Low</option>
    </select>
    <button type="submit">Search</button>
</form>

<?php if(!empty($searchResults)): ?>
<h3>Search Results</h3>
<table border="1">
<tr>
<th>ID</th><th>Full Name</th><th>Student ID</th><th>Room Number</th>
<th>Issue Type</th><th>Description</th><th>Urgency</th>
</tr>
<?php foreach($searchResults as $r): ?>
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
<?php endif; ?>

</body>
</html>
