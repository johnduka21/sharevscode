<?php
include ('php/dbh.php');

if(isset($_GET['prod_id'])){
    $product_id = mysqli_real_escape_string($link, $_GET['prod_id']);

    $delete_query = "DELETE FROM `cart_details` WHERE product_id='$product_id'";
    $delete_query_run = mysqli_query($link, $delete_query);

    if($delete_query_run){
        //echo "<script>alert('Item Removed')</script>";
        echo "<script type='text/javascript'>document.location = 'ecom-cart-3.php';</script>";
    } else {
        echo "<script>alert('Something went wrong.')</script>";
        echo "<script type='text/javascript'>document.location = 'ecom-cart-3.php';</script>";
    }
}

if(isset($_GET['wholesale_id'])){
    $product_id = mysqli_real_escape_string($link, $_GET['wholesale_id']);

    $delete_query = "DELETE FROM `wholesale_cart` WHERE product_id='$product_id'";
    $delete_query_run = mysqli_query($link, $delete_query);

    if($delete_query_run){
        //echo "<script>alert('Item Removed')</script>";
        echo "<script type='text/javascript'>document.location = 'ecom-cart-wholesale.php';</script>";
    } else {
        echo "<script>alert('Something went wrong.')</script>";
        echo "<script type='text/javascript'>document.location = 'ecom-cart-wholesale.php';</script>";
    }
}
?>