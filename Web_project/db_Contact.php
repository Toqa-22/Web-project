<?php
include "db.php";

$message = '';
$searchResults = [];

// Insert Operation
if(isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['message'];

    if(empty($name) || empty($email) || empty($msg)) $message = "Please fill all fields.";
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) $message = "Invalid email format.";
    elseif(strlen($name) < 3) $message = "Name must be at least 3 letters.";
    elseif(strlen($msg) < 10) $message = "Message must be at least 10 characters.";
    else {
        $sql = "INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $msg);
        if($stmt->execute()) $message = "Feedback inserted successfully!";
        else $message = "Error: ".$stmt->error;
        $stmt->close();
    }
}

// Delete Operation
if(isset($_POST['delete'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM feedback WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if($stmt->execute()) $message = "Record deleted successfully!";
    else $message = "Error: ".$stmt->error;
    $stmt->close();
}

// Search by Name
if(isset($_POST['search'])) {
    $searchName = $_POST['search_name'];
    $sql = "SELECT * FROM feedback WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    $likeName = "%$searchName%";
    $stmt->bind_param("s", $likeName);
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()) $searchResults[] = $row;
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Feedback</title>
</head>
<body>

<h2>Feedback Database Operations</h2>
<?php if($message) echo "<p>$message</p>"; ?>

<h3 id="insertSection">Insert Feedback</h3>
<form method="post">
    <input type="hidden" name="insert" value="1">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Message:<br>
    <textarea name="message" required></textarea><br>
    <button type="submit">Insert</button>
</form>

<h3 id="deleteSection">Delete Feedback</h3>
<form method="post">
    <input type="hidden" name="delete" value="1">
    ID: <input type="number" name="delete_id" required>
    <button type="submit">Delete</button>
</form>

<h3 id="searchSection">Search Feedback by Name</h3>
<form method="post">
    <input type="hidden" name="search" value="1">
    Name: <input type="text" name="search_name" required>
    <button type="submit">Search</button>
</form>

<?php if(!empty($searchResults)): ?>
<h3>Search Results</h3>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th></tr>
<?php foreach($searchResults as $r): ?>
<tr>
    <td><?php echo $r['id']; ?></td>
    <td><?php echo $r['name']; ?></td>
    <td><?php echo $r['email']; ?></td>
    <td><?php echo $r['message']; ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<section>
    <br><br>
    <a href="Contact Us.php">
        <button type="button">Go back</button>
    </a>
</section>
</body>
</html>
