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

$mobile = $_POST['mobile'];
$password = $_POST['password'];

$sql = "INSERT INTO users (mobile, password)
VALUES ('$mobile', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "User registered successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>