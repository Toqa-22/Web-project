<?php
require_once 'db.php';

<<<<<<< HEAD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName   = trim($_POST['fullName']);
    $studentId  = trim($_POST['studentId']);
    $roomNumber = trim($_POST['roomNumber']);
    $issueType  = isset($_POST['issueType']) ? implode(", ", $_POST['issueType']) : "";
    $description = trim($_POST['description']);
    $urgency    = intval($_POST['urgency']);

    if ($fullName === "" || $studentId === "" || $roomNumber === "" || $issueType === "" || $urgency === 0) {
        exit("Please fill out all required fields");
    }

    $stmt = $conn->prepare(
        "INSERT INTO issues (full_name, student_id, room_number, issue_type, description, urgency)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssi", $fullName, $studentId, $roomNumber, $issueType, $description, $urgency);
    $stmt->execute();
    $stmt->close();

    header("Location: Maintenance.php?success=1");
    exit;
}
=======
$sql = "CREATE TABLE IF NOT EXISTS maintenanceRequest (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255),
    student_id VARCHAR(255),
    room_number VARCHAR(255),
    issue_type VARCHAR(255),
    description TEXT,
    urgency INT
)";

if ($conn->query($sql) === TRUE) {
    echo "Table maintenanceRequest created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["display"])) {
        echo "hghgh";
        displayRecords();
    } else {
        $fullName = $_POST['fullName'];
        $studentId = $_POST['studentId'];
        $roomNumber = $_POST['roomNumber'];
        $issueType = implode(", ", $_POST['issueType']);
        $description = $_POST['description'];
        $urgency = $_POST['urgency'];
        $sql = "INSERT INTO maintenanceRequest (full_name, student_id, room_number, issue_type, description, urgency) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $fullName, $studentId, $roomNumber, $issueType, $description, $urgency);
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

//create class to rebresent single record of a table
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
    $sql = "SELECT * FROM maintenanceRequest";
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

$conn->close();
>>>>>>> d91495608d6738f62457654184f07482cabfcdb2
?>
