<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en-PH">
<head>
	<!--METADATA: GOOGLE SEO STUFF AND MAKING THIS GOOD FOR MOBILE-->
	<meta charset= "UTF-8">
	<meta name = "description" content = "Bulacan Pet Fish Supply E-Commerce">
	<meta name = "keywords" content = "Bulacan, fish, pet fish, fish supply, fish supplies, fish accessory, fish accessories, fish store, 
	aquarium, aquarium tank">
	<meta name = "author" content = "Daniep Curvie Sleebush">
	<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
	<!--Title, Favicons, Font, Icons in Font, and CSS Stylesheet-->
	<title>Bulacan Pet Fish Supply</title>
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/main.scss">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="webpage">
	<!--Banner.-->
	<nav>
        <div class="navBar">
            <div class="container">
                <a href="home.php">Bulacan Pet Fish Supply</a>
                <a class ="nav-btn" href="home.php">Home</a>
                <a href="ecom-product-listing.php">Products</a>
                <a href="ecom-fish-category.php">Categories</a>
                <!-- <a href="ecom-aquarium-category.php">Aquarium</a>
                <a href="ecom-accessories-category.php">Accessories</a> -->
                <?php
                    require_once 'php/dbh.php';
                    include 'php/functions.php';
                    if (isset($_SESSION['usersuid'])){
                        echo "Welcome<a href='php/profile.php'>Profile</a>";
                        echo "<a href='php/logout.php'>Logout</a>";
                    } 
                    else {
                        echo "<a href='php/signin.php'>Login</a>";
                        echo "<a href='php/signup.php'>Sign-Up</a>";
                    }
                ?>
                <a href="#"><i class="fa-solid fa-cart-shopping"></i><sup><?php cartItem() ?></sup></a>
                <div class="navItem">
                    
                    <div class="search-box">
                        <form action="php\search-product.php" method="get">
                        <input type="text" placeholder="Search Products" name="search">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass" name="search-product"></i></button>
                        <!-- <input type="submit" value="Search Products" class="fa-solid fa-magnifying-glass" name="search-product"> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav> 
    <?php addToCart();?>
</div>
</body>