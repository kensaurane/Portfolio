<?php
session_start();

// Check if product_id is provided in the URL
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Loop through cart items and remove the item with matching product_id
    foreach($_SESSION['cart'] as $index => $item) {
        if($item['product_id'] === $product_id) {
            unset($_SESSION['cart'][$index]); // Remove the item from the cart array
            break; // Stop the loop after removing the item
        }
    }
}

// Redirect back to the cart page after removing the item
header("Location: cart.php");
exit();
?>
