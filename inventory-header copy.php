<?php
require 'php/dbh.php';
session_start();
if(!isset($_SESSION['adminlogin'])){
        header("location: inventory-login.php?page=login");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="600;url=php/inventory-logout.php" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inventory-stock.css">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>


<div id="dashboardMainContainer">
        <div class="dashboard_sidebar">
            <h1 class="dashboard_logo">Bulacan Pet Fish Supply</h1>

            <div class="dashboard_sidebar_user">
                <img src="images/Inventory System/Dashboard/user.png" alt="User Image"/>
                <span>Admin</span>
            </div>
            <div class="dashboard_sidebar_menu">
                <ul class="dashboard_menu_lists">
                    <li>
                        <a href="inventory-dashboard.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="#">Walk-In Customers</a>
                    </li>
                    <li>
                        <a href="inventory-categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="inventory-stock.php">Inventory</a>
                    </li>
                    <li>
                        <a href="inventory-orders.php">Orders</a>
                    </li>
                    <li>
                        <a href="inventory-sales-report.php">Sales Report</a>
                    </li>
                    <li>
                        <a href="inventory-customers.php">Customers</a>
                    </li>
                    <li>
                        <a href="inventory-edit-profile.php">Edit Profile</a>
                    </li>
                </ul>
            </div>    
        </div>