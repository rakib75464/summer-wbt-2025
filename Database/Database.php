<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "product_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to database <br>";
}

$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    buying_price DECIMAL(10,2),
    selling_price DECIMAL(10,2),
    status VARCHAR(20) DEFAULT 'Not displayable'
)";
if ($conn->query($sql) === TRUE) {
    echo " Table 'products' is ready.<br>";
} else {
    echo " Error creating table: " . $conn->error . "<br>";
}

// Add product
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $buying = $_POST['buying_price'];
    $selling = $_POST['selling_price'];
    $status = isset($_POST['display']) ? 'Displayable' : 'Not displayable';

    $sql = "INSERT INTO products (name, buying_price, selling_price, status) 
            VALUES ('$name','$buying','$selling','$status')";
    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully.<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}

// Update product
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $buying = $_POST['buying_price'];
    $selling = $_POST['selling_price'];
    $status = isset($_POST['display']) ? 'Displayable' : 'Not displayable';

    $sql = "UPDATE products 
            SET name='$name', buying_price='$buying', selling_price='$selling', status='$status' 
            WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}

// Delete product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
}

// Search products
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['searchValue'];
}

$sql = "SELECT * FROM products";
if ($search != "") {
    $sql .= " WHERE name LIKE '%$search%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 90%; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 10px; text-align: center; }
        input, button { padding: 5px; margin: 5px; }
    </style>
</head>
<body>

<h2>Add Product</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" step="0.01" name="buying_price" placeholder="Buying Price">
    <input type="number" step="0.01" name="selling_price" placeholder="Selling Price">
    <label>
        <input type="checkbox" name="display"> Display
    </label>
    <button type="submit" name="add">Add</button>
</form>

<h2>Search Product</h2>
<form method="POST">
    <input type="text" name="searchValue" placeholder="Search by name">
    <button type="submit" name="search">Search</button>
    <button type="submit" name="view">View Products</button>
</form>

<h2>Product List</h2>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Buying Price</th><th>Selling Price</th><th>Status</th><th>Actions</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['buying_price'] ?></td>
            <td><?= $row['selling_price'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="text" name="name" value="<?= $row['name'] ?>">
                    <input type="number" step="0.01" name="buying_price" value="<?= $row['buying_price'] ?>">
                    <input type="number" step="0.01" name="selling_price" value="<?= $row['selling_price'] ?>">
                    <label>
                        <input type="checkbox" name="display" <?= $row['status']=='Displayable' ? 'checked' : '' ?>> Display
                    </label>
                    <button type="submit" name="update">Update</button>
                </form>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this product?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="6">No products found.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
