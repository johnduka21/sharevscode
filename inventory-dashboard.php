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
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/inventory-system.css">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>
<body>
    <?php
    //Get Total Number of Products
    $select_num = "SELECT * FROM products";
    $result_products = mysqli_query($link, $select_num);
    $get_num_products = mysqli_num_rows($result_products);

    $select_orders = "SELECT * FROM user_orders";
    $result_orders = mysqli_query($link, $select_orders);
    $get_num_orders = mysqli_num_rows($result_orders);

    $select_completed = "SELECT * FROM completed_orders";
    $result_completed = mysqli_query($link, $select_completed);
    $get_num_completed = mysqli_num_rows($result_completed);

    $select_users = "SELECT * FROM users";
    $result_users = mysqli_query($link, $select_users);
    $get_num_users = mysqli_num_rows($result_users);

    $select_revenue = "SELECT SUM(amount_due) AS value_sum, SUM(shipping_fee) AS ship_fee FROM completed_orders";
    $result_revenue = mysqli_query($link, $select_revenue);
    $get_num_revenue = mysqli_fetch_assoc($result_revenue);
    $ship_fee = $get_num_revenue['ship_fee'];
    $revenue = $get_num_revenue['value_sum'];
    $total_revenue = $revenue + $ship_fee;

    ?>
    

    <div class="dashboard_content_container">
    
        <div class="dashboard_content_main">
            <!-- CARDS -->
            <div class="cards">
                <!-- First Card -->
                <div class="card-single">
                    <div>
                        <h1><?php echo $get_num_orders?></h1>
                        <a href="inventory-orders.php"><p>Orders</p></a>
                    </div>
                    <div>
                        <span class="fa-solid fa-cart-shopping"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1><?php echo $get_num_completed?></h1>
                        <a href="inventory-orders.php"><p>Sales</p></a>
                    </div>
                    <div>
                        <span class="fa-solid fa-cart-shopping"></span>
                    </div>
                </div>

                <!-- Second Card -->
                <div class="card-single">
                    <div>
                        <?php if($revenue == 0){?> 
                            <h1>P0.00</h1>
                        <p>Revenue</p>
                        <?php } else {
                            echo" <h1>P$total_revenue.00</h1>
                            <p>Revenue</p>";
                        } ?>
                    </div>
                    <div>
                        <span class="fa-solid fa-coins"></span>
                    </div>
                </div>

                <!-- Third Card -->
                <div class="card-single">
                    <div>
                        <h1><?=$get_num_products?></h1>
                        <a href="inventory-stock.php"><p>Total Products</p></a>
                    </div>
                    <div>
                        <span class="fa-solid fa-fish-fins"></span>
                    </div>
                </div>

                <!-- Fourth Card -->
                <div class="card-single">
                    <div>
                        <h1><?=$get_num_users?></h1>
                        <a href="inventory-sales-report.php"><p>Users</p></a>
                    </div>
                </div>

            </div>
        
            <div class="content-2">
                <div class="recent-orders">
                    <div class="recent-orders-title">
                        <p>Best Sellers</p> 
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>Sales</th>
                            </tr>
                            <tr>
                                <td>June 8, 2022</td>
                                <td>John Doe</td>
                                <td>1,000</td>
                            </tr>
                            <tr>
                                <td>June 8, 2022</td>
                                <td>John Doe</td>
                                <td>242</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
            
</body>

<!-- https://www.youtube.com/watch?v=UQpZJdQ2o-I&t=113s | This is the Responsive Ecommerce Inventory system type for CRUD learning-->