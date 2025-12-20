<?php
    include "db.php";

    $result = $conn->query("SELECT * FROM bills");

    echo "<h2>All Bills</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Basic Items</th>
            <th>Special Items</th>
            <th>Delivery</th>
            <th>Total (OMR)</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['basicItems']}</td>";
        echo "<td>{$row['specialItems']}</td>";
        echo "<td>{$row['wantDelivery']}</td>";
        echo "<td>" . number_format($row['total'], 3) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
?>
