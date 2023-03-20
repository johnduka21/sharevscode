<?php
include 'inventory-header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/inventory-stock.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>
<body>
    <?php
    if(isset($_POST['insert-product'])){
        //Product Details
        $product_title = mysqli_real_escape_string($link, $_POST['product-title']);
        $product_category = mysqli_real_escape_string($link, $_POST['product-category']);
        $retail_price = mysqli_real_escape_string($link, $_POST['retail-price']);
        $wholesale_price = mysqli_real_escape_string($link, $_POST['wholesale-price']);
        $stock_no = mysqli_real_escape_string($link, $_POST['stock-no']);
        $product_desc = mysqli_real_escape_string($link, $_POST['product-desc']);
        $product_status = 'true';

        //Product Image
        $product_image = mysqli_real_escape_string($link, $_FILES['product-img']['name']);
        $temp_image = mysqli_real_escape_string($link, $_FILES['product-img']['tmp_name']);

        //Move file to Product Image Folders
        move_uploaded_file($temp_image,"./Product Images/$product_image");
        
        //Insert Query
        $insert_product = "INSERT into products (product_title, product_categ, retail_price, wholesale_price, stock_no, product_desc, product_img) values ('$product_title', '$product_category', '$retail_price', '$wholesale_price', '$stock_no', '$product_desc', '$product_image')";
        $result_query = mysqli_query($link, $insert_product);
        if ($result_query){
            echo "<script>alert('Product has been inserted successfully.')</script>";
            echo "<script type='text/javascript'> document.location = 'inventory-stock.php'; </script>";
        } else {
            echo "Error: Product has not been inserted. Please check all details.";
        }
    }
    ?>
<div class="full-container">
<div class="stock_container">
    <div class="top-part">
        <h1>Add a Product</h1>
        <a href="inventory-stock.php" class="href"><button id="add-cancel-btn">Cancel</button></a>
    </div>
    <div class="details-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Enter Product Details</h2>
            <label for="p-title">Product Title:</label>
            <input type="text" id="p-title" name="product-title" required="required">

            <br>
            <label for="prod-category">Product Category:</label>
            <select class="category-select" id="" name="product-category" required="required">
                <option value="">Select a Category</option>
                <?php
                    $select_query="SELECT * FROM categories";
                    $result_query= mysqli_query($link, $select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo"<option value='$category_id'>$category_title</option>";
                    }
                ?>
            </select>
            <br>
            <label for="ret-price">Retail Price:</label>
            <span class="currencyinput">₱<input type="number" name="retail-price" value="1" min="1" required="required"></span>
            <br>
            <label for="whole-price">Wholesale Price:</label>
            <span class="currencyinput">₱<input type="number" name="wholesale-price" value="1" min="1" required="required"></span>
            <br>
            <label for="stock-no">Stock:</label>
            <input type="number" name="stock-no" value="1" min="1" required="required">
            <br>
            <label for="prod-description">Product Description:</label>
            <input type="text" name="product-desc" required="required" class="prod-desc">
            <br>
            <label for="p-title">Product Image:</label>
            <input type="file" id="p-title" name="product-img" required="required"></input>

            <button type="submit" class="add-prdct-btn" name="insert-product">Add Product</button>
        </form>
    </div>
    </div>

</div>
</div>

</body>    