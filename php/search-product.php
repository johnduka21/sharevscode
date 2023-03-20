<?php
    include '../ecom-header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="css/product-listing.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>
<body> 
    <div class="listing-container">          
        <!-- Display Products -->
        <div class="listing-items">
            <?php
            searchproducts();
            get_unique_category();
            ?>
        </div>
    </div>
</body>
</html>