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
                <img class ='product-img' src='Product Images/$product_img' alt= '$product_title'>"
                ?>
            </div>

            <div class="product-details">
                <?php
                echo"<h3>$product_title</h3>";
                ?>
                <span>₱</span><div id = 'result'></div>
                <?php
                echo"<form method='POST'>
                <input type='hidden' name='prod_id' value='$product_id'>
                <div>
                    <select id='update_price' name ='selectedprice'>
                        <option value=''>Select</option>
                        <option value='$retail_price'>Retail</option>
                        <option value='$wholesale_price'>Wholesale</option>
                    </select>
                </div>
                <p>Wholesale: Min. Order of ₱2,000. Pwedeng iba-ibang isda basta po P2,000.</p>
                <div class='quantity-container'>
                    <h4 class='quantity'>Quantity</h4>
                    <input class='quantity-select' type='number' value='1' 
                    style='width: 30px;' min='1'>
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
//Add To Cart in Product Detail
if(isset($_POST['submit'])){
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
?>
