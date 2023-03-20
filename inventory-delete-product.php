<?php
include ('php/dbh.php');

if(isset($_GET['prod_id'])){
    $product_id = mysqli_real_escape_string($link, $_GET['prod_id']);

    $delete_query = "DELETE FROM products WHERE product_id='$product_id'";
    $delete_query_run = mysqli_query($link, $delete_query);

    if($delete_query_run){
        echo "<script>alert('Product Deleted')</script>";
        echo "<script type='text/javascript'>document.location = 'inventory-stock.php';</script>";
    } else {
        echo "<script>alert('Something went wrong.')</script>";
        echo "<script type='text/javascript'>document.location = 'inventory-stock.php';</script>";
    }
}
?>