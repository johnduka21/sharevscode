<?php
include ('inventory-header.php');
    $select_product = "SELECT * FROM categories";
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
    <title>Categories</title>
    <link rel="stylesheet" href="css/inventory-categories-new.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
    <!--Header-->

<div class="stock_container">
    <div class="stock_topNav">
        <h1>Categories</h1>
    </div>

    <div class="stock_content">
    <a href="inventory-insert-fishCategory.php" class="href"><button id="products-add-product">Add Category</button></a>
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
                                    <th>Category Title</th>
                                    <th>Date Modified</th>
                                    <th>No. of Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php
                                while($row_data = mysqli_fetch_assoc($result_query)){
                                    $categ_id = $row_data['category_id'];
                                    $categ_title = $row_data['category_title'];
                                    $date_added = $row_data['date_added'];
                                
                                    echo"
                                    <td class='prod-title'>$categ_title</td>
                                    <td>$date_added</td>
                                    <td></td>
                                    <td hidden='hidden'></td>

                                    <input type='hidden' name='category_id' value='<?php echo $categ_id?>'>
                                    <td><button><a href='inventory-edit-categories.php?category_id=$categ_id'>Edit</a></button></td></tr>";
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#myTable').DataTable();
        });
        $("#myTable").css({"margin": "1.2rem 0"});
    </script>
</body>