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
	<title>Your Cart</title>
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/cart-2.scss">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
</head>
<?php
include 'php/functions.php';
include 'php/dbh.php';
session_start();
global $link;
$get_ip = getIPAddress();
?>

<body>
<nav class="your-cart"> <!-- Header -->
<div class="cart-header">
<a href="ecom-category.php"><i class="fa-solid fa-arrow-left alt back-arrow"></i></a>
<h2 class="cart-h2">Cart</h2>
</div>
</nav>

<div class="btn-container">
	<button class="btn-blue"><a href="ecom-cart-3.php">Retail Cart</a></button>
	<button class="btn-gray"><a href="ecom-cart-wholesale.php">Wholesale Cart</a></button>
</div>

<div class = 'cart'><p class ='cart-title'>Cart Items</p>
</div>
</div>

<!------------  USER CART ------------>
<div class = "cart">
<form method='POST' action=''>
<?php
if(!isset($_SESSION['usersuid'])){
    header("location: ecom-sign-in.php?page=login");
}
if (isset($_SESSION['usersuid'])){
	$get_ip = getIPAddress();
	$usersid = mysqli_escape_string($link,$_SESSION["usersid"]);

	// $select_products = "SELECT p.product_id, p.product_title, p.product_img, c.product_id, c.selected_price, c.quantity FROM `products` p INNER JOIN `cart_details` c ON p.product_id = c.product_id";
	$select_products = $cart_query = "SELECT * FROM `cart_details` WHERE userId = '$usersid' ORDER BY selected_price DESC";
	$result_products = mysqli_query($link, $select_products);
	$result_count = mysqli_num_rows($result_products);
	$total = 0;
	echo mysqli_error($link);
	if ($result_count > 0) {
		while ($row_product_price = mysqli_fetch_array($result_products)):
			$product_id = $row_product_price['product_id'];
			$quantity = $row_product_price['quantity'];
			$image = $row_product_price['product_img'];
			$selected_price = $row_product_price['selected_price'];
			$product_title = $row_product_price['product_title'];
			$product_img = $row_product_price['product_img'];
			$total += ($row_product_price['selected_price']*$row_product_price['quantity']);
	?>
<!-- Content -->
<div class='cart-content'>
<div class='cart-box'>
	<div class='cart-checkbox'>
	<!-- <input type='checkbox' class='checkbox'> -->
	</div>
	<div class='cart-image'>
	<img src='./Product Images/<?php echo $image ?>' alt='' class='cart-img'>
	</div>
<div class='detail-box'>
<!-- Product Title -->
<div class='cart-product-title'><?php echo $product_title ?></div>
<!-- Product Price -->
<div class='cart-price'>P<?php echo "$selected_price.00" ?></div>
<div class="cart-quantity-container">
	<!-- Incr/Decr Quantity FRONTEND -->
	<input type='hidden' name='new-quantity' value = "change">
	<p>Qty: </p>
	<input type='text' name='enter-quantity[]' value='<?php echo $row_product_price['quantity'];?>' class='cart-quantity' onChange="this.form.submit()" oninput="validity.valid||(value=value.replace(/\D+/g, '')) min='1'">
	<input type='hidden' name='product-ids[]' value='<?php echo $product_id;?>'>
</div> 
</div>
<!-- Remove from cart -->
<div class='cart-remove-btn'>
<?php echo "<a href='ecom-cart-delete.php?prod_id=$product_id'><i class='fa fa-trash-alt cart-remove'></i></a>"; ?>
</div>
</div>
</div>
<?php 

//Update Quantity
if (isset($_POST['new-quantity']) && $_POST['new-quantity'] == "change"){
	$enterqty = $_POST["enter-quantity"];
	$productid = $_POST["product-ids"];
	$newqty = implode(',', $enterqty);
	$product_id2 = implode(',', $productid);

	echo "<h3>QTY: $newqty</h3>";
	echo  "<h2>ID: $product_id</h2>"; // product id test
	$update_cart = "UPDATE `cart_details` SET quantity='{$newqty}' WHERE product_id='{$product_id2}' AND userId='{$usersid}'";
	$result_quantity = mysqli_query($link, $update_cart);
	echo $update_cart;
	echo mysqli_error($link);
	// header("location: ecom-cart-3.php?updated-quantity");
    // exit();
}

endwhile;
?>
	<!-- Total Container -->
	<div class='total'>
		<div class= 'total-text'>
			<div class='subtotal-title'>Subtotal: P<?php echo $total?>.00</div>
			<div class='total-title'>Total: P<?php echo $total?>.00</div>
		</div>
		<!-- Checkout Button -->
		<div class='btn'>
			<button type='button' class='btn-checkout'><a href='ecom-retail-checkout.php'>Checkout</a></button>
		</div>
	</div></div>"; 
	<?php
		} else {
			/*EMPTY Total Container */
			echo "
		<div id='empty' style='display: flex; flex-direction: column; align-items: center; padding: 1rem;'>
			<i style='text-align: center; font-size: 200px; color: #e4e4e4; padding: 50px;' class='fa-sharp fa-solid fa-cart-plus'></i>
			<h2 style='text-align: center;'>Your Cart is Empty</h2>
			<button style='background-color: #EEAC48; padding: .5rem 1rem; margin: 1rem 0rem;'><a href='ecom-category.php' style='text-decoration: none; color: #000C1D; font-weight: bold;'>Continue Shopping</a></button>
		</div>";

		echo "<!-- Total -->
		<div class='total'>
			<div class= 'total-text'>
				<div class='subtotal-title'>Subtotal: P0.00</div>
				<div class='total-title'>Total: P0.00</div>
			</div>
			<!-- Checkout Button -->
			<div class='btn'>
				<button type='button' class='btn-checkout'>Checkout</button>
			</div>
		</div>";
		}

}
?>
</form>
</body>