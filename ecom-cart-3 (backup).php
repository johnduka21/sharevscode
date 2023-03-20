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

<?php
if (isset($_SESSION['guest'])):
if(empty($_SESSION['retail-cart'])){//IF GUEST CART IS EMPTY
$sub_total = 0;
$total = 0;
echo"
<div id='empty' style='display: flex; flex-direction: column; align-items: center; padding: 1rem;'>
	<i style='text-align: center; font-size: 200px; color: #e4e4e4; padding: 50px;' class='fa-sharp fa-solid fa-cart-plus'></i>
	<h2 style='text-align: center;'>Your Cart is Empty</h2>
	<button style='background-color: #EEAC48; padding: .5rem 1rem; margin: 1rem 0rem;'><a href='ecom-category.php' style='text-decoration: none; color: #000C1D; font-weight: bold;'>Continue Shopping</a></button>
</div>
<div class='total'>
<div class= 'total-text'>
<div class='subtotal-title'>Subtotal: 0.00</div>
<div class='total-title'>Total: 0.00</div>
</div>
<div class='btn'>
<button type='button' class='btn-checkout'>Checkout</button>"
;

}
if(isset($_SESSION["retail-cart"])):
	/* Updating Quantity BACKEND */
	if (isset($_POST['new-quantity']) && $_POST['new-quantity'] == "change") {
		$postId = cleanInput($_POST["product-id"]);
		$postQuantity = cleanInput($_POST["enter-quantity"]);
	foreach ($_SESSION["retail-cart"] as &$retailCart) {
	if ($retailCart['product_id'] === $postId) {
	$retailCart['quantity'] = $postQuantity;
	print_r($_SESSION['retail-cart']);
	break;
	} else {
		echo "Error.";
	}
	}
	}

	/* Remove Items from Cart */
	if (isset($_POST['delete-item']) && $_POST['delete-item']=="remove"){
	if(!empty($_SESSION["retail-cart"])) {
	foreach($_SESSION["retail-cart"] as $key => $value) {
	if($_POST["product-id"] == $key){
	unset($_SESSION["retail-cart"][$key]);
	$status = "<div class='box' style='color:red;'>
	Product is removed from your cart!</div>";
	}
	if(empty($_SESSION["retail-cart"])){
	unset($_SESSION["retail-cart"]);
	}
	}		
	}
	}

$total_price = 0;
foreach ($_SESSION["retail-cart"] as $retailCart):
?>

<div class='cart-content'>
<div class='cart-box'>

<div class='cart-checkbox'><!-- <input type='checkbox' class='checkbox'> --></div>
<div class='cart-image'>
<img src='./Category Images/<?php echo $retailCart["image"]?>' alt='' class='cart-img'>
</div>
<div class='detail-box'>
<!-- Product Title -->
<div class='cart-product-title'><?php echo $retailCart["product_title"]?></div>
<!-- Product Price -->
<div class='cart-price'>P<?php echo $retailCart["selected_price"]?></div>
<div class="cart-quantity-container">
<!-- Incr/Decr Quantity FRONTEND -->
    <form method='POST' action=''>
    <input type='hidden' name='product-id' value='<?php echo $retailCart["product_id"];?>'>
    <input type='hidden' name='new-quantity' value = "change">
    <p>Qty: </p>
    <input type='text' min='1' name='enter-quantity' value='<?php echo $retailCart["quantity"];?>' class='cart-quantity' onChange="this.form.submit()" oninput="validity.valid||(value=value.replace(/\D+/g, ''))">
    <!-- <button name='new-quantity' class='cart-quantity-btn' value = "change">Click to Update</button> -->
    </form>
</div>
</div>
<!-- Remove from cart -->
<div class='cart-remove-btn'>
<form method='post' action=''>
<input type='hidden' name='product-id' value="<?php echo $retailCart["product_id"]; ?>" />
<input type='hidden' name='delete-item' value="remove" />
<button type='submit'><i class='fa fa-trash-alt cart-remove'></i></button>
</form>
</form>
</div>
</div>
</div>
<?php
$total_price += ($retailCart["selected_price"]*$retailCart["quantity"]); 
endforeach;
?>

