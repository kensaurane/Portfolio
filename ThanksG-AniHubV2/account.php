<?php
session_start();
include("db.php");

if (!isset($_SESSION["logged_in"])) {
    header("location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["change_password"])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_SESSION['email_add'];

    if ($password === $confirmPassword) {
        // Hash the new password before updating in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the update statement
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email_add = ?");
        
        if (!$stmt) {
            $_SESSION['error'] = "Prepare failed: " . $conn->error;
            header("Location: account.php");
            exit();
        }

        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Password updated successfully";
            header("Location: account.php");
            exit();
        } else {
            $_SESSION['error'] = "Password update failed";
            header("Location: account.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: account.php");
        exit();
    }
}
?>




    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Anihub | Eccomerce Website Design</title>
            <link rel="stylesheet" href="style.css">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
            /* General styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #fff; /* White background */
        color: #000; /* Black text */
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Account info section */
    .my-5 {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    .account-info p {
        margin: 0;
        line-height: 2;
    }

    .account-info a {
        text-decoration: none;
        color: #000; /* Black link color */
        transition: color 0.3s ease;
    }

    .account-info a:hover {
        color: #999; /* Dark gray on hover */
    }

    /* Change Password form */
    #account-form {
        background-color: #fff; /* White background */
        color: #000; /* Black text */
        padding: 20px;
        border: 1px solid #000; /* Black border */
        border-radius: 5px;
    }

    #account-form label {
        font-weight: bold;
    }

    #account-form input[type="password"],
    #account-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #000; /* Black border */
        border-radius: 3px;
    }

    #account-form input[type="submit"] {
        background-color: #000; /* Black button */
        color: #fff; /* White text */
        cursor: pointer;
    }

    #account-form input[type="submit"]:hover {
        background-color: #666; /* Dark gray on hover */
    }
    /* General styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #fff; /* White background */
        color: #000; /* Black text */
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Account info section */
    .my-5 {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    .account-info p {
        margin: 0;
        line-height: 2;
    }

    .account-info a {
        text-decoration: none;
        color: #000; /* Black link color */
        transition: color 0.3s ease;
    }

    .account-info a:hover {
        color: #999; /* Dark gray on hover */
    }

    /* Change Password form */
    #account-form {
        background-color: #fff; /* White background */
        color: #000; /* Black text */
        padding: 20px;
        border: 1px solid #000; /* Black border */
        border-radius: 5px;
    }

    #account-form label {
        font-weight: bold;
    }

    #account-form input[type="password"],
    #account-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #000; /* Black border */
        border-radius: 3px;
    }

    #account-form input[type="submit"] {
        background-color: #000; /* Black button */
        color: #fff; /* White text */
        cursor: pointer;
    }

    #account-form input[type="submit"]:hover {
        background-color: #666; /* Dark gray on hover */
    }


    </style>

        </head>
        <body>

        <div class="header">
            <div class="container">
                <div class="navbar">
                    <div class="logo">
                        <img src="assets/img/realmainlogoblack.png" width="100px">
                    </div>
                    <nav>
                        <ul id="MenuItems">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="">About Us</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                            <li><a href="account.php">Account</a></li>
                            <li><a href="logout.php">logout</a></li>
                        </ul>
                    </nav>
                    <img src="assets/img/cart.png" width="30px" height="30px">
                    <img src="assets/img/menu.png" class="menu-icon" onclick="menutoggle()">
                </div>
            </div>
        </div>  
    
    
    
    
    
    
    <!--Account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <h3 class="font-weight-bold">Account info</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Username:<span> <?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];} ?> </span></p>
                    <p>Email:<span> <?php if(isset($_SESSION['email_add'])){ echo $_SESSION['email_add'];} ?> </span></p>
                    <p><a href="#orders" id="orders-btn">Your orders</a></p>
                    <p><a href="logout.php" id="logout-btn">Logout</a></p>    
                </div>
            </div>
                
        <div class="col-lg-6 col-md-12 col-sm-12">
            <form id="account-form" method="POST" action="account.php">
                <p class="text-center" style="color:red">
                    <?php if(isset($_GET['error'])){ echo $_GET['error'];} ?>
                </p>
                <p class="text-center" style="color:green">
                    <?php if(isset($_GET['message'])){ echo $_GET['message'];} ?>
                </p>

             </form>
        </div>

        </div>
    </section>

    <!--Order-->
<section id="orders" class="order container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Order</h2>
        <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5">
       
        <?php
          
           $host= 'localhost';
           $dbname= 'sample1';
           $username= 'root';
           $password= '';
           
           $conn = mysqli_connect($host, $username, $password, $dbname);
           

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if the user is logged in and the user ID is set in the session
            if (isset($_SESSION['user_id'])) {
                // Retrieve the user ID from the session
                $user_id = $_SESSION['user_id'];
                // Use $user_id for further processing or displaying user-specific data
            } else {
                // Redirect the user to the login page or handle non-logged-in users
                header("Location: login.php"); // Redirect to the login page
                exit(); // Terminate script execution after redirection
            }

    // Your SQL query to retrieve order details and associated product information
    $sql = "SELECT orders.order_id, orders.date_ordered, orders.qty_ordered, product_details.product_image, product_details.product_name, product_details.product_price
            FROM orders 
            INNER JOIN product_details ON orders.product_id = product_details.product_id 
            WHERE orders.user_id = $user_id";

    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error executing the query: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        // Displaying the order information
        while($row = $result->fetch_assoc()) {
            echo '<div class="order-item">';
            echo '<p>Product name: ' . $row["product_name"] . '</p>';
            echo '<p>Quantity: ' . $row["qty_ordered"] . '</p>';
            echo '<p>Date Ordered: ' . $row["date_ordered"] . '</p>';
            
            // Calculate and display total price
            $total_price = $row["qty_ordered"] * $row["product_price"];
            echo '<p>Total Price: $' . number_format($total_price, 2) . '</p>';
        
            echo '</div>';
        }
    } else {
        echo "No orders yet.";
    }

    // Closing your database connection
?>
    </table>
</section>



    <!--Footer-->
    <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="footer-col-1">
                            <h3>Download Our App</h3>
                            <p>Download App for Android and ios.</p>
                            <div class="app-logo">
                                <img src="assets/img/play-store.png">
                                <img src="assets/img/app-store.png">
                            </div>
                        </div>

                        <div class="footer-col-2">
                            <img src="assets/img/realmainlogoputi.png">
                            <p>Your go-to source for premium anime merchandise that brings your favorite worlds to life.</p>
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
                            <h3>Follow US</h3>
                            <ul>
                                <li>Facebook</li>
                                <li>Twitter</li>
                                <li>Instagram</li>
                                <li>Youtube</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <p class="copyright">Copyright 2023 - ThanksG | AniHub</p>
                </div>
            </div>

            <!--js for toggle menu-->
            <script>
                var MenuItems = document.getElementById("MenuItems");

                MenuItems.style.maxHeight = "0px";

                function menutoggle(){
                    if(MenuItems.style.maxHeight == "0px"){
                        MenuItems.style.maxHeight = "200px";
                    }
                    else{
                        MenuItems.style.maxHeight = "0px";
                    }
                }
            </script>
        </body>
    </html>