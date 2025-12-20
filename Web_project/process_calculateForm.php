<?php
<<<<<<< HEAD
include "db.php";

function clean($v) {
    return htmlspecialchars(trim($v));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $basicItems   = clean($_POST["basicItems"]);
    $specialItems = clean($_POST["specialItems"]);
    $wantDelivery = isset($_POST["wantDelivary"]) ? "yes" : "no";

    if ($basicItems === "" || $specialItems === "") {
        exit("Please fill out all fields");
    }

    $basicPrice = 0.500;
    $specialPrice = 1;
    $deliveryFee = 1;

    $total = ($basicItems * $basicPrice) + ($specialItems * $specialPrice);
    if ($wantDelivery === "yes") {
        $total += $deliveryFee;
    }

    $stmt = $conn->prepare(
        "INSERT INTO bills (basicItems, specialItems, wantDelivery, total)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("iisd", $basicItems, $specialItems, $wantDelivery, $total);
    $stmt->execute();
    $stmt->close();

    header("Location: calculate.php?success=1");
    exit;
}
=======
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


$conn->close();
>>>>>>> d91495608d6738f62457654184f07482cabfcdb2
?>

