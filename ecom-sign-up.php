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
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/ecom-sign-up-new.scss">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
    <div class="main-container">
        <div class="login-container">
            <div class="logo-flex">
                <img class ="logo" src="images/PlaceholderFavIcon.ico" alt="">
            </div>

            <form action="php/signup.php" method="post">
            <!-- Sign-Up Header -->
            <div class="top-part">
                <h3>Step 1: Enter Information</h3>

                <!-- Sign-Up Header -->
                <h1>Sign-Up</h1>
            </div>

            <?php
        if (isset($_GET["error"])){
            if ($_GET["error"] == "emptyinput"){
                echo"<script>alert('Fill in all fields.')</script>";
                echo"<h4 style='text-align: center; color: red;'>Please fill in all fields.</h4>";
            }
            else if ($_GET["error"] == "invaliduid"){
                echo"<script>alert('Choose a proper username.')</script>";
                echo"<h4 style='text-align: center; color: red; margin-bottom: 1rem;'>Please choose a proper username.</h4>";
            }
            else if ($_GET["error"] == "invalidemail"){
                echo"<script>alert('Choose a proper email.')</script>";
                echo"<h4 style='text-align: center; color: red; margin-bottom: 1rem;'>Please choose a proper email.</h4>";
            }
            else if ($_GET["error"] == "invaliduid"){
                echo"<script>alert('Choose a proper username.')</script>";
                echo"<h4 style='text-align: center; color: red; margin-bottom: 1rem;'>Please choose a proper username.</h4>";
            }
            else if ($_GET["error"] == "passwordsdontmatch"){
                echo"<script>alert('Passwords don't match.')</script>";
                echo"<h4 style='text-align: center; color: red; margin-bottom: 1rem;;'>Oops! Passwords don't match.</h4>";
            }
            else if ($_GET["error"] == "stmtfailed"){
                echo"<script>alert('Something went wrong.')</script>";
                echo"<h4 style='text-align: center; color: red; margin-bottom: 1rem;'>Oops! Something went wrong.</h4>";
            }
            else if ($_GET["error"] == "usernametaken"){
                echo"<script>alert('Username is already taken.')</script>";
                echo"<h4 style='text-align: center; color: red; margin-bottom: 1rem;'>Username is already taken.<br>Please choose a different username.</h4>";
            }
            else if ($_GET["error"] == "invalidnumber"){
                echo"<script>alert('Invalid contact number.')</script>";
                echo"<h4 style='text-align: center; color: red; margin-bottom: 1rem;'>Please enter an 11-digit contact number.</h4>";
            }
            else if ($_GET["error"] == "emailtaken"){
                echo"<script>alert('Email is already taken.')</script>";
                echo"<h4 style='text-align: center; color: red; margin-bottom: 1rem;'>Email is already taken.<br>Please choose a different email.</h4>";
            }
            else if ($_GET["error"] == "none"){
                echo"<script>alert('Sign-Up Sucessful!')</script>";
            }
        }
        //$result = registerAdmin();
        //echo $result;
        ?>
            <!-- Enter Fname -->
            <label for="fname">First Name: </label>
            <input type="text" name="fname" placeholder ="First Name..." required>

            <!-- Enter Lname -->
            <label for="lname">Last Name: </label>
            <input type="text" name="lname" placeholder ="Last Name..." required>

            <!-- Enter Email -->
            <label for="email">Email: </label>
            <input type="text" name="email" placeholder ="Email..." required>

            <!-- Enter Contact -->
            <label for="contact">Phone Number (09--): </label>
            <!-- <input type="number" name="contact" maxlength="11" placeholder ="Phone Number..." required> -->
            <input name="contact" placeholder ="Phone Number..." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" min="11" maxlength = "11">

            <!-- Enter Address -->
            <label for="address">Address (House No, Street): </label>
            <input type="text" name="address" placeholder ="Address..." required>
            <label for="address">Barangay </label>
            <input type="text" name="barangay" placeholder ="Brgy..." required>
            <label for="address">City</label>
            <input type="text" name="city" placeholder ="City..." required>
            <label for="address">Postal Code</label>
            <input type="text" name="postal" placeholder ="Postal code..." required>

            <!-- Enter Username -->
            <label for="username">Username: </label>
            <input type="text" name="username" placeholder ="Username..." required>

            <!-- Enter Password -->
            <label for="password">Password: </label>
            <input type="password" name="password" placeholder ="Password..." required>

            <!-- Confirm Password -->
            <label for="password">Confirm Password: </label>
            <input type="password" name="pwdrepeat" placeholder ="Repeat Password..." required>
            
            <!-- Click Login Button -->
            <button class="login-btn" type="submit" name="submit">Sign-Up</button>
            </form>
        
        </div>
    </div>

</body>