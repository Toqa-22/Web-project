<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Products</title>
</head>
<body>

<h2>Search Products</h2>

<form method="post">
    Product Name:
    <input type="text" name="name">

    Category:
    <input type="text" name="category">

    <input type="submit" name="search" value="Search">
</form>

<br>

<?php
if (isset($_POST["search"])) {
    $name = $_POST["name"];
    $category = $_POST["category"];

    $sql = "SELECT * FROM products 
            WHERE name LIKE '%$name%' 
            AND category LIKE '%$category%'";

    $result = mysqli_query($conn, $sql);

    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['price']}</td>
                <td>{$row['quantity']}</td>
              </tr>";
    }

    echo "</table>";
}
?>

</body>
</html>
