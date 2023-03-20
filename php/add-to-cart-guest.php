<?php
session_start();
if (isset($_SESSION['guest'])) { //GUEST ADD TO CART 
    if (isset($_GET['id'])) {
        if (empty($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
            array_push($_SESSION['cart'], $GET['id']);
            echo "<script>alert('Item added to cart')</script>";
        }
    }
}
?>