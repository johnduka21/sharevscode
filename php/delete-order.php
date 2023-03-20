<?php
require 'dbh.php';
session_start();
if(!isset($_SESSION['adminlogin'])){
        header("location: inventory-login.php?page=login");
    }

if(isset($_GET['order_id'])){
    $order_id = mysqli_real_escape_string($link, $_GET['order_id']);
    $delete_order = "DELETE FROM `user_orders` WHERE order_id = $order_id";
    $result_delete_order = mysqli_query($link, $delete_order);
    echo "<script>alert('Order deleted.')</script>";
    echo"<script>location.href = '../inventory-orders-new.php';</script>";
    die();
}

?>