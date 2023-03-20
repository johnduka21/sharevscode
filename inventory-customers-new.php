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
        <h1>Customers</h1>
    </div>

    <div class="stock_content">
        <div class="stock_main">  
            <!-- All Products -->
            <div class="all-products">
                <div class="products-table">
                    <div class="products-title">
                        <!-- <p>All Products</p> -->
                    </div>
                    <div class="table-size">
                        <table id="myTable" class="content-table">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Customer Name</th>
                                    <th>Phone #</th>
                                    <th>City</th>
                                    <th>User ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                $select_users = "SELECT * FROM `users`";
                $result_users = mysqli_query($link, $select_users);

                while($row_data = mysqli_fetch_assoc($result_users)){
                ?>
                                <tr>
                                    <td><?=$row_data['usersFirstName']." ".$row_data['usersLastName']?></td>
                                    <td><?=$row_data['user_contact']?></td>
                                    <td><?=$row_data['user_city']?></td>
                                    <td><?=$row_data['usersId']?></td>
                                    <?php } ?>
                                </tr>
                                
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
    </script>
</body>