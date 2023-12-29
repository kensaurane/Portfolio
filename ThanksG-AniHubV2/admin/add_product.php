<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
    $productImage = mysqli_real_escape_string($conn, $_POST['productImage']);
    $productStatus = mysqli_real_escape_string($conn, $_POST['productStatus']);

    // Perform an SQL INSERT query to add the new product
    $sql = "INSERT INTO product_details (product_name, product_price, product_image, product_status) 
            VALUES ('$productName', '$productPrice', '$productImage', '$productStatus')";

    if (mysqli_query($conn, $sql)) {
        // Product added successfully, redirect back to product management page
        header("Location: product_management.php");
        exit();
    } else {
        echo "Error adding product: " . mysqli_error($conn);
    }
}
?>
