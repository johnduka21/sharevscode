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

    /* Updating Quantity BACKEND */
    if(isset($_POST['new-quantity']) && $_POST['new-quantity'] == "change"){
        foreach ($_SESSION['retail-cart'] as &$retailCart):
        echo $_POST['enter-quantity'];
        if($retailCart['product_id'] === $_POST['product-id']){
            $retailCart['update_quantity'] = $_POST['enter-quantity'];
            break;
        } else{
            echo "Something Went Wrong. ";
        }
        endforeach;
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
    
    <!-- CART -->
    <?php
        global $link;
        $get_ip = getIPAddress();
/////////////////////////////////////////////////
print_r($_SESSION['retail-cart']);
        /* GUEST CART */
        if(isset($_SESSION['guest'])){
            if(empty($_SESSION['retail-cart'])){//IF GUEST CART IS EMPTY
                $sub_total = 0;
                $total = 0;
                echo"
                <div class = 'cart'>
                <p class ='cart-title'>Your Cart</p>
                <div id='empty' style='display: flex; flex-direction: column; align-items: center; padding: 1rem;'>
                    <i style='text-align: center; font-size: 200px; color: #e4e4e4; padding: 50px;' class='fa-sharp fa-solid fa-cart-plus'></i>
                    <h2 style='text-align: center;'>Your Cart is Empty</h2>
                    <button style='background-color: #EEAC48; padding: .5rem 1rem; margin: 1rem 0rem;'><a href='ecom-category.php' style='text-decoration: none; color: #000C1D; font-weight: bold;'>Continue Shopping</a></button>
                </div>";

            } 
            if(isset($_SESSION['retail-cart']))://IF GUEST CART HAS ITEMS
                echo"<div class = 'cart'>
                <p class ='cart-title'>Your Cart</p>";
                $sub_total = 0;

                // RETAIL 
                foreach ($_SESSION['retail-cart'] as $retailCart):
            ?>

        <!-- SHOW FOREACH CART ITEMS -->
        <div class='cart-content'>
            <div class='cart-box'>
                <div class='cart-checkbox'>
                    <!-- <input type='checkbox' class='checkbox'> -->
                </div>
                <div class='cart-image'>
                    <img src='./Category Images/<?php echo $retailCart['image']?>' alt='' class='cart-img'>
                </div>
                <div class='detail-box'>
                    <!-- Product Title -->
                    <div class='cart-product-title'><?php echo $retailCart['product_title']?></div>
                    <!-- Product Price -->
                    <div class='cart-price'>P<?php echo $retailCart['selected_price']?></div>
                    <div class="cart-quantity-container">
                        <!-- Incr/Decr Quantity FRONTEND -->
                        <form method='POST' action=''>
                            <input type='hidden' name='product-id' value='<?php echo $retailCart['product_id'];?>'>
                            <input type='hidden' name='new-quantity' value = "change">
                            <p>Qty: </p>
                            <input type='number' min='1' name='enter-quantity' value='<?php echo $retailCart['update_quantity'];?>' class='cart-quantity' onChange="this.form.submit()">
                            <!-- <button name='new-quantity' class='cart-quantity-btn' value = "change">Click to Update</button> -->
                        </form>
                    </div>
                </div>
                <!-- Remove from cart -->
                <div class='cart-remove-btn'>
                    <form method="POST" action=''>
                    <input type='hidden' name='product-id' value='<?php echo $retailCart['product_id'];?>'>
                    <input type='hidden' name = 'delete-item' value="remove"/>
                    <button type='submit'><i class='fa fa-trash-alt cart-remove'></i></button>
                    </form>
                </div>
                <?php //Remove from cart PHP
                    if (isset($_POST['delete-item']) && $_POST['delete-item'] == "remove") {
                        if (!empty($_SESSION["retail-cart"])) {
                            foreach ($_SESSION["retail-cart"] as $key => $value) {
                                if ($_POST["product-id"] == $key) {
                                    unset($_SESSION["retail-cart"][$key]);
                                    $status = "<div class='box' style='color:red;'>
                        Product is removed from your cart!</div>";
                                    echo $status;
                                }
                                if (empty($_SESSION["retail-cart"]))
                                    unset($_SESSION["retail-cart"]);
                            }
                        }
                    }
                ?>
            </div>
        </div>
            <?php                    
            $retailprice = $retailCart['selected_price']*$retailCart['update_quantity'];
            $total_retail_price = array($retailprice);
            $retail_total_sum = array_sum($total_retail_price);
            $updated_quantity = $retailCart['update_quantity'];
            $total_sum = $retail_total_sum;
            $sub_total += $total_sum;
            $total = $sub_total; 
            endforeach;
        //Subtotal Section
        echo"   
            <div class='total'>
                <div class= 'total-text'>
                    <div class='subtotal-title'>Subtotal: P$sub_total.00</div>
                    <div class='total-title'>Total: P$total.00</div>
                </div>
                <!-- Checkout Button -->
                <div class='btn'>
                    <button type='button' class='btn-checkout'>Checkout</button>
                </div>
            </div>";    
        endif;//ISSET retail and wholesale
    }
    
        

/////////////////////////////////////////////////////////

        // USER CART
        if (isset($_SESSION['usersuid'])){
        $cart_query = "SELECT * FROM `cart_details` WHERE `ip_address`='$get_ip'";
        $result = mysqli_query($link, $cart_query);
        $result_count = mysqli_num_rows($result);

        if($result_count>0){
        while($row=mysqli_fetch_array($result)){
            $product_id = $row['product_id'];
            $sub_total = 0;
            $select_products = "SELECT p.product_id, p.product_title, p.product_img, c.product_id, c.selected_price FROM `products` p INNER JOIN `cart_details` c ON p.product_id = c.product_id";
            $result_products = mysqli_query($link, $select_products);
            echo mysqli_error($link);
            while($row_product_price=mysqli_fetch_array($result_products)){
                $selected_price = $row_product_price['selected_price'];
                $product_title = $row_product_price['product_title'];
                $product_img = $row_product_price['product_img'];
                $all_price = array($selected_price);
                $product_values = array_sum($all_price);
                $sub_total += $product_values;
                $total = $sub_total;
    ?>
        <!-- Content -->
        <div class='cart-content'>
            <div class='cart-box'>
                <div class='cart-checkbox'>
                    <!-- <input type='checkbox' class='checkbox'> -->
                </div>
                <div class='cart-image'>
                    <img src='./Category Images/<?php echo $product_img?>' alt='' class='cart-img'>
                </div>
                <div class='detail-box'>
                    <!-- Product Title -->
                    <div class='cart-product-title'><?php echo $product_title?></div>
                    <!-- Product Price -->
                    <div class='cart-price'>P<?php echo "$selected_price.00" ?></div>
                    <div class="cart-quantity-container">
                        <!-- Incr/Decr Quantity FRONTEND -->
                        <form method='POST' action=''>
                            <input type='hidden' value='<?php $product_id?>'>
                            <!-- <button name='decqty' class='cart-quantity-btn'>-</button> -->
                            <input type='text' min='1' name='item' value='<?php echo $value?>' class='cart-quantity'>
                            <button name='new-quantity' class='cart-quantity-btn'>Click to Update</button>
                            <!-- <button name='incqty' class='cart-quantity-btn'>+</button> -->
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
                    <div class='total-title'>Total: P$total.00</div>
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
        } 
            ?>
        
    </div>
</body>
</html> 