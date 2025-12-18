<?php
class Feedback {
    public $name;
    public $email;
    public $message;

    function __construct($name, $email, $message) {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }
}

$feedbacks = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $message = test_input($_POST["message"]);

    if (empty($name) || empty($email) || empty($message)) {
        echo 'Please fill out all fields';
        exit;
    }

    if (strlen($name) < 3) {
        echo 'Name must be at least 3 letters';
        exit;
    }

    

    if (strlen($message) < 10) {
        echo 'Message must be at least 10 characters';
        exit;
    }

    $feedback = new Feedback($name, $email, $message);
    $feedbacks[] = $feedback;

    function printFeedbacks($feedbacks) {
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Email</th><th>Message</th></tr>";
        foreach ($feedbacks as $feedback) {
            echo "<tr>";
            echo "<td>" . $feedback->name . "</td>";
            echo "<td>" . $feedback->email . "</td>";
            echo "<td>" . $feedback->message . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    printFeedbacks($feedbacks);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
