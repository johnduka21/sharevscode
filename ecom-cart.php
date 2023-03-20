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
	<title>Cart</title>
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

    /* Incr/Decr Quantity BACKEND */
    $get_ip = getIPAddress();
    $value = isset($_POST['item']) ? $_POST['item']:1; //to be displayed

    if(isset($_POST['item'])){
    $update_cart="UPDATE `cart_details` SET quantity = $value WHERE ip_address='$get_ip'";
    $result_quantity = mysqli_query($link, $update_cart);
    }  
?>

<body>
    <!-- Header -->
    <nav class="your-cart">
        <div class="cart-header">
        <a href="ecom-category.php"><i class="fa-solid fa-arrow-left alt back-arrow"></i></a>
        <h2 class="cart-h2">Your Cart</h2>
        </div>
    </nav>

    <!-- Cart -->
    <div class = "cart">
    <p class ="cart-title">All</p>

    <?php
        global $link;
        $get_ip = getIPAddress();
        /* Display Cart Items */
        $cart_query = "SELECT * FROM `cart_details` WHERE `ip_address`='$get_ip'";
        $result = mysqli_query($link, $cart_query); 
        $price_table = $row_price['selected_price'];
        $result_count = mysqli_num_rows($result);

        if($result_count>0){
        while($row=mysqli_fetch_array($result)){
            $product_id = $row['product_id'];
            $sub_total = 0;
            $select_products = "SELECT * FROM `products` WHERE `product_id` = $product_id";
            $result_products = mysqli_query($link, $select_products);
            while($row_product_price=mysqli_fetch_array($result_products)){
                $product_price = array($row_product_price['retail_price']);
                // $price_table = $row_product_price['selected_price'];
                $product_title = $row_product_price['product_title'];
                $product_img = $row_product_price['product_img'];
                $product_values = array_sum($product_price);
                $sub_total += $product_values;
                $total = $sub_total;
    ?>
        <!-- Content -->
        <div class='cart-content'>
            <div class='cart-box'>
                <div class='cart-checkbox'>
                    <input type='checkbox' class='checkbox'>
                </div>
                <div class='cart-image'>
                    <img src='./Category Images/<?php echo $product_img?>' alt='' class='cart-img'>
                </div>
                <div class='detail-box'>
                    <!-- Product Title -->
                    <div class='cart-product-title'><?php echo $product_title?></div>
                    <!-- Product Price -->
                    <div class='cart-price'>P<?php echo "$price_table.00" ?></div>
                    <div class="cart-quantity-container">
                        <!-- Incr/Decr Quantity FRONTEND -->
                        <form method='POST' action=''>
                            <input type='hidden' value='<?php $product_id?>'>
                            <input type='text' min='1' name='item' value='<?php echo $value?>' class='cart-quantity'>
                        </form>
                    </div>
                </div>
                <!-- Remove from cart -->
                <div class='cart-remove-btn'>
                    <?php echo"<a href='ecom-cart-delete.php?prod_id=$product_id'><i class='fa fa-trash-alt cart-remove'></i></a>"?>
                </div>
            </div>
        </div>
            <?php
                }
                }
            /*Total Container */
             echo"   
            <div class='total'>
                <div class= 'total-text'>
                    <div class='subtotal-title'>Subtotal: P$sub_total.00</div>
                    <div class='total-title'>Total: P$total</div>
                </div>
                <!-- Checkout Button -->
                <div class='btn'>
                    <button type='button' class='btn-checkout'>Checkout</button>
                </div>
            </div>";
            } else {
                /*EMPTY Total Container */
                echo"
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
            ?>
        
    </div>
</body>
</html> 