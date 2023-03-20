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
    <title>Walk-In Customers</title>
    <link rel="stylesheet" href="css/inventory-walk-in.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>
<body>
    <div class="page-container">
        <div class="order-container-1">
            <div class="stock_topNav">
                <h1>Walk-In Customers</h1>
            </div>
            <div class="add-btns">
                <button><a href="">Add New Customer</a></button>
            </div>
            <div class="order-container-2">
                <h2>Add Order Details</h2>
                <form action="#">
                    <div class="row-gap">
                        <div class="customer-bar">
                            <label for="">Select Customer</label>
                            <select name="">
                                <option value="" disabled selected hidden>Select Customer</option>
                            </select>
                        </div>
                        <div class="order-bar">
                            <label for="customer">Select Order Type</label>
                            <select name="">
                                <option value="" disabled selected hidden>Select Order Type</option>
                            </select>
                        </div>
                        <!-- <div class="products-bar"> -->
                            <div class="select-products">
                                <label for="product">Select Products</label>
                                <select name="">
                                    <option value="" disabled selected hidden>Select Product</option>
                                </select>
                            </div>
                            <div class="enter-quantity">
                                <label for="quantity">Enter Quantity</label>
                                <input type="number" placeholder="Enter Quantity" min="1">
                            </div>
                        <!-- </div> -->
                    </div>
                    <a href=""><button id="add-order-btn" type="submit">Add Order</button></a>
                </form>
            </div>
        </div>
    </div>
</body>