<?php
include ('inventory-header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="600;url=php/inventory-logout.php" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Control 2</title>
    <link rel="stylesheet" href="css/inventory-stock.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
    <div class="stock_container">
        <div class="add_container">
            <div class="add_topNav">
            <h1>Edit Profile</h1>
            <a href="inventory-dashboard.php" class="href"><button id="add-cancel-btn">Cancel</button></a>
        </div>

        <!-- Start of Form -->
        <div class="details-container">
            <form action="" method="post" enctype="multipart/form-data">
            <label for="p-title">Name:</label>
                <input type="text" id="p-title" name="product-title" required="required">
            <br>
            <label for="p-title">New Password:</label>
                <input type="text" id="p-title" name="product-title" required="required">
            <br>
            <label for="p-title">Re-Enter New Password:</label>
                <input type="text" id="p-title" name="product-title" required="required">
            <br>
            <button>Update Profile</button>
            <button>Cancel</button>
            </form>
        </div>
    </div>
</body>