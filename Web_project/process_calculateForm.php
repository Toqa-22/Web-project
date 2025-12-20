<?php
    require_once "db.php";

    function clean($v) {
        return htmlspecialchars(trim($v));
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $basicItems   = clean($_POST["basicItems"]);
        $specialItems = clean($_POST["specialItems"]);
        $wantDelivery = isset($_POST["wantDelivary"]) ? "yes" : "no";

        if ($basicItems === "" || $specialItems === "") {
            exit("Please fill out all fields");
        }

        $basicPrice = 0.500;
        $specialPrice = 1;
        $deliveryFee = 1;

        $total = ($basicItems * $basicPrice) + ($specialItems * $specialPrice);
        if ($wantDelivery === "yes") {
            $total += $deliveryFee;
        }

        $stmt = $conn->prepare(
            "INSERT INTO bills (basicItems, specialItems, wantDelivery, total)
            VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("iisd", $basicItems, $specialItems, $wantDelivery, $total);
        $stmt->execute();
        $stmt->close();

        header("Location: calculate.php?success=1");
        exit;
    }
?>

