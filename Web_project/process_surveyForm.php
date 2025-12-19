<?php
include "../db.php";
class Feedback {
    public $college;
    public $year;
    public $freq;
    public $quality;
    public $taste;
    public $food;
    public $drinks;
    public $suggestions;

    function __construct($college, $year, $freq, $quality, $taste, $food, $drinks, $suggestions) {
        $this->college = $college;
        $this->year = $year;
        $this->freq = $freq;
        $this->quality = $quality;
        $this->taste = $taste;
        $this->food = $food;
        $this->drinks = $drinks;
        $this->suggestions = $suggestions;
    }
}

$feedbacks = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $college = test_input($_POST["college"]);
    $year = test_input($_POST["year"]);
    $freq = test_input($_POST["freq"]);
    $quality = test_input($_POST["quality"]);
    $taste = test_input($_POST["taste"]);
    $food = test_input($_POST["food"]);
    $drinks = test_input($_POST["drinks"]);
    $suggestions = test_input($_POST["suggestions"]);

    if (empty($college) || empty($year) || empty($freq) || empty($quality) || empty($taste) || empty($food)) {
        echo 'Please fill out all fields';
        exit;
    }

    $stmt = $conn->prepare( "INSERT INTO feedback (college, year, freq, quality, taste, food, drinks, suggestions)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)" );

    $stmt->bind_param(
        "ssssssss",
        $college, $year, $freq, $quality,
        $taste, $food, $drinks, $suggestions
    );

    $stmt->execute();
    $stmt->close();


    

}
    
$feedbacks = [];
$result = $conn->query("SELECT * FROM feedback");

while ($row = $result->fetch_assoc()) {
    $feedbacks[] = new Feedback(
        $row['college'],
        $row['year'],
        $row['freq'],
        $row['quality'],
        $row['taste'],
        $row['food'],
        $row['drinks'],
        $row['suggestions']
    );
}

function printFeedbacks($feedbacks) {
    echo "<table border='1'>";
    echo "<tr><th>College</th><th>Year</th><th>Frequency</th><th>Quality</th><th>Taste</th><th>Food</th><th>Drinks</th><th>Suggestions</th></tr>";
    foreach ($feedbacks as $feedback) {
        echo "<tr>";
        echo "<td>" . $feedback->college . "</td>";
        echo "<td>" . $feedback->year . "</td>";
        echo "<td>" . $feedback->freq . "</td>";
        echo "<td>" . $feedback->quality . "</td>";
        echo "<td>" . $feedback->taste . "</td>";
        echo "<td>" . $feedback->food . "</td>";
        echo "<td>" . $feedback->drinks . "</td>";
        echo "<td>" . $feedback->suggestions . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

printFeedbacks($feedbacks);
?>
