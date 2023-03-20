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
    <link rel="stylesheet" href="css/inventory-header.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
<body>
    <!-- <div class="navbar"> -->
        <div id="top-navbar">
            <h3>Bulacan Pet Fish Supply</h3>
            <div class="menu-toggle">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </div>
        <nav>
        <div class="inventory-container">
            <div class="profile">
                <div class="h3-div">
                    <h3>Bulacan Pet Fish Supply</h3>
                    <h3 class="subhead">Inventory System</h3>
                </div>
                <div class="profile-info">
                    <img src="images/Inventory System/Dashboard/user.png" alt="User Image"/>
                    <p>Shayne Santos</p>
                </div>
            </div>
            <div class="side-navbar">
                <ul class="navbar-items">
                    <li><a href="inventory-dashboard.php"><i class="fa-sharp fa-solid fa-border-all"></i> Dashboard</a></li>
                    <li><a href="inventory-walk-in.php"><i class="fa-solid fa-person-walking-luggage"></i> Walk-In Customers</a></li>
                    <li><a href="inventory-categories-new.php"><i class="fa-duotone fa-square-plus"></i> Categories</a></li>
                    <li><a href="inventory-stock.php"><i class="fa-solid fa-square-parking"></i> Products</a></li>
                    <li><a href="inventory-orders-new.php"><i class="fa-sharp fa-solid fa-basket-shopping"></i> Orders</a></li>
                    <li><a href="inventory-sales-report-new.php"><i class="fa-solid fa-square-poll-vertical"></i> Completed Orders</a></li>
                    <li><a href="inventory-customers-new.php"><i class='fa-solid fa-user alt user'></i> Customers</a></li>
                    <div class="bottom-items">
                        <!-- <li><a href="inventory-edit-profile.php">Edit Profile</a></li> -->
                        <li><a href="php/inventory-logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                    </div>
                    <div class="copyright">
                        <p>All Rights Reserved.</p>
                        <p>© Bulacan Pet Fish Supply</p>
                    </div>
                </ul>
            </div>    
        </div>
        </nav>
    </div>
</body>

<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.menu-toggle').click(function(){
            $('.inventory-container').toggleClass('active')
        })
    })

    const burger = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.navbar-items');
    const navLinks = document.querySelectorAll('.navbar-items li');

    burger.addEventListener('click',()=>{
        //Toggle Nav
        nav.classList.toggle('nav-active');

        //Animate Links
        navLinks.forEach((link, index)=>{
            if(link.style.animation){
                link.style.animation = '';
            } else{
                link.style.animation = `navLinkFade 0.5s ease forwards ${index/7 + 0.3}s`;
            }
        });

        //Burger Animation
        burger.classList.toggle('toggle');
    });
</script>