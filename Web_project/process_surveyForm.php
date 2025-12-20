<?php
    require_once "db.php";

    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $college = test_input($_POST["college"]);
        $year = test_input($_POST["year"]);
        $freq = test_input($_POST["freq"]);
        $quality = test_input($_POST["quality"]);
        $taste = test_input($_POST["taste"]);
        $food = test_input($_POST["food"]);
        $drinks = test_input($_POST["drinks"] ?? "");
        $suggestions = test_input($_POST["suggestions"] ?? "");

        if (empty($college) || empty($year) || empty($freq) || empty($quality) || empty($taste) || empty($food)) {
            exit;
        }

        $stmt = $conn->prepare(
            "INSERT INTO food_feedback 
            (college, year, freq, quality, taste, food, drinks, suggestions)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssssssss",
            $college, $year, $freq, $quality,
            $taste, $food, $drinks, $suggestions
        );

        $stmt->execute();
        $stmt->close();

        header("Location: feedback_form.php?done=1");
        exit;
    }
?>
