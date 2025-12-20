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

// Search Bills
$searchResults = [];

if (isset($_POST['search'])) {
    $delivery = $_POST['searchDelivery'];

    $stmt = $conn->prepare(
        "SELECT id, basicItems, specialItems, wantDelivery 
         FROM bills 
         WHERE wantDelivery = ?"
    );
    $stmt->bind_param("s", $delivery);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $searchResults[] = new Bill(
            $row['id'],
            $row['basicItems'],
            $row['specialItems'],
            $row['wantDelivery']
        );
    }
    $stmt->close();
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


<br>

<section>
    <h2>Delete Bill</h2>
    <form method="post">
        Bill ID to Delete: <input type="number" name="deleteId" required>
        <button type="submit" name="delete">Delete</button>
    </form>

</section>

<br>
<section>
    <h2>Search Bills</h2>
    <form method="post">
        Delivery:
        <select name="searchDelivery" required>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
        <button type="submit" name="search">Search</button>
    </form>
</section>
<?php if (isset($_POST['search'])): ?>
    <h3>Search Results</h3>

    <?php if (count($searchResults) > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Basic Items</th>
                <th>Special Items</th>
                <th>Delivery</th>
                <th>Total</th>
            </tr>

            <?php foreach ($searchResults as $b): ?>
                <tr>
                    <td><?= $b->id ?></td>
                    <td><?= $b->basicItems ?></td>
                    <td><?= $b->specialItems ?></td>
                    <td><?= $b->wantDelivery ?></td>
                    <td><?= number_format($b->total, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
<?php endif; ?>

<section>
    <br><br>
    <a href="calculate.php">
        <button type="button">Go back</button>
    </a>
</section>
</body>
</html>
