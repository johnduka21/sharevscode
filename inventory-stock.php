<?php
include ('inventory-header.php');
    $select_product = "SELECT * FROM products, categories WHERE products.product_categ=categories.category_id";
    $result_query = mysqli_query($link, $select_product);

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
    <link rel="stylesheet" href="css/inventory-stock-2.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
    <!--Header-->

    <div class="stock_container">
        <div class="stock_topNav">
            <h1>Stock</h1>
        </div>

        <div class="stock_content">
        <a href="inventory-add-product.php" class="href"><button id="products-add-product">Add Product</button></a>
            <div class="stock_main">  
                <!-- All Products -->
                <div class="all-products">
                    <div class="products-table">
                        <div class="products-title">
                            <!-- <p>All Products</p> -->
                        </div>
                        <div class="table-size">
                            <table id="myTable" class="content-table">
                                <col style="width: 5%;">
                                <col style="width: 30%;">
                                <col style="width: 25%;">
                                <col style="width: 20%;">
                                <col style="width: 20%;">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Product Title</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <?php
                                    while($row_data = mysqli_fetch_assoc($result_query)){
                                        $product_id = $row_data['product_id'];
                                        $product_title = $row_data['product_title'];
                                        $product_categ = $row_data['product_categ'];
                                        $category_title = $row_data['category_title'];
                                        $retail = $row_data['retail_price'];
                                        $wholesale = $row_data['wholesale_price'];
                                        $stock_no = $row_data['stock_no'];
                                    
                                        echo"
                                        <td class='prod-title'>$product_title</td>
                                        <td>$category_title</td>
                                        <td>Qty: $stock_no</td>
                                        <td hidden='hidden'></td>

                                        <input type='hidden' name='product_id' value='<?php echo $product_id?>'>
                                        <td><button name='product_id' id='edit-btn'><a href='inventory-edit-products.php?prod_id=$product_id'>Edit</button></td></tr>";
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>

<!-- JavaScript for Search -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#myTable').DataTable();
        });
        $("#myTable").css({"margin": "1.2rem 0"});
    </script>