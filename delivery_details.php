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

$fullName = $_POST['fullName'];
$address = $_POST['address'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$contactNumber = $_POST['contactNumber'];

$sql = "INSERT INTO delivery_details (full_name, address, city, pincode, contact_number)
VALUES ('$fullName', '$address', '$city', '$pincode', '$contactNumber')";

if ($conn->query($sql) === TRUE) {
    echo "Delivery details saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>