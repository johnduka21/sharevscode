<?php
include ('inventory-header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Control 2</title>
    <link rel="stylesheet" href="css/inventory-stock.css">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
    <!--Header-->

            <div class="stock_container">
                <div class="stock_topNav">
                    <h1>Stock</h1>
                    <a href="inventory-add-product.php" class="href"><button id="products-add-product">Add Product</button></a>
                </div>

                <div class="stock_content">
                    <div class="stock_main">  
                        <!-- All Products -->
                        <div class="all-products">
                            <div class="products-table">
                                <div class="products-title">
                                    <p>All Products</p>
                                </div>
                                <div>
                                    <table>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Title</th>
                                            <th>Category</th>
                                            <th>Retail Price</th>
                                            <th>Wholesale Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                        <?php
                                        $select_product = "SELECT * FROM products";
                                        $result_query = mysqli_query($link, $select_product);

                                        while($row_data = mysqli_fetch_assoc($result_query)){
                                            $product_id = $row_data['product_id'];
                                            $product_title = $row_data['product_title'];
                                            $product_categ = $row_data['product_categ'];
                                            $retail = $row_data['retail_price'];
                                            $wholesale = $row_data['wholesale_price'];
                                            $stock_no = $row_data['stock_no'];
                                        

                                            echo"<td>$product_id</td>
                                                <td>$product_title</td>
                                                <td>$product_categ</td>
                                                <td>₱$retail</td>
                                                <td>₱$wholesale</td>
                                                <td>$stock_no</td>
                                                <td>
                                                    <button name='product_id'><a href='inventory-edit-products.php?prod_id=$product_id'>Edit</button>
                                                    
                                                    <input type='hidden' name='product_id' value='<?php echo $product_id?>'>
                                                    <button name='delete-product'><a href='inventory-delete-product.php?prod_id=$product_id' onClick=\"javascript: return confirm('Are You Sure You Want to Delete This Product?')\">Delete</a></button>
                                                </td></tr>";
                                        }
                                        ?>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
</body>