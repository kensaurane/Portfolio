<?php
session_start();

include('../db.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'A') {
    header('location: ../login.php?message=You cannot be here');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted orderId and updatedStatus
    $orderId = $_POST['orderId'];
    $updatedStatus = $_POST['updatedStatus'];

    // Sanitize input to prevent SQL injection
    $orderId = mysqli_real_escape_string($conn, $orderId);
    $updatedStatus = mysqli_real_escape_string($conn, $updatedStatus);

    // Update the order status in the database
    $updateQuery = "UPDATE orders SET order_status = '$updatedStatus' WHERE order_id = '$orderId'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // If the update was successful, redirect back to the dashboard or any desired page
        header('location: index.php');
        exit;
    } else {
        // If the update failed, handle the error accordingly
        echo "Failed to update order status. Please try again.";
    }
}
?>
