<?php
    include 'ecom-header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="stylesheet" href="css/ecom-sign-in-new.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body background="">
    <!--Banner.-->

    <div class="main-container">
        <div class="login-container">
            <div class="top-bar">
                <div class="logo-flex">
                    <img class ="logo" src="images/PlaceholderFavIcon.ico" alt="">
                </div>
                <!-- Sign-In Header -->
                <h1>Sign-In</h1>
            </div>

            <!-- Enter Email -->
            <form action="php/signin.php" method="post">
            <label for="username">Username or Email </label>
            <input type="text" name="uid" placeholder="Enter Username/Email" required>

            <!-- Enter Password -->
            <label>Password </label>
            <input type="password" name="pwd" placeholder="Enter Password"required>

            <!-- Click Login Button -->
            <button class="login-btn" type="submit" name="submit">Login</button>

            <!-- Click Sign-Up Button -->
            <div class="bottom-part">
                <p>Don't Have An Account Yet?</p>
                <a href="ecom-sign-up.php">Sign-Up Here</a>
            </div>
            </form>

            <?php
            if (isset($_GET["error"])){
                if ($_GET["error"] == "emptyinput"){
                    echo "<p>Fill in all fields.<p>";
                }
                else if ($_GET["error"] == "wronglogin"){
                    echo "<p>Wrong Username or Email.<p>";
                }
                else if ($_GET["error"] == "wrongpassword"){
                    echo "<p>Wrong Password.<p>";
                }
            }
            ?>

        </div>
    </div>
</body>