<?php

include("db.php");

$stmt = $conn->prepare("SELECT * FROM product_details");

$stmt->execute();

$products = $stmt->get_result();



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
                        <li><a href="about_us.php">About Us</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="account.php">Account</a></li>
                        <li><a href="logout.php">logout</a></li>
                    </ul>
                </nav>
                <img src="assets/img/cart.png" width="30px" height="30px">
                <img src="assets/img/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>

            <div class="row">
                <div class="col-2">
                    <h1>AniHub: <br> Discover, Collect, Conquer!</h1>
                    <p>Dive into the world of anime collecting. Transform your space, fuel your passion, and curate a journey uniquely yours. Don't just watch, own the magic today!</p>
                    <a href="#products" class="btn">Explore Now &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="assets/img/homepage.png">
                </div>
            </div>
        </div>
    </div>    

            <!-----products section-->
            <h2 class="title">Products</h2>
            <div id="products" class="row">
                
            <?php while ($row = $products->fetch_assoc()) { ?>
    <div class="col-4">
        <img src="assets/img/<?php echo $row['product_image']; ?>">
        <h4><?php echo $row['product_name']; ?></h4>
        <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <p>$<?php echo $row['product_price']; ?></p>
        <div class="col-2">
            <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">  
                <input type="number" name="product_quantity" value="1">
                <button class="btn" type="submit" name="add_to_cart">Add To Cart</button> 
            </form>
        </div>
    </div>
<?php } ?>
</div>

            
<!--testimonial-->
        <div class="testimonial">
            <div class="small-container">
                <div class="row">
                    <div class="col-3">
                        <i class="fa fa-quote-left"></i>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere, eum!</p>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <img src="assets/img/joede.jpg">
                        <h3>Peter Parker</h3>
                    </div>

                    <div class="col-3">
                        <i class="fa fa-quote-left"></i>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere, eum!</p>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <img src="assets/img/jesuer.jpg">
                        <h3>Mark Grayson</h3>
                    </div>
                
                    <div class="col-3">
                        <i class="fa fa-quote-left"></i>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere, eum!</p>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <img src="assets/img/james.jpg">
                        <h3>Harry Osborn</h3>
                    </div>
                </div>
            </div>
        </div>  

        
        <!---brands-->
        <div class="brands">
            <div class="small-container">
                <div class="row">
                    <div class="col-5">
                        <img src="assets/img/reallogo1.png">
                    </div>
                    <div class="col-5">
                        <img src="assets/img/reallogo2.png">
                    </div>
                    <div class="col-5">
                        <img src="assets/img/reallogo3.png">
                    </div>
                    <div class="col-5">
                        <img src="assets/img/reallogo4.png">
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