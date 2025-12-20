<?php
    include "db.php";

    $result = $conn->query("SELECT * FROM feedback");

    echo "<h2>All Feedback</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Email</th><th>Message</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
?>