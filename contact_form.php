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

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$sql = "INSERT INTO contact_messages (name, email, message)
VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>