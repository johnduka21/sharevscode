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
                echo"<h3 name='product_title'>$product_title</h3>";
                ?>
                <span>₱</span><div id = 'result'></div> <!-- SELECTED PRICE Add a css inline para pantay peso sign -->
                <?php
                echo"<form method='POST'>
                <input type='hidden' name='prod_id' value='$product_id'>
                <div>
                    <select id='update_price' required name ='selectedprice'>
                        <option value=''>Select Price</option>
                        <option value='$retail_price' data-value='retail'>Retail</option>
                        <option value='$wholesale_price' data-value='wholesale'>Wholesale</option>
                    </select>
                </div>
                <p>Wholesale: Min. Order of ₱2,000. Pwedeng iba-ibang isda basta po worth P2,000 lahat.</p>
                <div class='quantity-container'>
                    <h4 class='quantity'>Quantity</h4>
                    <input class='quantity-select' type='number' name='update-quantity' value='1' min='1'>
                    <h4>Stock Available:<p style='display: inline;'>&nbsp&nbsp$stock_no</p></h4>
                </div>
                <div class='product-btns'>
                    <button type='submit' name='submit' class='add-to-cart'><span><i class='fa-solid fa-cart-plus'></i></span>Add to Cart</button>
                    <button class='checkout'>Checkout</button> 
                </div>
                </form>   
            </div>
        </div>

        <div class='section-break'></div>

        <div class='row-2'>
            <div class='product-description'>
                <h3>Product Description</h3>
                <p>$product_desc</p>
            </div>
        </div>
        "?>
    </section>

</body>

<script>
    update_price.onchange = function(){
        result.innerText = this.value;
    }
</script>

<?php
//Add To Cart from Product Detail 
print_r($_SESSION['retail-cart']);
if(isset($_POST['submit'])){ //GUEST ADD TO CART 
        if(isset($_SESSION['guest'])){
            $get_ip = getIPAddress();
            //If selected option price data-value = 'retail', then add to retail cart. Then combine two arrays to one array 
            // $_SESSION['retail-cart'] = array();
            // $_SESSION['wholesale-cart'] = array();
            
            if($_POST['selectedprice'] === $retail_price){
                $retailCartItems = array('product_id' => $product_id,'product_title' => $product_title, 'update_quantity' => $_POST['update-quantity'], 'selected_price' => $_POST['selectedprice'], 'image' => $product_img, 'ip_address' => $get_ip);
                $_SESSION['retail-cart'][] = $retailCartItems;
                print_r($_SESSION['retail-cart']);
                echo '<script>alert("Retail.")</script>';

            } else if ($_POST['selectedprice'] === $wholesale_price){
                $wholesaleCartItems = array('product_id' => $product_id,'product_title' => $product_title, 'update_quantity' => $_POST['update-quantity'], 'selected_price' => $_POST['selectedprice'], 'image' => $product_img, 'ip_address' => $get_ip);
                $_SESSION['wholesale-cart'][] = $wholesaleCartItems;
                print_r($_SESSION['wholesale-cart']);
                echo '<script>alert("Wholesale.")</script>';

            } else {
                echo '<script>alert("Sorry but something went wrong.")</script>';
            }

            // $cartItems = array('product_id' => $product_id,'product_title' => $product_title , 'selected_price' => $_POST['selectedprice'], 'image' => $product_img, 'ip_address' => $get_ip);
            // $_SESSION['cart'][] = $cartItems;
            // echo"<script>alert('Item added to cart')</script>";
        }

        if(isset($_SESSION['usersuid'])){
            $get_ip = getIPAddress();
            $prod_id = $_POST['prod_id'];
            $selected_price = $_POST['selectedprice'];
            $select = "SELECT * FROM `cart_details` WHERE ip_address = '$get_ip' AND product_id = $prod_id";
            echo $select;
            $result = mysqli_query($link, $select);
            $num_of_rows = mysqli_num_rows($result);
            if(!mysqli_num_rows($result)>0){
                $insert = "INSERT into `cart_details` (product_id, ip_address, quantity, selected_price) VALUES ($prod_id, '$get_ip', 0 , $selected_price)";
                $result_insert = mysqli_query($link, $insert);
                echo"<script>alert('Item added to cart')</script>";
                echo"<script>location.href = 'ecom-product-details.php?prod_id=$prod_id';</script>";
                
            } else if (mysqli_num_rows($result)>0) {
                echo"<script>alert('Item already in cart.')</script>";
                echo"<script>location.href = 'ecom-product-details.php?prod_id=$prod_id';</script>";
            }
        }
    }
?>
