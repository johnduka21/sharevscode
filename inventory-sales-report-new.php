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
    <title>Orders</title>
    <link rel="stylesheet" href="css/inventory-sales-report-new.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
    <!--Header-->

<div class="stock_container">
    <div class="stock_topNav">
        <h1>Completed Orders</h1>
    </div>

    <div class="stock_content">
    <a href="#" class="href"><button id="products-add-product">Add Order</button></a>
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
                                    <th>Delivery Date</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Order Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php
                        $select_orders = "SELECT * FROM `completed_orders` o, `users` u WHERE o.user_id = u.usersId";
                        $result_select_orders = mysqli_query($link, $select_orders);

                        while($row_data = mysqli_fetch_assoc($result_select_orders)){
                            $user_id = $row_data['user_id'];
                            $order_id = $row_data['order_id'];
                            $fullname = $row_data['usersFirstName']." ".$row_data['usersLastName'];
                            $order_date = $row_data['delivered_date'];
                            $order_date_format = date("d-M-Y | h:i A", strtotime($order_date));  
                            $order_status = $row_data['order_status'];
                            $order_amount = $row_data['amount_due'];
                            ?>

                            <td class='prod-title'><?php echo $order_date_format?></td>
                            <td><?php echo $fullname ?></td> 
                            <td><span style='background-color: #013220; color: white; padding: .5rem; border-radius: 2.5rem; font-size: 12px; font-weight: bolder;'><?php echo $order_amount?></span></td>
                            <td hidden='hidden'></td>
                            <input type='hidden' name='user_id' value='<?php echo $user_id?>'>
                            <td><button><a href='inventory-completed-orders.php?order_id=<?php echo $order_id?>'>Details</a></button></td></tr>

                        <?php }
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