<!DOCTYPE html>
<html lang="en-PH">
<head>
<!--METADATA: GOOGLE SEO STUFF AND MAKING THIS GOOD FOR MOBILE-->
<meta charset= "UTF-8">
<meta name = "description" content = "Bulacan Pet Fish Supply E-Commerce">
<meta name = "keywords" content = "Bulacan, fish, pet fish, fish supply, fish supplies, fish accessory, fish accessories, fish store, 
aquarium, aquarium tank">
<meta name = "author" content = "John Duka">
<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
<!--Title, Favicons, Font, Icons in Font, and CSS Stylesheet-->
<title>Checkout</title>
<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/guest-checkout.scss">
<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
</head>

<?php
include 'php/functions.php';
include 'php/dbh.php';
session_start();

if (isset($_SESSION['usersuid'])) {
	$usersid = mysqli_escape_string($link,$_SESSION["usersid"]);
?>

<body>
<nav class="your-cart">
<div class="cart-header">
<a href="ecom-cart-wholesale.php"><i class="fa-solid fa-arrow-left alt back-arrow"></i></a>
<h2 class="cart-h2">Checkout</h2>
</div>
</nav>

<div class="order-container-2">
	<h2>Checkout</h2>
	<form action="#">
		<div class="row-gap">
			<!-- Start of Form -->
			<h3>1. Address</h3>
			<div class="card">
				John Duka<br />
				396 Sto. Domingo Street, Brgy. Fatima I,<br />
				San Jose Del Monte, Bulacan
			</div>

			<!-- Payment Method -->
			<div class="payment-method">
				<h3>2. Choose Payment Method</h3>
				<div class="form__radios">
                <div class="card" style="background: gray; font-weight: bold">
                    <p>Bank, GCash, or cash-on-delivery are accepted. Payment transaction will be done at delivery. </p>
                </div>
				</div>
			</div>
			<div class="total-price">
				<h3>3. Order Details</h3>
				<div class="card">
				<?php
				$get_ip = getIPAddress();
				$cart_query = "SELECT * FROM `wholesale_cart` WHERE `ip_address`='$get_ip'";
				$result = mysqli_query($link, $cart_query);
				$result_count = mysqli_num_rows($result);

				if ($result_count > 0) {
					while ($row = mysqli_fetch_array($result)):
						$product_id = $row['product_id'];
						$total = 0;
						$select_products = "SELECT p.product_id, p.product_title, p.product_img, c.product_id, c.selected_price, c.quantity FROM `products` p INNER JOIN `wholesale_cart` c ON p.product_id = c.product_id";
						$result_products = mysqli_query($link, $select_products);
						echo mysqli_error($link);
						while ($row_product_price = mysqli_fetch_array($result_products)):
							$selected_price = $row_product_price['selected_price'];
							$quantity = $row_product_price['quantity'];
							$product_title = $row_product_price['product_title'];
							$final_price = $quantity * $selected_price;
							$all_price = array($final_price);
							$product_values = array_sum($all_price);
							$total += $product_values;
							?>

				<p><?php echo $product_title, " - P", $selected_price, ".00 x ", $quantity ?></p>
				<?php
						endwhile;
						break;
					endwhile;
				}
				?>	
				</div>
			</div>
			<div class="total-price">
				<h3>4. Total Bill</h3>
				<span style = "font-weight: bold">Subtotal:</span> <span>P<?php echo $total ?>.00</span><br>
                <span style = "font-weight: bold">Shipping:</span> <span>In process</span><br>
				<span style="font-style: italic; font-weight: bold;">Note:</span> <span> Shipping fee varies between P50 - P3,000 depending on your delivery address and shipping setting.</span><br>
                <p class="border-bottom"></p>
				<h4>Total: P<?php echo $total ?>.00</h4>
			</div>
			<a href="http://m.me/Princessshaynesantos">Message Us Here</a>
			<!-- Checkout Button -->
			<div class="row-gap-button">
				<a onClick="javascript: return confirm('Are You Sure You Want to Confirm Your Order?');" href="php/wholesale-order.php?user-wholesale=<?php echo $usersid ?>">Checkout</a>
				<!-- <button id="checkout"></button> -->
			</div>
			<!-- End of Form -->
		</div>
	</form>
</div>
</body>

<?php
} else {
	echo "Something went wrong. Please log in to continue.";
}
?>