<div class='total'>
<div class= 'total-text'>
<div class='subtotal-title'>Subtotal: P<?php echo $total_price?>.00</div>
<div class='total-title'>Total: <?php echo $total_price?>.00</div>
</div>
<!-- Checkout Button -->
<div class='btn'>
<button type='button' class='btn-checkout'>Checkout</button>
<?php 
endif;// guest
endif;// retail cart ?>
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

	$cart_query = "SELECT * FROM `cart_details` WHERE `ip_address`='$get_ip' AND userId = '$usersid'";
	$result = mysqli_query($link, $cart_query);
	$result_count = mysqli_num_rows($result);
	$total = 0;

	if ($result_count > 0) {
		while ($row = mysqli_fetch_array($result)):
			$select_products = "SELECT p.product_id, p.product_title, p.product_img, c.product_id, c.selected_price, c.quantity FROM `products` p INNER JOIN `cart_details` c ON p.product_id = c.product_id";
			$result_products = mysqli_query($link, $select_products);
			echo mysqli_error($link);
			foreach ($result_products as $row_product_price):
				$quantity = $row_product_price['quantity'];
				$selected_price = $row_product_price['selected_price'];
				$final_price = array($row_product_price['selected_price']);
				$product_title = $row_product_price['product_title'];
				$product_img = $row_product_price['product_img'];
				$product_values = array_sum($final_price);
				$total += $product_values;
				?>
<!-- Content -->
<div class='cart-content'>
<div class='cart-box'>
	<div class='cart-checkbox'>
	<!-- <input type='checkbox' class='checkbox'> -->
	</div>
	<div class='cart-image'>
	<img src='./Category Images/<?php echo $product_img ?>' alt='' class='cart-img'>
	</div>
<div class='detail-box'>
<!-- Product Title -->
<div class='cart-product-title'><?php echo $product_title ?></div>
<!-- Product Price -->
<div class='cart-price'>P<?php echo "$selected_price.00" ?></div>
<?php 
if (isset($_POST['new-quantity']) && $_POST['new-quantity'] == "change" ){
$newqty = $_POST["enter-quantity"];
$product_id2 = $_POST["product-id"];
echo $newqty;
echo $product_id2;
if ($product_id2 == $product_id){
$update_cart = "UPDATE `cart_details` SET quantity={$newqty} WHERE product_id={$product_id2} and user_id={$usersid}";
echo $update_cart;
$result_quantity = mysqli_query($link, $update_cart);
$total = $total*$newqty;
}
}
?>
<div class="cart-quantity-container">
	<!-- Incr/Decr Quantity FRONTEND -->
		<input type='hidden' name='product-id' value='<?php echo $product_id?>'>
		<input type='hidden' name='new-quantity' value = "change">
		<p>Qty: </p>
		<input type='text' min='1' name='enter-quantity' value='<?php echo $quantity?>' class='cart-quantity' onChange="this.form.submit()" oninput="validity.valid||(value=value.replace(/\D+/g, ''))">
</div> 
</div>
<!-- Remove from cart -->
<div class='cart-remove-btn'>
<?php echo "<a href='ecom-cart-delete.php?prod_id=$product_id'><i class='fa fa-trash-alt cart-remove'></i></a>"; ?>
</div>
</div>
</div>
<?php 
	endforeach;
	break;
endwhile;
 ?>

	<?php 
	/*Total Container */
	echo "   
	<div class='total'>
		<div class= 'total-text'>
			<div class='subtotal-title'>Subtotal: P$total.00</div>
			<div class='total-title'>Total: P$total.00</div>
		</div>
		<!-- Checkout Button -->
		<div class='btn'>
			<button type='button' class='btn-checkout'><a href='ecom-retail-checkout.php'>Checkout</a></button>
		</div>
	</div></div>"; ?>
	</form>
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

</body>