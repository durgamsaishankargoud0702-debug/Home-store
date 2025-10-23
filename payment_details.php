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

$cardName = $_POST['cardName'];
$cardNumber = $_POST['cardNumber'];
$expiry = $_POST['expiry'];
$cvv = $_POST['cvv'];
$amount = $_POST['amount'];

$sql = "INSERT INTO payments (card_name, card_number, expiry, cvv, amount)
VALUES ('$cardName', '$cardNumber', '$expiry', '$cvv', '$amount')";

if ($conn->query($sql) === TRUE) {
    echo "Payment successful";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>