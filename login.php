<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debugging: Print the received form data
print_r($_POST);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homestore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$mobile = $_POST['mobile'];
$password = $_POST['password'];

// Debugging: Print the received mobile and password
echo "Mobile: $mobile, Password: $password<br>";

// Check if the user exists in the database
$sql = "SELECT * FROM users WHERE mobile='$mobile' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful";
} else {
    echo "Invalid credentials";
}

$conn->close();
?>