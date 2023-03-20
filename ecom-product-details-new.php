<?php
include 'ecom-header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
    <title>Betta Fish</title>
    <link rel="stylesheet" href="css/product-page.css">
</head>
<body>
    
    <section class="product">
        <div class="row">
            <?php
            if (isset($_GET['prod_id'])){
                $product_id = mysqli_real_escape_string($link, $_GET['prod_id']);
                $select_products = "SELECT * FROM products WHERE product_id = '$product_id'";

                $result_product = mysqli_query($link, $select_products);
                $row_data = mysqli_fetch_assoc($result_product);
                
                $product_id = $row_data['product_id'];
                $product_title = $row_data['product_title'];
                $retail_price = $row_data['retail_price'];
                $wholesale_price = $row_data['wholesale_price'];
                $product_desc = $row_data['product_desc'];
                $product_img = $row_data['product_img'];
                $stock_no = $row_data['stock_no'];
            }
            
            ?>
            <div class="product-image">
                <?php
                echo"
                <img class ='product-img' name='product_img' src='Product Images/$product_img' alt= '$product_title'>"
                ?>
            </div>

            <div class="product-details">
                <?php
                echo"<h2 name='product_title' style='margin-top: 0.5rem;'>$product_title</h2>";
                ?>
                <h2><span style="float: left; font-weight: bold; font-style: Sans-serif;">₱</span><div id = 'result' style="font-weight: bold;"></div></h2>
                <?php
                echo"<form method='POST'>
                <input type='hidden' name='prod_id' value='$product_id'>
                <input type='hidden' name='prod_title' value='$product_title'>
                <input type='hidden' name='product_img' value='$product_img'>
                <div class='price'>
                    <select id='update_price' required name ='selectedprice'>
                        <option value=''>Select Price</option>
                        <option value='$retail_price' data-value='retail'>Retail</option>
                        <option value='$wholesale_price' data-value='wholesale'>Wholesale</option>
                    </select>
                </div>
                <p style='margin-top: 0.5rem;'>Wholesale: Min. Order of ₱2,000. Pwedeng iba-ibang isda basta po worth P2,000 lahat.</p>"
                ?>
                <div class='quantity-container'>
                    <h4 class='quantity'>Quantity</h4>
                    <input width='20px' class='quantity-select' type='number' name='update-quantity' value='1' min='1' oninput="validity.valid||(value=value.replace(/\D+/g, ''))">
                    <?php if($stock_no <= 0){ ?>
                    <h4 class='stock'>Stock Available:<p style='display: inline; color: red; font-weight: bold;'>&nbsp<?php echo "Out of stock."?>&nbsp</p></h4>
                    <?php } else {?>
                        <h4>Stock Available:<p style='display: inline;'>&nbsp<?php echo $stock_no?>&nbsp</p></h4>
                    <?php } ?>
                </div>
                <div class='product-btns'>
                    <?php if($stock_no <= 0){ ?>
                        <!-- No add to cart button -->
                    <?php } else {?>
                    <button type='submit' name='submit' class='add-to-cart'><span><i class='fa-solid fa-cart-plus'></i></span>Add to Cart</button>
                    <?php } ?>
                </div>
                </form>   
            </div>
        </div>

        <div class='section-break'></div>

        <div class='row' style="margin-top: 0px;">
            <div class='product-description'>
                <h3>Product Description</h3>
                <p><?php echo $product_desc?></p>
            </div>
        </div>
    </section>

</body>

<script>
    update_price.onchange = function(){
        result.innerText = this.value;
    }
</script>

