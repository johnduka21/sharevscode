<?php
include 'functions.php';
include 'dbh.php';
session_start();


if (isset($_SESSION['usersuid'])) {
global $link;
if(isset($_GET['user'])){
    $user_id = mysqli_escape_string($link,$_GET['user']);
}
$get_ip = getIPAddress();
$total_price=0;
$cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip' AND userId = $user_id";
$result_cart_price = mysqli_query($link, $cart_query_price);
$count_products = mysqli_num_rows($result_cart_price);

$invoice_number = mt_rand();
$status = 'Pending';

//Fetch Total Price
while($row_price=mysqli_fetch_array($result_cart_price)){
    $product_id=$row_price['product_id'];
    $select_products = "SELECT * FROM `cart_details` WHERE  product_id='$product_id'";
    $run_products = mysqli_query($link, $select_products);
    while($row_product_price=mysqli_fetch_array($run_products)){
        $product_price=array($row_product_price['selected_price']);
        $product_values=array_sum($product_price);
        $total_price += $product_values;
    }
}

$get_cart = "SELECT * FROM `cart_details`";
$run_cart = mysqli_query($link, $get_cart);
$get_item_quantity=mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];
$selected_price = $get_item_quantity['selected_price'];

if($quantity == 0){
    $quantity = 1;
    $subtotal = $total_price;
} else{
    $finalquantity = $quantity; 
    $subtotal = $total_price*$finalquantity;
}

//Insert to USER ORDERS 
$insert_orders = "INSERT INTO `user_orders` (user_id, amount_due, invoice_number,total_products, order_status) VALUES ({$user_id}, {$subtotal}, {$invoice_number}, {$count_products}, '{$status}')";
$result_query = mysqli_query($link, $insert_orders);

if($result_query){
    // Fetch Order ID
    $select_order_id = "SELECT order_id FROM `user_orders` WHERE user_id=$user_id ORDER BY order_id DESC LIMIT 1";
    $select_order_id_query = mysqli_query($link, $select_order_id);
    $get_order_id=mysqli_fetch_array($select_order_id_query);
    $order_id = $get_order_id['order_id'];

    //Select Item Details from Cart and Products
    // $query_order_items = "SELECT c.userId, c.product_id, c.product_title, c.product_img, c.ip_address, c.quantity, c.selected_price, c.userId, o.order_id, o.user_id FROM `cart_details` c LEFT JOIN `user_orders` o ON c.userId = o.user_id";
    $query_order_items = "SELECT * FROM `cart_details` c,`user_orders` o WHERE o.order_id=$order_id AND c.userId = o.user_id";
    $run_order_items = mysqli_query($link, $query_order_items);
    $count_order_items = mysqli_num_rows($run_order_items);

if($count_order_items>0){//if may laman ang cart
    while($orderitem = mysqli_fetch_assoc($run_order_items)){
        $order_oid = $orderitem['order_id'];
        $order_pid = $orderitem['product_id'];
        $order_title = $orderitem['product_title'];
        $order_img = $orderitem['product_img'];
        $order_pqty = $orderitem['quantity'];
        $order_price = $orderitem['selected_price'];
     
        //Insert to Order Items 
        $insert_order_items = "INSERT INTO `user_orders_products` (order_id, product_id, product_title, product_img, ip_address, quantity, selected_price, userId) VALUES ('{$order_oid}', '{$order_pid}', '{$order_title}', '{$order_img}', '{$get_ip}', '{$order_pqty}', '{$order_price}', '{$user_id}')";

        $result_order_items = mysqli_query($link, $insert_order_items);

        //Update Stock No
        $product_query = "SELECT * FROM `products` WHERE product_id = $order_pid LIMIT 1";
        $product_query_run = mysqli_query($link, $product_query);

        $productData = mysqli_fetch_array($product_query_run);
        $current_qty = $productData['stock_no'];

        $new_qty = $current_qty - $order_pqty;

        $update_qty_query = "UPDATE `products` SET stock_no = $new_qty WHERE product_id = $order_pid";
        $update_qty_query_run = mysqli_query($link, $update_qty_query);
        //Delete items from cart
        $empty_cart = "DELETE FROM `cart_details` WHERE product_id=$order_pid AND userId=$user_id";
        $result_empty_cart = mysqli_query($link, $empty_cart);
    }
}

echo "<script>alert('Your order has been submitted successfully!')</script>";
echo"<script>location.href = '../ecom-pending-orders.php?pending-order-list=$user_id';</script>";
die(mysqli_error($link));

} else {
    echo "<script>alert('Something went wrong.')</script>";
}

}//End of GET User_Id
?>