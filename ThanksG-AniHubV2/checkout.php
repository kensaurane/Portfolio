<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host= 'localhost';
    $dbname= 'sample1';
    $username= 'root';
    $password= '';
    
    $conn = mysqli_connect($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!isset($_SESSION["logged_in"])) {
        header("location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    foreach ($_SESSION['cart'] as $item) {
        $item_id = $item['product_id'];
        $quantity_ordered = $item['product_quantity'];
        $date_ordered = date("Y-m-d H:i:s");
        $order_status = "Pending";

        $stmt = $conn->prepare("INSERT INTO orders (`user_id`, `product_id`, `qty_ordered`, `date_ordered`, `order_status`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiss", $user_id, $item_id, $quantity_ordered, $date_ordered, $order_status);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();

    unset($_SESSION['cart']);

    header("Location: order_success.php");
    exit();
}
?>