<?php
//Add To Cart from Product Detail 
if(isset($_POST['submit'])){ //GUEST ADD TO CART 
        // if(isset($_SESSION['guest'])){
        //     $get_ip = getIPAddress();

        //     $select_products = "SELECT * FROM products WHERE product_id = '$product_id'";
        //     $result_product = mysqli_query($link, $select_products);
        //     $row_data = mysqli_fetch_assoc($result_product);
            
        //     $product_id = $row_data['product_id'];
        //     $product_title = $row_data['product_title'];
        //     $retail_price = $row_data['retail_price'];
        //     $wholesale_price = $row_data['wholesale_price'];
        //     $product_desc = $row_data['product_desc'];
        //     $product_img = $row_data['product_img'];
        //     $stock_no = $row_data['stock_no'];
        //     $updatequantity = $_POST['update-quantity'];
        //     $selectedprice = $_POST['selectedprice'];
            
        //     if($_POST['selectedprice'] === $retail_price){
        //         $retailCartItems = array($product_id=> array('product_id' => $product_id,'product_title' => $product_title, 'quantity' => $updatequantity, 'selected_price' => $selectedprice, 'image' => $product_img, 'ip_address' => $get_ip));
        //         if(empty($_SESSION["retail-cart"])){
        //         $_SESSION["retail-cart"] = $retailCartItems;
        //         echo '<script>alert("Retail product is added to cart.")</script>';
        //         }else {
        //         $retail_array_keys = array_keys($_SESSION["retail-cart"]);
        //             if(in_array($product_id, $retail_array_keys)){
        //             echo '<script>alert("Retail product is already in your cart.")</script>';
        //             } else{
        //                 $_SESSION["retail-cart"] = array_merge($_SESSION["retail-cart"], $retailCartItems);
        //                 echo '<script>alert("Retail product is added to cart.")</script>';
        //             }
        //         }
        //     } else if ($_POST['selectedprice'] === $wholesale_price){
        //         $wholesaleCartItems = array('product_id' => $product_id,'product_title' => $product_title, 'update_quantity' => $_POST['update-quantity'], 'selected_price' => $_POST['selectedprice'], 'image' => $product_img, 'ip_address' => $get_ip);
        //         $_SESSION['wholesale-cart'][] = $wholesaleCartItems;
        //         print_r($_SESSION['wholesale-cart']);
        //         echo '<script>alert("Wholesale.")</script>';

        //     } else {
        //         echo '<script>alert("Sorry but something went wrong.")</script>';
        //     }
        // }

        if(isset($_SESSION['usersuid'])){
        if ($_POST['selectedprice'] === $retail_price){ //Retail
            $usersid = mysqli_escape_string($link,$_SESSION["usersid"]);
            
            $select_user = "SELECT * FROM `users` WHERE usersId = '$usersid'";
            $result_user = mysqli_query($link, $select_user);
            $row_user = mysqli_fetch_assoc($result_user);
            $user_id = $row_user['usersId'];
            $get_ip = getIPAddress();
            
            $prod_id = $_POST['prod_id'];
            $prod_title = $_POST['prod_title'];
            $quantity = $_POST['update-quantity'];
            $selected_price = $_POST['selectedprice'];
            $image = $_POST['product_img'];
            $select = "SELECT * FROM `cart_details` WHERE userId = '$user_id' AND product_id = $prod_id";
            echo $select;
            $result = mysqli_query($link, $select);
            $num_of_rows = mysqli_num_rows($result);
            if(!mysqli_num_rows($result)>0){
                $insert = "INSERT into `cart_details` (product_id, ip_address, product_title, product_img, quantity, selected_price, userId) VALUES ($prod_id, '$get_ip', '$prod_title', '$image', '$quantity', $selected_price, $user_id)";
                $result_insert = mysqli_query($link, $insert);
                echo"<script>alert('Item added to cart!')</script>";
                echo"<script>location.href = 'ecom-product-details.php?prod_id=$prod_id';</script>";
                
            } else if (mysqli_num_rows($result)>0) {
                echo"<script>alert('Item already in cart.')</script>";
                echo"<script>location.href = 'ecom-product-details.php?prod_id=$prod_id';</script>";
            }
        } else if ($_POST['selectedprice'] === $wholesale_price){ //Wholesale
            $usersid = mysqli_escape_string($link,$_SESSION["usersid"]);
            
            $select_user = "SELECT * FROM `users` WHERE usersId = '$usersid'";
            $result_user = mysqli_query($link, $select_user);
            $row_user = mysqli_fetch_assoc($result_user);
            $user_id = $row_user['usersId'];
            $get_ip = getIPAddress();
            
            $prod_id = $_POST['prod_id'];
            $prod_title = $_POST['prod_title'];
            $quantity = $_POST['update-quantity'];
            $selected_price = $_POST['selectedprice'];
            $image = $_POST['product_img'];
            $select = "SELECT * FROM `wholesale_cart` WHERE userId = '$user_id' AND product_id = $prod_id";
            echo $select;
            $result = mysqli_query($link, $select);
            $num_of_rows = mysqli_num_rows($result);
            if(!mysqli_num_rows($result)>0){
                $insert = "INSERT into `wholesale_cart` (product_id, ip_address, product_title, product_img, quantity, selected_price, userId) VALUES ($prod_id, '$get_ip', '$prod_title', '$image', '$quantity', $selected_price, $user_id)";
                $result_insert = mysqli_query($link, $insert);
                echo"<script>alert('Item added to cart!')</script>";
                echo"<script>location.href = 'ecom-product-details.php?prod_id=$prod_id';</script>";
                
            } else if (mysqli_num_rows($result)>0) {
                echo"<script>alert('Item already in cart.')</script>";
                echo"<script>location.href = 'ecom-product-details.php?prod_id=$prod_id';</script>";
            }
        }
        } else {
            echo"<script>alert('Please sign in.')</script>";
            echo"<script>location.href = 'ecom-sign-in.php';</script>";
        }
    }
?>
