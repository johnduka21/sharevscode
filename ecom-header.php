<?php
    session_start();
    $guest = "Guest";
    $_SESSION['guest'] = $guest;
    //session_destroy();
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
	<link rel="stylesheet" href="css/ecom-header.scss">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <div class="logo">
            <a href="home.php"><h4>Bulacan Pet Fish Supply</h4></a>
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="ecom-product-listing.php?products">Products</a></li>
            <li><a href="ecom-category.php">Categories</a></li>
            <li><a href="index.php">Site Guide</a></li>
            <?php
                    require_once 'php/dbh.php';
                    include 'php/functions.php';
                    if (isset($_SESSION['usersuid'])){
                    ?>
                        <li><a href='ecom-pending-orders.php?pending-order-list=<?=$_SESSION['usersid']?>'>My Orders</a></li>
                        <li><a href='ecom-profile.php'>Profile</a></li>
                        <li><a href='php/logout.php' onClick="javascript: return confirm('Are You Sure You Want to Logout?')">Logout</a></li>
                    <?php
                    } else{
                        echo "<li><a href='php/signin.php'>Login</a></li>";
                        echo "<li><a href='php/signup.php'>Sign-Up</a></li>";
                    }
                ?>
            <?php if(!isset($_SESSION['usersuid'])){
                echo "<li><a href='ecom-sign-in.php?please-sign-in'><i class='fa-solid fa-cart-shopping'></i><sup></a></li>";
            } if (isset($_SESSION['usersuid'])) {
                echo " <li><a href='ecom-cart-3.php'><i class='fa-solid fa-cart-shopping'></i><sup>
                <?php cartItem() ?></sup></a></li>";
            } ?>
        </ul>
        <form action="ecom-product-listing.php" method="GET">
            <div class="search-bar">
                <input type="search" placeholder="Search Product" class="search-input" name="search_data">
                <button name="search_data_product" value="search" type="submit"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <div class="burger">
            <div class="line-1"></div>
            <div class="line-2"></div>
            <div class="line-3"></div>
        </div>
    </nav>

    <!-- PHP and JavaScript -->
    <?php addToCart();?>
    <script src="js/ecom-header.js"></script>
</body>