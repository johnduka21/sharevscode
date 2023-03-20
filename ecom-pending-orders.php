<!DOCTYPE html>
<html lang="en-PH">
<head>
	<!--METADATA: GOOGLE SEO STUFF AND MAKING THIS GOOD FOR MOBILE-->
	<meta charset= "UTF-8">
	<meta name = "description" content = "Bulacan Pet Fish Supply E-Commerce">
	<meta name = "keywords" content = "Bulacan, fish, pet fish, fish supply, fish supplies, fish accessory, fish accessories, fish store, 
	aquarium, aquarium tank">
	<meta name = "author" content = "John Duka">
	<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
	<!--Title, Favicons, Font, Icons in Font, and CSS Stylesheet-->
	<title>Pending Orders</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/pending-orders.scss">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
</head>

<body>

<?php 
session_start();
include 'php/dbh.php';
include 'php/functions.php';

if(!isset($_SESSION['usersuid'])){
    header("location: ecom-sign-in.php?page=login");
}
if (isset($_SESSION['usersuid'])){
//Pending Order Items
if(isset($_GET['pending-order'])){
    $item_order_id = mysqli_escape_string($link, $_GET['pending-order']);
    $user_id = $_SESSION['usersid'];

    $select_user_order = "SELECT * FROM `user_orders` o, `users` u WHERE o.user_id = u.usersId AND order_id=$item_order_id";
    $run_user_order = mysqli_query($link, $select_user_order);
    $run_user_order = mysqli_fetch_assoc($run_user_order);
    $fullname = $run_user_order['usersFirstName']." ".$run_user_order['usersLastName'];
    $contact = $run_user_order['user_contact'];
    $address = $run_user_order['user_address'];
    $amount_due = $run_user_order['amount_due'];
    $order_type = $run_user_order['order_type'];
    $date_format  = date("d-M-Y (h:i A)", strtotime($run_user_order['order_date']));
    ?>
    
    <!-- Nav Bar -->
    <nav class="your-cart">
        <div class="cart-header">
            <a href="ecom-pending-orders.php?pending-order-list=<?php echo $user_id?>"><i class="fa-solid fa-arrow-left alt back-arrow"></i></a>
            <h4 class="cart-h4">My Purchases</h4>
        </div>
    </nav>

    <?php
    // Select order items from order
    $select_order_prods = "SELECT * FROM `user_orders` o, `user_orders_products` oi WHERE o.order_id=$item_order_id AND oi.order_id=$item_order_id";
    $run_order_prods = mysqli_query($link, $select_order_prods);
?>

    <!-- Start of Order -->
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 mb-0"><a href="#" class="text-muted"></a><?php echo $order_type ?> Order #<?php echo $item_order_id ?></h2>
        </div>
            
    <!-- Start of Per Product -->
            <div class="row">
                <div class="col-lg-8">
                <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between">
                        <div>
                        <span class="me-3"><?php echo $date_format ?></span>
                        <?php if($order_status="Pending"){echo"<span class='badge rounded-pill' style='background-color: red;'>PENDING</span>";} else if($order_status="Shipping"){echo"<span class='badge rounded-pill bg-info'>SHIPPING</span>";} else{echo"<span class='badge rounded-pill' style='background-color: green;'>DELIVERED</span>";} ?>
                        </div>

                    </div>
                    <table class="table table-borderless">
                        <tbody>

                        <!-- Start of Order Items -->
                        <?php while($row_order_item = mysqli_fetch_assoc($run_order_prods)){
                        $shipping_fee = $row_order_item['shipping_fee'];
                        $product_img = $row_order_item['product_img'];
                        ?>
                        <tr>
                            <td>
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0">
                                <img src="./Product Images/<?php echo $product_img ?>" alt="" width="35" class="img-fluid">
                                </div>
                                <div class="flex-lg-grow-1 ms-3">
                                <h6 class="small mb-0"><a href="#" class="text-reset" style="font-weight: bold;"><?php echo $row_order_item['product_title'] ?></a></h6>
                                <span class="small">Qty: <?php echo $row_order_item['quantity'] ?></span>
                                </div>
                            </div>
                            </td>
                            <td></td>
                            <td class="text-end">P<?php echo $row_order_item['selected_price'] ?>.00</td>
                        </tr>
                        <?php }  //End of product 
                        $total = $amount_due+$shipping_fee;
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2">Subtotal</td>
                            <td class="text-end">P<?php echo $amount_due ?>.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">Shipping</td>
                            <td class="text-end" style="color: red; font-weight: bold;"><?php if($shipping_fee==0){echo "In Process";}else{echo "P$shipping_fee.00";} ?></td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="2">TOTAL</td>
                            <td class="text-end">P<?php echo $total ?>.00</td>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                <!-- Payment -->
                <div class="card mb-4">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                        <h3 class="h6" style="font-weight: bold;">Payment Method (Transaction on delivery)</h3>
                        <p>Cash-on-delivery, GCash, or Bank<br>
                        Amount to Pay: P<?php echo $total?>
                        <?php if($order_status="Pending" || $order_status="Shipping"){echo"<span style='background-color: red; color: white; padding: .4rem; border-radius: 1.5rem; font-size: 12px; font-weight: bolder;'>UNPAID</span>";} else{echo"<span style='background-color: #013220; color: white; padding: .4rem; border-radius: 1.5rem; font-size: 12px; font-weight: bolder;'>PAID</span>";} ?></p>
                        </div><br>
                    <div class="col-lg-6">
                    <h3 class="h6" style="font-weight: bold;">Billing address</h3>
                    <address>
                        <?php echo $fullname?><br>
                        <?php echo $address?><br>
                        <abbr title="Phone">Contact #:</abbr> <?php echo $contact?>
                    </address>
                    </div>
                    <a href="https://m.me/bpfs2020" style="font-weight: bold;">Have questions about your order? Contact Us Here</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            
        </div>
    </div>
</body>

<?php
} 

//Pending Order List
if(isset($_GET['pending-order-list'])){
    $item_order_id = mysqli_escape_string($link, $_GET['pending-order-list']);
    $user_id = $_SESSION['usersid'];
    $select_pending = "SELECT * FROM `user_orders` WHERE user_id=$user_id";
    $run_pending = mysqli_query($link, $select_pending);
    if(mysqli_num_rows($run_pending)>0){
?>
<!-- Nav Bar -->
<nav class="your-cart">
    <div class="cart-header">
        <a href="home.php"><i class="fa-solid fa-arrow-left alt back-arrow"></i></a>
        <h4 class="cart-h4">My Purchases</h4>
    </div>
</nav>
<!-- Pending and Delivered Buttons -->
<div class="container-fluid">
<div class="btn-container">
    <button class="btn-pending"><a href="ecom-pending-orders.php?pending-order-list=<?=$user_id?>">Pending</a></button>
    <button class="btn-delivered"><a href="ecom-delivered-orders.php?completed-order-list=<?=$user_id?>">Delivered</a></button>
</div>

<!-- Start of Orders -->
<div class="container">
    <div class="d-flex justify-content-between align-items-center py-3">
        <h2 class="h5 mb-0"><a href="#" class="text-muted"></a>Your Pending Orders </h2>
    </div>
</div>

<?php 
    $pending_order_user_id = mysqli_real_escape_string($link, $_GET['pending-order-list']);
    $select_order = "SELECT * FROM `user_orders` WHERE user_id = $pending_order_user_id";
    $run_order = mysqli_query($link, $select_order);
    while($row_order = mysqli_fetch_assoc($run_order)){ 
        $order_date_format = date("d-M-Y (h:i A)", strtotime($row_order['order_date'])); 
        $order_type = $row_order['order_type']; ?>
    
    <!-- Start of Per Order -->
    <div class="container">        
            <div class="row">
                <div class="col-lg-8">
                <!-- Details -->
                <div class="card mb-10">
                    <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between">
                        <div>
                            <?php if($order_type==""){ ?>
                            <span class="me-3" style="font-weight: bold;"><span class='badge rounded-pill' style='background-color: #0062E4; font-size: 14px;'><?php echo $order_type ?> Order #: <?php echo $row_order['order_id'] ?></span> 
                            <?php } if($order_type=="Wholesale"){ ?> 
                            <span class="me-3" style="font-weight: bold;"><span class='badge rounded-pill' style='background-color: #000C1D; font-size: 14px;'><?php echo $order_type ?> Order #: <?php echo $row_order['order_id'] ?></span>
                            <?php } ?>                     
                        </div>
                    </div>
                    <table class="table">
                        <tbody>
                        
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2" style='font-weight: bold;'>Order Date: </td>
                            <td class="text-end"><?php echo $order_date_format ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style='font-weight: bold;'>Status</td>
                            <td class="text-end"><?php if($order_status="Pending"){echo"<span class='badge rounded-pill' style='background-color: red;'>PENDING</span>";} else if($order_status="Shipping"){echo"<span class='badge rounded-pill bg-info'>SHIPPING</span>";} else{echo"<span class='badge rounded-pill' style='background-color: green;'>DELIVERED</span>";} ?></td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="2">Items: </td>
                            <td class="text-end"><?php echo $row_order['total_products'] ?></td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="2">Amount: </td>
                            <td class="text-end">P<?php echo $row_order['amount_due'] ?>.00</td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="2"></td>
                            <td class="text-end"><a href="ecom-pending-orders.php?pending-order=<?php echo $row_order['order_id']?>"><button style='background-color: #000C1D; color: white;'>View Order</button></a></td>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                
                </div>
            </div>

            
        </div>
<?php 
    } 
} else {
    ?> 
    <!-- Nav Bar -->
<nav class="your-cart">
    <div class="cart-header">
        <a href="home.php"><i class="fa-solid fa-arrow-left alt back-arrow"></i></a>
        <h4 class="cart-h4">Your Orders</h4>
    </div>
</nav>
<!-- Pending and Delivered Buttons -->
<div class="container-fluid">
<div class="btn-container">
    <button class="btn-pending"><a href="ecom-pending-orders.php?pending-order-list=<?=$user_id?>">Pending</a></button>
    <button class="btn-delivered"><a href="ecom-delivered-orders.php?completed-order-list=<?=$user_id?>">Delivered</a></button>
</div>
<div><h3 style="text-align: center">You Have No Pending Orders.</h3></div>
    <?php
}
}
}
?>