<?php
include 'functions.php';
require 'dbh.php';
session_start();
if(!isset($_SESSION['adminlogin'])){
        header("location: inventory-login.php?page=login");
    }

if(isset($_GET['order_id'])){
    $order_id = mysqli_real_escape_string($link, $_GET['order_id']);
    $get_ip = getIPAddress();
    $select_order = "SELECT * FROM `user_orders` WHERE order_id = $order_id";
    $result_select_order = mysqli_query($link, $select_order);
    $row_data = mysqli_fetch_assoc($result_select_order);
    $user_id = $row_data['user_id'];
    $amount_due = $row_data['amount_due'];
    $invoice_number = $row_data['invoice_number'];
    $total_products = $row_data['total_products'];
    $order_date = $row_data['order_date'];
    $order_status = $row_data['order_status'];
    $order_shipping = $row_data['shipping_fee'];
    $date = time();

    $insert_complete_orders = "INSERT INTO `completed_orders` (order_id, user_id, amount_due, invoice_number, total_products, delivered_date, order_status, shipping_fee) VALUES ({$order_id}, {$user_id}, {$amount_due}, {$invoice_number}, {$total_products}, '{$date}', '{$order_status}', '{$order_shipping}')";
    $result_complete_order = mysqli_query($link, $insert_complete_orders);

    $update_status = "UPDATE `completed_orders` SET order_status = 'Delivered' WHERE order_id = $order_id";
    $result_update_status = mysqli_query($link, $update_status);

    if($result_complete_order){
        // Fetch Order ID
        $select_order_id = "SELECT order_id FROM `completed_orders` WHERE user_id=$user_id ORDER BY order_id DESC LIMIT 1";
        $select_order_id_query = mysqli_query($link, $select_order_id);
        $get_order_id=mysqli_fetch_array($select_order_id_query);
        $order_id = $get_order_id['order_id'];
    
        //Select Item Details from Cart and Products
        $query_order_items = "SELECT * FROM `user_orders_products` c,`user_orders` o WHERE o.order_id=$order_id AND c.userId = o.user_id";
        $run_order_items = mysqli_query($link, $query_order_items);
        $count_order_items = mysqli_num_rows($run_order_items);
    
        if($count_order_items>0){//if may laman ang user_orders
            while($orderitem = mysqli_fetch_assoc($run_order_items)){
                $order_oid = $orderitem['order_id'];
                $order_pid = $orderitem['product_id'];
                $order_title = $orderitem['product_title'];
                $order_img = $orderitem['product_img'];
                $order_pqty = $orderitem['quantity'];
                $order_price = $orderitem['selected_price'];
            
                //Insert to Completed Order Items 
                $insert_order_items = "INSERT INTO `completed_order_products` (order_id, product_id, product_title, product_img, ip_address, quantity, selected_price, userId) VALUES ('{$order_oid}', '{$order_pid}', '{$order_title}', '{$order_img}', '{$get_ip}', '{$order_pqty}', '{$order_price}', '{$user_id}')";
        
                $result_order_items = mysqli_query($link, $insert_order_items);

                $delete_order = "DELETE FROM `user_orders_products` WHERE order_id = $order_id";
                $result_delete_order = mysqli_query($link, $delete_order);
        }
        }
    }

    $delete_order = "DELETE FROM `user_orders` WHERE order_id = $order_id";
    $result_delete_order = mysqli_query($link, $delete_order);

    echo "<script>alert('Order fulfilled!')</script>";
    echo"<script>location.href = '../inventory-orders-new.php';</script>";
    die(mysqli_error($link));
}
?>

