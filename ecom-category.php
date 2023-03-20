<?php
include 'ecom-header.php';
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
	<title>Shop By Category</title>
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="webpage">
	<!--Banner.-->
	
			<ul class="breadcrumbs">
				<li><a href="home.php">Homepage</a></li>
				<!-- <li>Fish</li> -->
				<li>Shop by category</li>
			</ul>
			<br>
			<div class="banner">
				<h2 style="text-align: center;"><!--Fish | -->Shop by category</h3>
					<br>
					<div class="round-image">
					<?php
					// Categories is FISH CATEGORY
    					$select_category = "SELECT * from categories";
						$result_category = mysqli_query($link, $select_category);
						
						while($row_data = mysqli_fetch_assoc($result_category)){
							$category_title = $row_data['category_title'];
							$category_image = $row_data['category_img'];
							$category_id = $row_data['category_id'];
							echo "<div class='shop-category-box'><a href='ecom-product-listing.php?category=$category_id'><img src='./Category Images/$category_image'><a href='#Betta'>
							$category_title</a></div>";
						}
    				?>
						<!--
						<div class="shop-category-box"><a href="product-listing-betta copy.html"><img src="images/placeholder4.jpg"><a href="#Betta">
							Betta</a></div>
						<div class="shop-category-box"><a href="#Guppy"><img src="images/placeholderGuppy.png"></a><a href="#Guppy">
							Guppy</a></div>
						<div class="shop-category-box"><a href="#Oscar"><img src="images/placeholderOscar.jpg"></a><a href="#Oscar">
							Oscar</a></div>
						<div class="shop-category-box"><a href="#Imported"><img src="images/placeholder2.jpg"></a><a href="#Imported">
							Imported</a></div>
						<div class="shop-category-box"><a href="#Local"><img src="images/placeholder6.png"></a><a href="#Local">
							Local</a></div>
						-->
					</div>
			</div>
			<br>
		</div>
		<footer>
		<div id="footer" class="footer">
		<a href="#top" style="display:block;">Back to top</a><br></a>
		<div class="socials">
			<h3>Follow us on Facebook:</h3><a href="https://www.facebook.com/bpfs2020/" class="facebook"><i class="fa fa-facebook"></i></a>
		</div>
		<br>
		<h6>&copy; 2022 Bulacan Pet Fish Supply <br> All rights reserved. </h6>
		</div>
		</footer>
	<!--JavaScripts are at the bottom of the page so the page loads faster (the javascript loads slower)-->
	<script src="js/script.js"></script>

</body>
</html> 