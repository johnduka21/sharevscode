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
    <title>Betta Fish</title>
    <link rel="stylesheet" href="css/product-listing.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>
<body>       
    <div class="listing-container">
        <!-- Display Products -->
        <div class="listing-items">
            <?php
            getproducts();
            get_unique_category();

            if(isset($_GET['search_data_product'])){
                $search = $_GET['search_data'];
                $search_product = "SELECT * FROM `products` WHERE product_title LIKE '%$search%'";
                    $result_product = mysqli_query($link, $search_product);
                    while ($row_data = mysqli_fetch_assoc($result_product)){
                        $product_title = $row_data['product_title'];
                        $retail_price = $row_data['retail_price'];
                        $product_image = $row_data['product_img'];
                        echo"<div class='product'>
                        <!-- Image -->
                        <img class ='product-img-class' src='./Product Images/$product_image' alt='$product_title'>
                        <h2 class='product-title'>$product_title</h2>
                        <!-- Price -->
                        <p class='product-price'>$retail_price</p>
                        <!-- View Button -->
                        <button type='button' class='btn-cart'>View Product<span><i class='fa-solid fa-plus-large'></i></span></button>
                        <!-- Add to Cart Button -->
                        <button type='button' class='btn-buy'>Add to Cart</button>
                </div>";
                }
            }
            ?>
        </div>
    </div>

</body>
</html>