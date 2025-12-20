<?php
    include "db.php";

    
    //create class to represent single record of a table
    class Record {
        public $id;
        public $fullName;
        public $studentId;
        public $roomNumber;
        public $issueType;
        public $description;
        public $urgency;

        function __construct($id, $fullName, $studentId, $roomNumber, $issueType, $description, $urgency) {
            $this->id = $id;
            $this->fullName = $fullName;
            $this->studentId = $studentId;
            $this->roomNumber = $roomNumber;
            $this->issueType = $issueType;
            $this->description = $description;
            $this->urgency = $urgency;
        }
    }

    //implement an array of records
    function getRecords() {
        global $conn;
        $records = array();
        $sql = "SELECT * FROM issues";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $record = new Record($row["id"], $row["full_name"], $row["student_id"], $row["room_number"], $row["issue_type"], $row["description"], $row["urgency"]);
                array_push($records, $record);
            }
        }
        return $records;
    }

    //implement function to iterate over the array and display table
    function displayRecords() {
        $records = getRecords();
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Full Name</th><th>Student ID</th><th>Room Number</th><th>Issue Type</th><th>Description</th><th>Urgency</th></tr>";
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>" . $record->id . "</td>";
            echo "<td>" . $record->fullName . "</td>";
            echo "<td>" . $record->studentId . "</td>";
            echo "<td>" . $record->roomNumber . "</td>";
            echo "<td>" . $record->issueType . "</td>";
            echo "<td>" . $record->description . "</td>";
            echo "<td>" . $record->urgency . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    displayRecords()
?>
