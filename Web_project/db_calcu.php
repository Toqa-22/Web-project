<?php
include "db.php";

class Bill {
    public $id;
    public $basicItems;
    public $specialItems;
    public $wantDelivery;
    public $total;

    function __construct($id, $basicItems, $specialItems, $wantDelivery) {
        $this->id = $id;
        $this->basicItems = $basicItems;
        $this->specialItems = $specialItems;
        $this->wantDelivery = $wantDelivery;
        $this->calculateTotal();
    }

    function calculateTotal() {
        $basicPrice = 0.5;
        $specialPrice = 1;
        $deliveryFee = 1;

        $this->total = ($this->basicItems * $basicPrice) + ($this->specialItems * $specialPrice);
        if ($this->wantDelivery === 'yes') {
            $this->total += $deliveryFee;
        }
    }
}

// Insert Bill
if(isset($_POST['insert'])) {
    $basicItems = intval($_POST['basicItems']);
    $specialItems = intval($_POST['specialItems']);
    $wantDelivery = isset($_POST['wantDelivery']) && $_POST['wantDelivery'] === 'yes' ? 'yes' : 'no';

    $stmt = $conn->prepare("INSERT INTO bills (basicItems, specialItems, wantDelivery, total) VALUES (?, ?, ?, ?)");
    $bill = new Bill(0, $basicItems, $specialItems, $wantDelivery);
    $stmt->bind_param("iisd", $basicItems, $specialItems, $wantDelivery, $bill->total);
    $stmt->execute();
    $stmt->close();
    echo "Bill inserted.<br>";
}

// Delete Bill
if(isset($_POST['delete'])) {
    $deleteId = intval($_POST['deleteId']);
    $stmt = $conn->prepare("DELETE FROM bills WHERE id=?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    $stmt->close();
    echo "Deleted Bill ID: $deleteId<br>";
}

// Fetch all bills
$bills = [];
$res = $conn->query("SELECT id, basicItems, specialItems, wantDelivery FROM bills");
while($row = $res->fetch_assoc()) {
    $bills[] = new Bill($row['id'], $row['basicItems'], $row['specialItems'], $row['wantDelivery']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bill Operations</title>
</head>
<body>

<section>
    <h2>Insert Bill</h2>
    <form method="post">
        Basic Items: <input type="number" name="basicItems" required><br>
        Special Items: <input type="number" name="specialItems" required><br>
        Delivery: 
        <input type="checkbox" name="wantDelivery" value="yes"> Yes<br>
        <button type="submit" name="insert">Insert</button>
    </form>
</section>

<hr>

<section>
    <h2>All Bills</h2>
    <table border="1">
        <tr><th>ID</th><th>Basic Items</th><th>Special Items</th><th>Delivery</th><th>Total</th></tr>
        <?php
        foreach($bills as $b){
            echo "<tr>";
            echo "<td>{$b->id}</td>";
            echo "<td>{$b->basicItems}</td>";
            echo "<td>{$b->specialItems}</td>";
            echo "<td>{$b->wantDelivery}</td>";
            echo "<td>".number_format($b->total,3)." OMR</td>";
            echo "</tr>";
        }
        ?>
    </table>
</section>

<hr>

<section>
    <h2>Delete Bill</h2>
    <form method="post">
        Bill ID to Delete: <input type="number" name="deleteId" required>
        <button type="submit" name="delete">Delete</button>
    </form>

<section>
    <br><br>
    <a href="calculate.php">
        <button type="button">Go back</button>
    </a>
</section>
</body>
</html>
