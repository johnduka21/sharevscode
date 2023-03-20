<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/ecom-sign-up.css">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>

<body>
    <!--Banner.-->
	
    <?php
    include 'ecom-header.php';
    ?>

    <div class="main-container">
        <div class="login-container">
            <div class="logo-flex">
                <img class ="logo" src="images/PlaceholderFavIcon.ico" alt="">
            </div>

            <form action="php/signup.php" method="post">
            <!-- Sign-Up Header -->
            <h3>Step 1: Enter Information</h3>

            <!-- Sign-Up Header -->
            <h1>Sign-Up</h1>

            <!-- Enter Fname -->
            <label for="fname">First Name: </label><br>
            <input type="text" name="fname" placeholder ="First Name..." required>
            <br>

            <!-- Enter Lname -->
            <label for="lname">Last Name: </label><br>
            <input type="text" name="lname" placeholder ="Last Name..." required>
            <br>

            <!-- Enter Email -->
            <label for="email">Email: </label><br>
            <input type="text" name="email" placeholder ="Email..." required>
            <br>

            <!-- Enter Username -->
            <label for="username">Username: </label><br>
            <input type="text" name="username" placeholder ="Username..." required>
            <br>

            <!-- Enter Password -->
            <label for="password">Password: </label><br>
            <input type="password" name="password" placeholder ="Password..." required>
            <br>

            <!-- Confirm Password -->
            <label for="password">Confirm Password: </label><br>
            <input type="password" name="pwdrepeat" placeholder ="Repeat Password..." required>
            <br>
            
            <!-- Click Login Button -->
            <button class="login-btn" type="submit" name="submit">Sign-Up</button>
            </form>
        
        <?php
        if (isset($_GET["error"])){
            if ($_GET["error"] == "emptyinput"){
                echo "<p>Fill in all fields.<p>";
            }
            else if ($_GET["error"] == "invaliduid"){
                echo "<p>Choose a proper username.<p>";
            }
            else if ($_GET["error"] == "invalidemail"){
                echo "<p>Choose a proper email.<p>";
            }
            else if ($_GET["error"] == "invaliduid"){
                echo "<p>Choose a proper username.<p>";
            }
            else if ($_GET["error"] == "passwordsdontmatch"){
                echo "<p>Passwords don't match.<p>";
            }
            else if ($_GET["error"] == "stmtfailed"){
                echo "<p>Something went wrong.<p>";
            }
            else if ($_GET["error"] == "usernametaken"){
                echo "<p>Username already taken.<p>";
            }
            else if ($_GET["error"] == "none"){
                echo"<script>alert('Sign-Up Sucessful!')</script>";
            }
        }
        //$result = registerAdmin();
        //echo $result;
        ?>
        </div>
    </div>

</body>