<?php 

include("db.php");

if(!isset($_GET["product_id"])){

$product_id = $_GET["product_id"];

$stmt = $conn->prepare("SELECT * FROM product_details WHERE product_id = ?");
$stmt->bind_param("i", $product_id);    

$stmt->execute();

$products = $stmt->get_result();



}else{
    header('location: index.php');
}


 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Products-Anihub</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    </head>
    <body>

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

        <!--Single product details-->

    <div class="small-container single-product">

        <div class="small-container">
            <div class="row">

                <?php while($row = $products->fetch_assoc()){?>

                <div class="col-2">
                    <img src="assets/img/<?php echo $row['product_image'];?>" width="100%">
                </div>
                <div class="col-2">
                    <p>Home / No name muna</p>
                    <h1><?php echo $row['product_name']; ?></h1>
                    <h4><?php echo $row['product_price']; ?></h4>
                    <select>
                        <option>Select Size</option>
                        <option>XXL</option>
                        <option>XL</option>
                        <option>Large</option>
                        <option>Medium</option>
                        <option>Small</option>
                    </select>

                    <input type="number" value="1">
                    <a href="" class="btn">Add To Cart</a>
                    <h2>Product Details <i class="fa fa-indent"></i></h2>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, dolorum.</p>
                </div>
            </div>
        </div>

        <?php }?>



     <!---title-->
        <div class="small-container">
            <div class="row row-2">
                <h2>Related Products</h2>
                <p>View More</p>
            </div>
        </div>




        <!------------products-->
        <div class="small-container">

            <div class="row">
                <div class="col-4">
                    <img src="assets/img/tshirt1.jpg">
                    <h4>No name muna</h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <p>Php500.00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/tshirt2.jpg">
                    <h4>No name muna</h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <p>Php500.00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/tshirt3.jpg">
                    <h4>No name muna</h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <p>Php500.00</p>
                </div>
                <div class="col-4">
                    <img src="assets/img/tshirt5.jpg">
                    <h4>No name muna</h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <p>Php500.00</p>
                </div>
            </div>

        </div>
    </div>    
 
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