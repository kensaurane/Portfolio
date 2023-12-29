<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the product_id is set and not empty
    if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
        // Sanitize the input to prevent SQL injection
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

        // Construct and execute the SQL DELETE query
        $sql = "DELETE FROM product_details WHERE product_id = '$product_id'";
        if (mysqli_query($conn, $sql)) {
            header("location: product_management.php");
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    } else {
        echo "Product ID is missing or empty";
    }
}
?>
