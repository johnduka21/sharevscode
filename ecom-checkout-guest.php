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
	<title>Guest Checkout</title>
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/guest-checkout.scss">
	<link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="your-cart">
        <div class="cart-header">
        <a href="ecom-category.php"><i class="fa-solid fa-arrow-left alt back-arrow"></i></a>
        <h2 class="cart-h2">Guest Checkout</h2>
        </div>
    </nav>
    <div class="sign-up-upsell">
        <div class="order-text">
            <h2>Want to speed up checkout process?</h2><br>
            <p class="sign-in-here"><a href="ecom-sign-up.php">Create your account here!</a></p>
            <br>
            <p class="sign-in-here">Or continueto  checkout as a guest below.</p>
        </div>
        <!-- <div class="order-text">
            <p>Are you a new customer?</p>
            <p class="sign-in-here"><a href="ecom-sign-up.php">Sign-Up Here!</a></p>
        </div> -->
        <!-- <div class="order-receipt">
            <i class="fa-solid fa-right-to-bracket"></i>
        </div> -->
    </div>
    <div class="order-container-2">
        <h2>Billing Address</h2>
        <form action="#">
            <div class="row-gap">
                <!-- Start of Form -->
                <h3>1. Choose Payment Method</h3>
                <div class="input-field">
                    <label for="">Full Name*</label>
                    <input type="text" placeholder="Enter Full Name" required>
                </div>
                <div class="input-field">
                    <label for="customer">Phone Number*</label>
                    <input type="text" placeholder="+639..." required>
                </div>
                <div class="input-field">
                    <label for="product">Address (House No, Street, Barangay)</label>
                    <input type="text" placeholder="Enter Address" required>
                </div>
                <div class="input-field">
                    <label for="quantity">City</label>
                    <input type="text" placeholder="Enter City" required>
                </div>
                <div class="input-field">
                    <label for="quantity">Province</label>
                    <input type="text" placeholder="Enter Province" required>
                </div>

                <!-- Payment Method -->
                <div class="payment-method">
                    <h3>2. Choose Payment Method</h3>
                    <div class="payment-container">
                        <button class="cod-gcash">Cash On Delivery</button>
                        <button class="cod-gcash">GCash (Transaction on delivery)</button>
                    </div>
                </div>

                <div class="total-price">
                    <h3>3. Total Bill</h3>
                    <p>Subtotal:</p>
                    <p class="border-bottom">Shipping:</p>
                    <h4>Total:</h4>
                </div>

                <!-- Checkout Button -->
                <div class="row-gap-button">
                    <button id="checkout" type="submit">Checkout</button>
                </div>
                <!-- End of Form -->
            </div>
        </form>
    </div>

</body>