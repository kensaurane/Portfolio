<?php
session_start();

// Check if the product has been added to the cart
if(isset($_POST['add_to_cart'])) {
    // Initialize or create an array to store cart items in the session
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // Retrieve product details from the form
    $product_id = $_POST['product_id'];
    $product_image = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    
    // Store product details in an array
    $product = array(
        'product_id' => $product_id,
        'product_image' => $product_image,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_quantity' => $product_quantity
    );
    
    // Add the product to the cart array in the session
    $_SESSION['cart'][] = $product;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .navbar {
            background-color: black;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .logo img {
            width: 90px;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffd700;
        }

        .menu-icon {
            display: none;
            cursor: pointer;
        }

        @media only screen and (max-width: 768px) {
            nav {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 60px;
                left: 0;
                background-color: #333;
            }

            nav.show {
                display: flex;
            }

            nav ul {
                flex-direction: column;
            }

            nav ul li {
                margin: 10px 0;
            }

            .menu-icon {
                display: block;
            }
        }

        /* Cart Page Styles */

        .cart-page {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cart-info {
            display: flex;
            align-items: center;
        }

        .cart-info img {
            max-width: 80px;
            max-height: 80px;
            margin-right: 20px;
            border-radius: 8px;
        }

        input {
            width: 50px;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 6px;
        }

        .total-price {
            margin-top: 20px;
        }

        .total-price table {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
        }

        .total-price td {
            text-align: right;
            padding: 15px;
        }

        /* Footer Styles */

        .footer {
            background-color: black;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 20px;
        }

        .footer .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .footer-col-l, .footer-col-2, .footer-col-3, .footer-col-4 {
            flex: 1;
            margin-right: 20px;
        }

        .app-logo img {
            max-width: 150px;
            margin-top: 10px;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-size: 24px;
        }

        .social-icons a:hover {
            color: #ffd700;
        }

        .copyright {
            margin-top: 20px;
        }
        
        body {
        background-image: url('assets/img/');
        }
        
    </style>
</head>
<body>

<div class="container">
    <div class="navbar">
        <div class="logo">
            <img src="assets/img/realmainlogoputi.png" width="100px" alt="Logo">
        </div>
        <nav>
            <ul id="MenuItem">
                <li><a href="index.php">Home</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </nav>
        <img src="assets/img/cart.png" width="50px" height="50px" alt="Cart">
        <img src="assets/img/menu.png" class="menu-icon" onclick="menutoggele()" alt="Menu Icon">
    </div>
</div>


<!-- Cart Page -->

<div class="container cart-page">
    <table>
        <tr>
            <th>Product</th>
            <th>Subtotal</th>
        </tr>

        <?php
        // Check if cart is not empty
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Loop through cart items and display each product
            foreach($_SESSION['cart'] as $item) {
              // ...

                echo '<tr>';
                echo '<td>';
                echo '<div class="cart-info">';
                echo '<img src="assets/img/' . $item['product_image'] . '" alt="' . $item['product_name'] . '">';
                echo '<div>';
                echo '<p>' . $item['product_name'] . '</p>';
                echo '<small>Price: $' . $item['product_price'] . '</small><br>';
                echo '<p>Quantity: ' . $item['product_quantity'] . '</p>'; // Display chosen quantity
                echo '<a href="remove_item.php?product_id=' . $item['product_id'] . '">Remove</a>';
                echo '</div>';
                echo '</div>';
                echo '</td>';
                echo '<td>$' . ($item['product_quantity'] * $item['product_price']) . '</td>';
                echo '</tr>';


            }
        } else {
            // If cart is empty, display a message
            echo '<tr><td colspan="3">Your cart is empty</td></tr>';
        }
        ?>

    </table>

    <!-- Total price calculation -->
    <?php
    // Calculate total price of all products in the cart
    $total_price = 0;
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $item) {
            $total_price += $item['product_quantity'] * $item['product_price'];
        }
    }
    ?>
    
    <!-- Display total price -->
    <div class="total-price">
        <table>
            <tr>
                <td>Subtotal</td>
                <td>$<?php echo number_format($total_price, 2); ?></td>
            </tr>
            <!-- You can calculate and display tax and total here -->
            <!-- Adjust this part according to your tax calculation logic -->
        </table>
    </div>
    <!-- Checkout Button -->
    
    <div class="checkout-container">
        <form method="POST" action="checkout.php">
            <!-- Check if the "checkout" button is clicked -->
            <button class="btn" name="checkout">Checkout</button>
        </form>
    </div>
</div>

</div>
<script>
    function updateQuantity(index, newQuantity) {
        // Update the quantity in the session cart array
        <?php
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            echo '$_SESSION["cart"][' . "index" . ']["product_quantity"] = newQuantity;';
        }
        ?>
        // Refresh the page or update the cart view dynamically using JavaScript
        // You might want to implement AJAX for a smoother user experience
        location.reload();
    }
</script>


<!-- Footer -->

<div class="footer">
    <div class="container">
        <div class="footer-col-l">
            <h3>Download our App</h3>
            <p>Download App for Android and iOS mobile phone.</p>
            <div class="app-logo">
                <img src="assets/img/play-store.png" alt="Play Store">
                <img src="assets/img/app-store.png" alt="App Store">
            </div>
        </div>
        <div class="footer-col-2">
            <img src="assets/img/realmainlogoputi.png" alt="Footer Logo">
            <p>Quote.</p>
        </div>
        <div class="footer-col-3">
            <h3>Useful Links</h3>
            <ul>
                <li>Coupons</li>
                <li>Blog Post</li>
                <li>Return Policy</li>
                <li>Join Affiliate</li>
            </ul>
        </div>
        <div class="footer-col-4">
            <h3>Follow us</h3>
            <ul>
                <li>Facebook</li>
                <li>Twitter</li>
                <li>Instagram</li>
                <li>YouTube</li>
            </ul>
        </div>
    </div>
    <hr>
    <p class="copyright">Copyright 2023 - Easy Tutorials</p>
</div>

<script>
    function menutoggele() {
        var nav = document.querySelector('nav');
        nav.classList.toggle('show');
    }
</script>

</body>
</html>