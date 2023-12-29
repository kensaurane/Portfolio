<?php
session_start(); 
include('../db.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'A') {
    header('location: ../login.php?message=You cannot be here');
    exit;
}

// Retrieve orders and product details from the database
$sql = "SELECT orders.order_id, product_details.product_name, orders.order_status 
        FROM orders 
        INNER JOIN product_details ON orders.product_id = product_details.product_id";
$result = mysqli_query($conn, $sql);

// Check if the query execution returned valid results
if (!$result) {
    die('Error retrieving data: ' . mysqli_error($conn));
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
            height: 100vh;
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
                    <a href="#" class="logo">
                        <img src="../assets/img/realmainlogoblack.png" alt="">
                        <span class="nav-item">AniHub DashBoard</span>
                    </a>
                </li>
                <li>
                    <a href="#main">
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

        <section class="main">
            <h1>TOTAL SALES</h1>
            <?php
            // Fetch total sales for delivered orders considering quantity
            $totalSalesQuery = "SELECT SUM(orders.qty_ordered * product_details.product_price) AS total_sales 
                                FROM orders 
                                INNER JOIN product_details ON orders.product_id = product_details.product_id 
                                WHERE orders.order_status = 'D'";
            $totalSalesResult = mysqli_query($conn, $totalSalesQuery);

            if (!$totalSalesResult) {
                die('Error retrieving total sales: ' . mysqli_error($conn));
            }

            $totalSalesData = mysqli_fetch_assoc($totalSalesResult);
            $totalSales = $totalSalesData['total_sales'];
            ?>
            <div class="course-box">
                <p>Pantalpak: $<?php echo $totalSales; ?></p>
            </div>
        </section>
        <section class="main">
    <h1>TOTAL ORDERS</h1>
    <div class="course-box">
        <!-- Table for displaying orders -->
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Order Status (Editable)</th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Modify your SQL query to include quantity information
                $sql = "SELECT orders.order_id, product_details.product_name, orders.order_status, orders.qty_ordered
                        FROM orders 
                        INNER JOIN product_details ON orders.product_id = product_details.product_id";
                $result = mysqli_query($conn, $sql);

                // Check for query execution success
                if (!$result) {
                    die('Error fetching orders: ' . mysqli_error($conn));
                }

                // Loop through the retrieved orders and populate the table rows
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['qty_ordered'] . "</td>"; // Corrected column name
                    echo "<td>";
                    echo "<form method='POST' action='update_status.php'>";
                    echo "<input type='hidden' name='orderId' value='" . $row['order_id'] . "'>";
                    echo "<input type='text' name='updatedStatus' value='" . $row['order_status'] . "'>";
                    echo "<button type='submit'>Update</button>";
                    echo "</form>";
                    echo "</td>";
                    // Add more columns here if needed
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>


    </div>
</body>

</html>