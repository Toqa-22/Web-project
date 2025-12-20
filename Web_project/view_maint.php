<?php
    require_once 'db.php';

    $result = $conn->query("SELECT * FROM issues");

    echo "<h2>All Maintenance Requests</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Student ID</th>
            <th>Room Number</th>
            <th>Issue Type</th>
            <th>Description</th>
            <th>Urgency</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['full_name']}</td>";
        echo "<td>{$row['student_id']}</td>";
        echo "<td>{$row['room_number']}</td>";
        echo "<td>{$row['issue_type']}</td>";
        echo "<td>{$row['description']}</td>";
        echo "<td>{$row['urgency']}</td>";
        echo "</tr>";
    }

    echo "</table>";
?>
