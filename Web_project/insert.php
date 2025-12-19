<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h2>Add New Product</h2>

<form method="post">
    Name: <input type="text" name="name"><br><br>
    Category: <input type="text" name="category"><br><br>
    Price: <input type="number" step="0.01" name="price"><br><br>
    Quantity: <input type="number" name="quantity"><br><br>
    <input type="submit" name="add" value="Add Product">
</form>

<?php
if (isset($_POST["add"])) {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $sql = "INSERT INTO products (name, category, price, quantity)
            VALUES ('$name', '$category', '$price', '$quantity')";

    if (mysqli_query($conn, $sql)) {
        echo "Product added successfully.";
    } else {
        echo "Error.";
    }
}
?>

</body>
</html>
