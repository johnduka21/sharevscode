<?php
    //session_start();
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
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="webpage">
	<!--Banner.-->

	<?php
	include 'ecom-header.php';
	$select_query="SELECT * FROM users";
    $result_query= mysqli_query($link, $select_query);
    $row=mysqli_fetch_assoc($result_query);
	$fname=$row['usersFirstName'];
	?>

				<ul class="breadcrumbs">
				  <!-- <li><?php echo"Welcome $fname"; ?></li> -->
				</ul> 
				<br>
				<div class="wide-image">
					<div class="image-over-text">
					  <h1>Buy your own pet fish today! Available for delivery anywhere from Luzon!</h1>
					  <br>
					  <p>Exotic fishes, aquariums, decorations, and equipment are all for sale in our store. We can deliver these from 
						  anywhere in the Luzon Region. Buy one today!</p>
					  <br><a href='ecom-category.php'><button>Get started</button></a>
					</div>
				  </div> 
				  <br><br>
				<h3>New Arrival</h3>
				 <!-- Slideshow container -->
				<div class="slideshow-container">
				<?php $new_arrival = "SELECT * FROM `products` ORDER BY date_added DESC LIMIT 5";
				$result_arrival = mysqli_query($link, $new_arrival);
				while($row_arrival = mysqli_fetch_assoc($result_arrival)){?>
				<!--Recent Product Slides-->
				  <div class="recentSlides fade">
					  <!--With PHP code, replace code with a JavaScript while loop of one product-box-->
					<div class="product-box">
						<img src="Product Images/<?php echo $row_arrival['product_img']?>">
						<div class="product"><b><?php echo $row_arrival['product_title']?></b>
						<br><b>&#8369;<?php echo $row_arrival['retail_price']?></b>
						<br><b><?php echo $row_arrival['stock_no']." in stock."?></b>
						<br><a href="#Product1">View product details</a></div>
					</div>
				  </div>
				  <!-- Next and previous buttons -->
				  <a class="prev" onclick="plusRecentSlides(-1)">&#10094;</a>
				  <a class="next" onclick="plusRecentSlides(1)">&#10095;</a>
				  <?php } ?>
				</div>
				<a id="GetStarted"></a>
				<br><br>
				 <!-- Shop by Category -->
				<h3>Shop by Category</h3>
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
				</div>
				<br><br>
				<!-- Best Sellers Sl8des -->
				<h3>Best Sellers</h3>
				 <!-- Slideshow container -->
				<div class="slideshow-container">
				<!--Recent Product Slides-->
				  <div class="bestSlides fade">
					<!--With PHP code, replace code with a JavaScript while loop of one product-box-->
					<div class="product-box">
						<img src="images/placeholder4.jpg">
						<div class="product"><b>Halfmoon Betta</b>
						<br><b>&#8369; 200.00</b>
						<br><b>58 in stock</b>
						<br><a href="#Product4">View product details</a></div>
					</div>
				  </div>
				  <div class="bestSlides fade">
					<div class="product-box">
						<img src="images/placeholder5.png">
						<div class="product"><b>Blue Polar</b>
						<br><b>&#8369; 60.00</b>
						<br><b>73 in stock</b>
						<br><a href="#Product5">View product details</a></div>
					</div>
				  </div>
				  <div class="bestSlides fade">
					<div class="product-box">
						<img src="images/placeholder6.png">
						<div class="product"><b>Golden Danios</b>
						<br><b>&#8369; 50.00</b>
						<br><b>102 in stock</b>
						<br><a href="#Product6">View product details</a></div>
					</div>
				  </div>
				  <!-- Next and previous buttons -->
				  <a class="prev" onclick="plusBestSlides(-1)">&#10094;</a>
				  <a class="next" onclick="plusBestSlides(1)">&#10095;</a>
				</div>
				<br><br>
				<div class="banner"><h1><a href="ecom-sign-in.php">Sign in</a> for a better experience.</h1></div>
				<a id="location"></a>
				<br><br>
				<h3>Our Location</h3>
				<br>
				<div class="location">
					<iframe loading="lazy" allowfullscreen src=
					"https://www.google.com/maps/embed/v1/place?q=place_id:ChIJMcw9R0KvlzMRLD3eOow7N6M&key=AIzaSyC6DJeoVry_H7OukkOhh15QrLeuPWeUGRo">
					</iframe> 
					<br><p>396 Sto. Domingo St, San Jose del Monte City, Bulacan</p>
				</div>
				<a id="faq"></a>
				<br><br>
				<h1 class="faq" style="text-align:center;">FAQ (Frequently Asked Questions)</h1><br>
				<!--FAQ Accordion-->
				<button class="question"><b>What kinds of fish are available?</b></button>
				<div class="answer">
					<p>We have many varieties of fish in stock. If you want to find a specific one, you can search for it in the search bar.</p>
				</div>
				<button class="question"><b>How much is the minimum for wholesale?</b></button>
				<div class="answer">
					<p>You need to buy at minimum at least 2000 assorted fish for the purchase to be considered wholesale.</p>
				</div>
				<button class="question"><b>Where are you located?</b></button>
				<div class="answer">
					<p>Refer to the section above.</p>
				</div>
				<a id="contact"></a>
				<br><br>
				<div class="banner">
					<h3>CONTACT</h3>
					<br>+639050831218<br>
					<br><h3>NEED HELP?</h3>
					<br>Send your questions at our <a href=" https://www.facebook.com/bpfs2020/">Facebook page</a>.
				</div>
				<br><br>
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
		<script>
		//JavaScript for Recent Product Slides
			let recentSlideIndex = 1;
			showRecentSlides(recentSlideIndex);
			// Next/previous controls
			function plusRecentSlides(n) {
			  showRecentSlides(recentSlideIndex += n);
			}
			// Slide Control
			function currentSlide(n) {
			  showRecentSlides(recentSlideIndex = n);
			}
			function showRecentSlides(n) {
			  let i;
			  let slidesR = document.getElementsByClassName("recentSlides");
			  if (n > slidesR.length) {recentSlideIndex = 1}
			  if (n < 1) {recentSlideIndex = slidesR.length}
			  for (i = 0; i < slidesR.length; i++) {
				slidesR[i].style.display = "none";
			  }
			  slidesR[recentSlideIndex-1].style.display = "block";
			} 
		//JavaScript for Best Seller Slides	
			let bestSlideIndex = 1;
			showBestSlides(bestSlideIndex);
			// Next/previous controls
			function plusBestSlides(n) {
			  showBestSlides(bestSlideIndex += n);
			}
			// Slide Control
			function currentSlide(n) {
			  showBestSlides(bestSlideIndex = n);
			}
			function showBestSlides(n) {
			  let i;
			  let slidesB = document.getElementsByClassName("bestSlides");
			  if (n > slidesB.length) {bestSlideIndex = 1}
			  if (n < 1) {bestSlideIndex = slidesB.length}
			  for (i = 0; i < slidesB.length; i++) {
				slidesB[i].style.display = "none";
			  }
			  slidesB[bestSlideIndex-1].style.display = "block";
			}
		//JavaScript for FAQ Accordion
		var acc = document.getElementsByClassName("question");
		var i;
		for (i = 0; i < acc.length; i++) {
			  acc[i].addEventListener("click", function() {
					this.classList.toggle("active");
					var answer = this.nextElementSibling;
					if (answer.style.maxHeight) {
						answer.style.maxHeight = null;
					} else {
						answer.style.maxHeight = answer.scrollHeight + "px";
					}
			  });
		}
		</script>
</body>
</html> 