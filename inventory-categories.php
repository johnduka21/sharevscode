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
    <title>Categories</title>
    <link rel="stylesheet" href="css/inventory-stock.css">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
    <!--Header--> 


<div class="stock_container">
    <div class="stock_topNav">
        <h1>Categories</h1>
        <a href="inventory-insert-fishCategory.php" class="href"><button id="products-add-product">Insert Product Category</button></a>
        <!-- <a href="inventory-insert-accCategory.php" class="href"><button id="products-add-product">Accessories: Insert Category</button></a>
        <a href="inventory-insert-aquaCategory.php" class="href"><button id="products-add-product">Aquarium: Insert Category</button></a> -->
    </div>

    <div class="stock_content">
    
    <!-- Fish Category -->
        <div class="stock_main">  
            <!-- All Products -->
            <div class="all-products">
                <div class="products-table">
                    <div class="products-title">
                        <p>Categories</p>
                    </div>
                    <div>
                        <table id="myTable">
                            <tr>
                                <th>Category ID</th>
                                <th>Category Title</th>
                                <th>Date Added/Modified</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                            <?php
                                $select_category = "SELECT * FROM categories";
                                $result_query = mysqli_query($link, $select_category);

                                while($row_data = mysqli_fetch_assoc($result_query)){
                                    $category_id=$row_data['category_id'];
                                    $category_title=$row_data['category_title'];
                                    $date_added=$row_data['date_added'];
                                    
                                    echo"<tr><td>$category_id</td>
                                    <td>$category_title</td>
                                    <td>$date_added</td>
                                    <td>
                                        <button><a href='inventory-edit-categories.php?category_id=$category_id'>Edit</a></button>

                                        <input type='hidden' name='categ-id' value='<?php echo $category_id ?>'>
                                        
                                        <button name='delete-categ'><a href='inventory-delete-category.php?categ_id=$category_id' onClick=\"javascript: return confirm('Are You Sure You Want to Delete This Category?');\">Delete</a></button>
                                    </td></tr>";
                                }
                            ?>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>