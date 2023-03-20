<?php 
include 'dbh.php';

if(isset($_GET['delete-product'])){
    $product_id = mysqli_real_escape_string($link, $_GET['delete-product']);
    // Delete products
    $empty_cart = "DELETE FROM `products` WHERE product_id=$product_id";
    $result_empty_cart = mysqli_query($link, $empty_cart);
    if ($empty_cart){
        echo"<script>alert('The product has been deleted.')</script>";
        echo "<script>window.location.href='../inventory-stock.php'</script>";
    }
    
}

?>