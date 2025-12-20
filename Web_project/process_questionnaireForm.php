<?php
    require_once "db.php";

    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $answers = [
        'q1' => 'b',
        'q2' => 'a',
        'q3' => 'b',
        'q4' => 'a',
        'q5' => 'b'
    ];

    $score = 0;
    $total = count($answers);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        foreach ($answers as $q => $correct) {
            $user = isset($_POST[$q]) ? test_input($_POST[$q]) : '';
            if ($user === $correct) {
                $score++;
            }
        }

        $stmt = $conn->prepare(
            "INSERT INTO quiz_results (score, total) VALUES (?, ?)"
        );
        $stmt->bind_param("ii", $score, $total);
        $stmt->execute();
        $stmt->close();

        header("Location: Questionnaire.php?done=1");
        exit;
    }
?>
