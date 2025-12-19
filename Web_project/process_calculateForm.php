<?php
include "db.php";
class Bill {
    public $basicItems;
    public $specialItems;
    public $wantDelivery;
    public $total;

    function __construct($basicItems, $specialItems, $wantDelivery) {
        $this->basicItems = $basicItems;
        $this->specialItems = $specialItems;
        $this->wantDelivery = $wantDelivery;
        $this->calculateTotal();
    }

    function calculateTotal() {
        $basicPrice = 0.500; 
        $specialPrice = 1; 
        $deliveryFee = 1; 

        $this->total = ($this->basicItems * $basicPrice) + ($this->specialItems * $specialPrice);
        if ($this->wantDelivery == 'yes') {
            $this->total += $deliveryFee;
        }
    }
}

$bills = array();


$basicItems = $_POST["basicItems"];
$specialItems = $_POST["specialItems"];
$wantDelivery = $_POST["wantDelivary"];
if (isset($wantDelivery)) {
    $wantDelivery="yes";
    }
else{
    $wantDelivery="no";
}

if (empty($basicItems) || empty($specialItems)) {
    echo 'Please fill out all fields';
    exit;
}

$bill = new Bill($basicItems, $specialItems, $wantDelivery);
$bills = [];

$result = $conn->query("SELECT * FROM bills");

while ($row = $result->fetch_assoc()) {
    $bills[] = new Bill(
        $row['basicItems'],
        $row['specialItems'],
        $row['wantDelivery']
    );
}

$sql = "INSERT INTO bills (basicItems, specialItems, wantDelivery, total)
        VALUES ($basicItems, $specialItems, '$wantDelivery', $bill->total)";
$conn->query($sql);


function printBills($bills) {
    echo "<table border='1'>";
    echo "<tr><th>Basic Items</th><th>Special Items</th><th>Want Delivery</th><th>Total</th></tr>";
    foreach ($bills as $bill) {
        echo "<tr>";
        echo "<td>" . $bill->basicItems . "</td>";
        echo "<td>" . $bill->specialItems . "</td>";
        echo "<td>" . $bill->wantDelivery . "</td>";
        echo "<td>" . number_format($bill->total, 3) . " OMR</td>";
        echo "</tr>";
    }
    echo "</table>";
}

printBills($bills);



?>
