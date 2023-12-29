<?php

session_start();

include("../db.php");

if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'A') {
    header('location: ../login.php?message=You cannot be here');
    exit;
}

// Perform a query to fetch information from the product_details table
$sql = "SELECT * FROM product_details";
$result = mysqli_query($conn, $sql);

// Check if a form for updating status is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateStatus'])) {
    // Get the product ID and status from the submitted form
    $productId = $_POST['productId'];
    $productStatus = $_POST['productStatus'];

    // Perform an update query to change the status in the database
    $updateSql = "UPDATE product_details SET product_status = '$productStatus' WHERE product_id = $productId";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        // Status updated successfully
        // Redirect or perform any other action after update
        // header("Location: current_page.php"); // Redirect to the same page or another page
        // exit(); // Ensure that no further code is executed after redirection
    } else {
        // Handle update failure
        echo "Error updating status: " . mysqli_error($conn);
    }
}

// Check if the query was successful
if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard | By Code Info</title>
    <!-- Import Poppins Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700">
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700");
        * {
            margin: 0;
            padding: 0;
            outline: none;
            border: none;
            text-decoration: none;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            filter: grayscale(100%);
        }

        body {
            background: #dfe9f5;
            filter: none;
        }

        .container {
            display: flex;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            height: 300vh;
            background: #fff;
            width: 280px;
            overflow: hidden;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            display: flex;
            margin: 10px 0 0 10px;
        }

        .logo img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }

        .logo span {
            font-weight: bold;
            padding-left: 15px;
            font-size: 18px;
            text-transform: uppercase;
        }

        a {
            position: relative;
            color: rgb(85, 83, 83);
            font-size: 14px;
            display: block;
            width: 280px;
            padding: 10px;
        }

        nav .fas {
            position: relative;
            width: 70px;
            height: 40px;
            top: 14px;
            font-size: 20px;
            text-align: center;
        }

        .nav-item {
            position: relative;
            top: 12px;
            margin-left: 10px;
        }

        a:hover {
            background: #eee;
        }

        .logout {
            position: absolute;
            bottom: 0;
        }

        /* Main Section */
        .main {
            margin-left: 280px;
            padding: 20px;
        }

        .main h1 {
            margin-bottom: 20px;
        }

        .course-box table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .course-box th,
        .course-box td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
<div class="container">
        <nav>
            <ul>
                <li>
                    <a href="index.php" class="logo">
                        <img src="../assets/img/realmainlogoblack.png" alt="">
                        <span class="nav-item">AniHub DashBoard</span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <i class="fas fa-home"></i>
                        <span class="nav-item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="product_management.php">
                        <i class="fas fa-store"></i>
                        <span class="nav-item">Products</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php">
                        <i class="fas fa-power-off"></i>
                        <span class="nav-item">logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="main">
        <h1>Product Details</h1>
        <div class="course-box">
            <!-- Displaying product details in a table -->
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Product Image</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each row of data and display it in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['product_id'] . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>$" . $row['product_price'] . "</td>";
                        // Display the product image and its name in a single cell
                        echo "<td>";
                        echo "<img src='" . $row['product_image'] . "' alt='Product Image' style='width: 100px; height: auto;'>";
                        
                        // Get the filename without extension
                        $imageName = pathinfo($row['product_image'], PATHINFO_FILENAME);
                        echo "<p>" . $imageName . "</p>"; // Displaying the file name without the extension
                        
                                            echo "<td>";
                        echo "<form method='POST' action='delete_product.php' onsubmit='return confirm(\"Are you sure you want to delete?\")'>";
                        echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
                        echo "<button type='submit'>Delete</button>";
                        echo "</form>";
                        echo "</td>";

                        // Update product status form
                        echo "<td>";
                        echo "<form method='POST' action=''>"; // Empty action submits to the same page
                        echo "<input type='hidden' name='productId' value='" . $row['product_id'] . "'>";
                        echo "<select name='productStatus'>";
                        echo "<option value='Active'>Active</option>";
                        echo "<option value='Out_of_stock'>Out of stock</option>";
                        echo "</select><br><br>";
                        echo "<button type='submit' name='updateStatus'>Update Status</button>";
                        echo "</form>";
                        echo "</td>";

                        // Add more columns as needed
                        echo "</tr>";
                                
                       
                    }
                    ?>
                </tbody>
            </table>
           <!-- Add Product Section -->
            <section class="main">
                <h1>Add Product</h1>
                <div class="course-box">
                    <form method="POST" action="add_product.php">
                        <label for="productName">Product Name:</label>
                        <input type="text" id="productName" name="productName" required><br><br>

                        <label for="productPrice">Price:</label>
                        <input type="number" id="productPrice" name="productPrice" required><br><br>

                        <label for="productImage">Image URL:</label>
                        <input type="text" id="productImage" name="productImage" required><br><br>

                        <label for="productStatus">Status:</label>
                        <select id="productStatus" name="productStatus">
                            <option value="Active">Active</option>
                            <option value="Out_of_stock">Out of stock</option>
                        </select><br><br>

                        <button type="submit">Add Product</button>
                    </form>
                </div>
            </section>

        </div>
    </div>
</body>

</html>