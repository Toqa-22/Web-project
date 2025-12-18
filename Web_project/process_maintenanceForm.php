<?php
class Record {
    public $fullName;
    public $studentId;
    public $roomNumber;
    public $issueType;
    public $description;
    public $urgency;

    function __construct($fullName, $studentId, $roomNumber, $issueType, $description, $urgency) {
        $this->fullName = $fullName;
        $this->studentId = $studentId;
        $this->roomNumber = $roomNumber;
        $this->issueType = $issueType;
        $this->description = $description;
        $this->urgency = $urgency;
    }
}

$records = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = test_input($_POST["fullName"]);
    $studentId = test_input($_POST["studentId"]);
    $roomNumber = test_input($_POST["roomNumber"]);
    $issueType = test_input($_POST["issueType"]);
    $description = test_input($_POST["description"]);
    $urgency = test_input($_POST["urgency"]);

    if (empty($fullName) || empty($studentId) || empty($roomNumber) || empty($issueType) || empty($urgency)) {
        echo 'Please fill out all fields';
        exit;
    }

    $record = new Record($fullName, $studentId, $roomNumber, $issueType, $description, $urgency);
    $records[] = $record;

    function printRecords($records) {
        echo "<table border='1'>";
        echo "<tr><th>Full Name</th><th>Student ID</th><th>Room Number</th><th>Issue Type</th><th>Description</th><th>Urgency</th></tr>";
        foreach ($records as $record) {
            echo "<tr>";
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

    printRecords($records);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
