<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homestore";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate required fields
    if (!isset($_POST["productName"], $_POST["productPrice"], $_POST["mobileNumber"], $_POST["storeName"], $_POST["storeAddress"], $_POST["quantity"])) {
        die("Error: Missing form fields.");
    }

    // Get form values safely
    $name = $conn->real_escape_string($_POST["productName"]);
    $price = $conn->real_escape_string($_POST["productPrice"]);
    $mobile = $conn->real_escape_string($_POST["mobileNumber"]);
    $storeName = $conn->real_escape_string($_POST["storeName"]);
    $storeAddress = $conn->real_escape_string($_POST["storeAddress"]);
    $quantity = $conn->real_escape_string($_POST["quantity"]);

    // Handle image upload
    $imagePath = "uploads/default.jpeg"; // Default image if upload fails

    if (isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
        }

        $imageName = time() . "_" . basename($_FILES["productImage"]["name"]); // Add timestamp to avoid duplicates
        $imagePath = $targetDir . $imageName;

        if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], $imagePath)) {
            die("Error: Image upload failed.");
        }
    }

    // Insert data into database using prepared statement
    $stmt = $conn->prepare("INSERT INTO products (name, price, mobile, store_name, store_address, quantity, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsssis", $name, $price, $mobile, $storeName, $storeAddress, $quantity, $imagePath);

    if ($stmt->execute()) {
        echo "New product added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Form not submitted!";
}

$conn->close();
?>
