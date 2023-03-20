<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Control 2</title>
    <link rel="stylesheet" href="css/inventory-customers.css">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
    <div id="dashboardMainContainer">
        <?php
        include 'inventory-header.php';
        ?>


    <div class="stock_container">
        <div class="stock_topNav">
            <h1>List of Customers</h1>
            <a href="inventory-add-customer.html" class="href"><button id="products-add-product">Add Customer</button></a>
        </div>

        <div class="stock_content">
            <div class="stock_main">  
                <!-- All Products -->
                <div class="all-products">
                    <div class="products-table">
                        <div class="products-title">
                            <p>All Customers</p>
                        </div>
                        <div>
                            <table>
                                <tr>
                <?php
                $select_users = "SELECT * FROM `users`";
                $result_users = mysqli_query($link, $select_users);

                while($row_data = mysqli_fetch_assoc($result_users)){
                ?>
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone #</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><?=$row_data['usersId']?></td>
                                    <td>John Doe</td>
                                    <td>johndoe123@gmail.com</td>
                                    <td>09125723950</td>
                                    <td>
                                        <button>Edit</button>
                                        <button>Delete</button>
                                    </td>
                                    <?php } ?>
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