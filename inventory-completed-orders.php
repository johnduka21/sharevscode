<?php
require 'php/dbh.php';
session_start();
if(!isset($_SESSION['adminlogin'])){
        header("location: inventory-login.php?page=login");
    }
?>

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
	<title>Completed Order | Inventory</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/process-orders.scss">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="your-cart">
      <div class="cart-header">
          <a href="inventory-sales-report-new.php"><i class="fa-solid fa-arrow-left alt back-arrow"></i></a>
          <h4 class="cart-h4">Completed Order</h4>
      </div>
    </nav>

  <div class="container-fluid">
    <div class="order-completed">
        <div class="order-text">
            <h5>Completed Order</h5>
            <p>Order details down below.</p>
        </div>
        <div class="order-receipt">
            <i class="fa-solid fa-receipt"></i>
        </div>
    </div>

    <div class="container">

        <?php
        if(isset($_GET['order_id'])){
        $order_id = mysqli_real_escape_string($link, $_GET['order_id']);

        $select_orders = "SELECT * FROM `completed_orders` o, `users` u WHERE o.user_id = u.usersId AND o.order_id = $order_id";
        $result_select_orders = mysqli_query($link, $select_orders);
        $row_data = mysqli_fetch_assoc($result_select_orders);

        $user_id = $row_data['user_id'];
        $order_id = $row_data['order_id'];
        $fullname = $row_data['usersFirstName']." ".$row_data['usersLastName'];
        $contact = $row_data['user_contact'];
        $address = $row_data['user_address'];
        $amount_due = $row_data['amount_due'];
        $invoice_number = $row_data['invoice_number'];
        $order_date = $row_data['delivered_date'];
        $order_type = $row_data['order_type'];
        $order_date_format = date("D, d-M-Y | h:i A", strtotime($order_date)); 

        $order_status = $row_data['order_status'];
        ?>
        <!-- Title -->
        <div class="d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 mb-0"><a href="#" class="text-muted"></a><?php echo $fullname?></h2>
        </div>
        <!-- Main content -->
        <div class="row">
            <div class="col-lg-8">
            <!-- Details -->
            <div class="card mb-4">
                <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                    <span class="me-3"><?php echo $order_type ?> Order #<?php echo $order_id?></span><span class="badge rounded-pill bg-info"><?php if($order_status=="Pending" || $order_status=="Shipping"){echo "Pending";}{echo "Delivered";}?></span><br>
                    <span class="me-3"><?php echo $order_date_format?></span>
                    </div>
                </div>
                <table class="table table-borderless">
                    <tbody>
                    <?php 
                    // Select Order Items
                    $select_order_prods = "SELECT o.order_id, o.invoice_number, o.total_products, o.delivered_date, o.shipping_fee, o.amount_due, oi.product_id, oi.product_title, oi.product_img, oi.quantity, oi.selected_price FROM `completed_orders` o, `completed_order_products` oi WHERE o.order_id=$order_id AND oi.order_id=$order_id";
                    $run_order_prods = mysqli_query($link, $select_order_prods);
                    
                    while($row_order_item = mysqli_fetch_assoc($run_order_prods)){
                        $shipping_fee = $row_order_item['shipping_fee'];
                        $price = $row_order_item['selected_price'];
                        $product_img = $row_order_item['product_img'];
                        $product_title = $row_order_item['product_title'];
                        $quantity = $row_order_item['quantity'];
                        ?>
                    <tr>
                        <td>
                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0">  
                            <img src="./Product Images/<?php echo $product_img ?>" alt="" width="35" class="img-fluid"> 
                            </div>                        
                            <div class="flex-lg-grow-1 ms-3"> 
                            <h6 class="small mb-0"><a href="#" class="text-reset" style="font-weight: bold;"><?php echo $product_title ?></a></h6>
                            <span class="small">Qty: <?php echo $quantity ?></span>
                            </div>
                        </div>
                        </td>
                        <td></td>
                        <td class="text-end">P<?php echo $price ?>.00</td>
                    </tr>
                    <?php } //End of product
                    $total = $amount_due+$shipping_fee;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2">Subtotal</td>
                        <td class="text-end">P<?php echo $amount_due?>.00</td>
                    </tr>
                    <tr>
                        <td colspan="2">Shipping</td>
                        <td class="text-end">P<?php echo $shipping_fee?>.00</td>                    
                    </tr>
                    <tr class="fw-bold">
                        <td colspan="2">TOTAL</td>
                        <td class="text-end">P<?php echo $total?>.00</td>
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
                    <?php if($order_status=="Pending" || $order_status=="Shipping"){echo"<span style='background-color: red; color: white; padding: .4rem; border-radius: 1.5rem; font-size: 12px; font-weight: bolder;'>UNPAID</span>";} else{echo"<span style='background-color: #013220; color: white; padding: .4rem; border-radius: 1.5rem; font-size: 12px; font-weight: bolder;'>PAID</span>";} ?></p>
                    </div>
                    <div class="col-lg-6">
                    <h3 class="h6" style="font-weight: bold;">Billing address</h3>
                    <address>
                        <?php echo $fullname?><br>
                        <?php echo $address?><br>
                        <abbr title="Phone">Contact #:</abbr> <?php echo $contact?>
                    </address>
                    </div>
                </div>
                </div>
            </div>
          </div>
        </div> 
      </div>
      <div class="btn-container">
      <!-- <a href="php/revert-order.php?order_id=<?php echo $order_id?>" onclick="return confirm('Click OK to confirm that this order has been delivered.')"><button class="btn-fulfilled">Return to Orders</button></a> -->
        <button class="btn-delete"><a href="php/revert-order.php?revert-order=<?php echo $order_id?>" onclick="return confirm('Are you sure you this is not a completed order?')">Return to Orders</a></button>
    </div>
    </div>
</body>

<?php } else {
    echo"There are currently no orders.";
} ?>