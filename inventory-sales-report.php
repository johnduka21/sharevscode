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
    <title>Bulacan Pet Fish Supply Dashboard</title>
    <link rel="stylesheet" href="css/inventory-sales.css">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>
<body>

        <div class="stock_container">
            <div class="stock_topNav">
                <h1>Sales Report</h1>
                <!--<a href="inventory-add-product.html" class="href"><button id="products-add-product">Add Product</button></a>-->
            </div>

            <div class="stock_content">
                <div class="stock_main">  
                    <!-- All Products -->
                    <div class="all-products">
                        <div class="products-table">
                            <div class="products-title">
                                <p>All Sales</p>
                            </div>
                            <div>
                                <table id="myTable">
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Order Subtotal</th>
                                        <th>Total</th>
                                    </tr>
                                    <tr>
                                        <td>109092313</td>
                                        <td>June 10, 2022</td>
                                        <td>John Doe</td>
                                        <td>P1,400.00</td>
                                        <td>P1,450.00</td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    <script>
        $(document).ready(function(){
        $('#myTable').DataTable();
        });
        $("#myTable").css({"margin": "1.2rem 0"});
    </script>
</body>