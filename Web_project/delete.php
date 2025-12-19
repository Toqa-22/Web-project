<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Product</title>
</head>
<body>

<h2>Delete Product</h2>

<form method="post">
    Product ID:
    <input type="number" name="id">
    <input type="submit" name="delete" value="Delete">
</form>

<?php
if (isset($_POST["delete"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM products WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product.";
    }
}
?>

</body>
</html>
