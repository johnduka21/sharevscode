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
    <title>Bulacan Pet Fish Supply Dashboard</title>
    <link rel="stylesheet" href="css/inventory-stock.css">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>
<body>
    <?php
    if(isset($_POST['updt-product'])){
        //Product Details
        $product_id = mysqli_real_escape_string($link, $_POST['product-id']);
        $product_title = mysqli_real_escape_string($link, $_POST['product-title']);
        $product_category = mysqli_real_escape_string($link, $_POST['product-category']);
        $retail_price = mysqli_real_escape_string($link, $_POST['retail-price']);
        $wholesale_price = mysqli_real_escape_string($link, $_POST['wholesale-price']);
        $stock_no = mysqli_real_escape_string($link, $_POST['stock-no']);
        $product_desc = mysqli_real_escape_string($link, $_POST['product-desc']);
        $product_status = 'true';

        $new_image = mysqli_real_escape_string($link, $_FILES['product-img']['name']);
        $temp_image = mysqli_real_escape_string($link, $_FILES['product-img']['tmp_name']);

        $old_image = mysqli_real_escape_string($link, $_POST['old-img']);

        //Update image or not
        if ($new_image != ""){
            $update_image = $new_image;
        } else {
            $update_image = $old_image;
        }
        
        //Update Query
        //$update_product = "UPDATE products SET (product_title, product_categ, retail_price, wholesale_price, stock_no, product_desc, product_img) values ('$product_title', '$product_category', '$retail_price', '$wholesale_price', '$stock_no', '$product_desc', '$update_image') WHERE product_id = '$product_id";

        $update_product = "UPDATE products SET product_title='$product_title', product_categ='$product_category', retail_price='$retail_price', wholesale_price='$wholesale_price', stock_no='$stock_no', product_desc='$product_desc', product_img='$update_image' WHERE product_id ='$product_id';";
        
        $update_query_run = mysqli_query($link, $update_product);
        if ($update_query_run){
            if($temp_image){
                move_uploaded_file($temp_image,"./Product Images/$update_image");
                if(file_exists("./Product Images/".$old_image)){
                    unlink("./Product Images/".$old_image);
                }
            }
            echo"<script>alert('Product Updated Successfully!')</script>";
        }
    }
    ?>

    <!-- Start of Edit Products Page -->
        <div class="stock_container">
            <div class="add_container">
                <div class="top-part">
                    <h1>Edit Product</h1>
                    <a href="inventory-stock.php" class="href"><button id="add-cancel-btn">Cancel</button></a>
                </div>
            </div>

            <?php
                if (isset($_GET['prod_id'])){
                    global $link;
                    $product_id = mysqli_real_escape_string($link, $_GET['prod_id']);
                    $select_category = "SELECT * FROM categories";
                    $run_category = mysqli_query($link, $select_category);
                    $result_category = mysqli_fetch_assoc($run_category);

                    $select_product = "SELECT * FROM products WHERE product_id='$product_id'";
                    $result_query = mysqli_query($link, $select_product);

                    if(mysqli_num_rows($result_query) > 0){
                        $data = mysqli_fetch_array($result_query);                  
            ?>
            <!-- Beginning of Edit Product Form -->
            <div class="details-container">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="product-id" value="<?php echo $data['product_id'];?>">
                <label for="p-title">Product Title:</label>
                <input type="text" id="p-title" name="product-title" required="required" value="<?= $data['product_title']?>">
                <div>
                    <label for="prod-category">Product Category:</label>
                    <select class="category-select" id="" name="product-category" required="required">
                        <option value=""><?=$result_category['category_title'];?></option>
                        <!-- Q: How can I remove existing category from options-->
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
                </div>

                <br>
                <label for="ret-price">Retail Price:</label>
                <span class="currencyinput">₱<input type="number" name="retail-price" value="<?=$data['retail_price'];?>" min="1" required="required"></span>

                <br>
                <label for="whole-price">Wholesale Price:</label>
                <span class="currencyinput">₱<input type="number" name="wholesale-price" value="<?=$data['wholesale_price']?>" min="1" required="required"></span>

                <br>
                <label for="stock-no">Stock:</label>
                <span><input type="number" name="stock-no" value="<?=$data['stock_no']?>" min="0" required="required"></span>

                <br>
                <label for="prod-description">Product Description:</label>
                <span><input type="text" name="product-desc" required="required" value="<?=$data['product_desc']?>"></span>
                <br>

                <label for="p-title">Change Product Image:</label>
                <input type="file" id="p-title" name="product-img" >
                <br>
                <label for="p-title">Current Image:</label>
                <input type="hidden" name="old-img" value="<?=$data['product_img']?>">
                <img src="Product Images/<?= $data['product_img']?>" height=50px width=50px>
                <br>
                <button type="submit" class="add-prdct-btn" name="updt-product" onClick="javascript: return confirm('Are You Sure You Want to Update This Product?');">Update Product</button>
                <a href="php/inventory-delete-product.php?delete-product=<?=$product_id?>" style="margin-top: 1.5rem; color: #FFFFFF;text-align: center; padding: 10px 20px; font-weight: bold; font-size: 13px;cursor: pointer;text-decoration: none; color: white; background-color: red;" onClick="javascript: return confirm('Are You Sure You Want to Delete This Product?');">Delete Product</a>
            </form>
            </div>
            
            <?php
                    } 
                    else {
                        //Display error message (if product does not exist)
                        echo"The product does not exist";
                    }
                } 
                else {
                    //Display error message (if product_id does not exist)
                    echo"Product ID does not exist";
                }
            ?>
        </div>

    </div>

</body>    