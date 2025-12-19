
<?php
require_once 'db.php';


$sql = "CREATE TABLE IF NOT EXISTS laundry (
    id INT AUTO_INCREMENT PRIMARY KEY,
    basic_items INT,
    special_items INT,
    want_delivery INT
)";

if ($conn->query($sql) === TRUE) {
    echo "Table laundry created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $basicItems = $_POST['basicItems'];
    $specialItems = $_POST['specialItems'];
    $wantDelivery = isset($_POST['wantDelivery']) ? 1 : 0;

    $sql = "INSERT INTO laundry (basic_items, special_items, want_delivery) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $basicItems, $specialItems, $wantDelivery);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM laundry";
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Basic Items</th><th>Special Items</th><th>Want Delivery</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['basic_items'] . "</td>";
    echo "<td>" . $row['special_items'] . "</td>";
    echo "<td>" . $row['want_delivery'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>


