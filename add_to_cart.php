<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homestore";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn = new mysqli("localhost", "root", "", "homestore");
$conn = new mysqli("localhost:3307", "root", "", "homestore");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productName = $_POST['productName'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$imageUrl = $_POST['imageUrl'];

$sql = "INSERT INTO cart (product_name, price, quantity, image_url)
VALUES ('$productName', '$price', '$quantity', '$imageUrl')";

if ($conn->query($sql) === TRUE) {
    echo "Product added to cart successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>