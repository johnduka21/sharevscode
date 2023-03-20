<?php
    function emptyInputSignUp($fname, $lname, $email, $contact, $address, $barangay, $city, $postal, $username, $pwd, $pwdRepeat){
        $result = true; 
        if (empty($fname) || empty($lname) || empty( $email) || empty($contact) || empty($address) || empty($barangay) || empty($city) ||  empty($postal) || empty($username) || empty($pwd) || empty($pwdRepeat)){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    function invalidUid($username){
        $result = true; 
        if (!preg_match("/^[a-zA-z0-9]*$/", $username)){
            $result = true;
        }
        else{
            $result = false;
        } 
        return $result;
    }

    function validate_mobile($contact){
        $result = true;
        if (!preg_match('/^[0-9]{11}+$/', $contact)){
            $result = true;
        }
        else{
            $result = false;
        } 
        return $result;
    }

    function invalidEmail($email){
        $result = true; 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        else{
            $result = false;
        } 
        return $result;
    }

    function pwdMatch($pwd, $pwdRepeat){
        $result = true; 
        if ($pwd != $pwdRepeat){
            $result = true; //meaning there was an error
        }
        else{
            $result = false;
        } 
        return $result;
    }

    function uidExists($link, $username){
        $sql = "SELECT*FROM users WHERE usersUid = ?;";
        $stmt = mysqli_stmt_init($link);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ./ecom-sign-up.php?error=stmtfailed");
            exit();
        } 

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $resultsData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultsData)){
            return $row;
        }
        else {
            $result = false;
        }

        mysqli_stmt_close($stmt);
        return $result;
    }

    function emailExists($link, $email){
        $sql = "SELECT*FROM users WHERE usersEmail = ?;";
        $stmt = mysqli_stmt_init($link);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ./ecom-sign-up.php?error=stmtfailed");
            exit();
        } 

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $resultsData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultsData)){
            return $row;
        }
        else {
            $result = false;
        }

        mysqli_stmt_close($stmt);
        return $result;
    }

    function createUser($link, $fname, $lname, $email, $contact, $address, $barangay, $city, $postal, $username, $pwd){
        $sql = "INSERT INTO users (usersFirstName, usersLastName, usersEmail, user_contact, user_address, user_brgy, user_city, user_postal, usersUid, usersPwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($link);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../ecom-sign-up.php?error=stmtfailed");
            exit();
        } 

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt -> bind_param("ssssssssss", $fname, $lname, $email, $contact, $address, $barangay, $city, $postal, $username, $hashedPwd);
        //mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $username, $hashedPwd);

        //Email Verification Code
        /*$mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPAuth = true;
        $mail->Username = 'dukadukss@gmail.com';
        $mail->Password = '1133423983';

        $mail->setFrom('dukadukss@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $to = $email;
        $subject = "Email Verification for Bulacan Pet Fish Supply";
        $message = "<a href='verify.php?vkey=$vkey'>Register Account</a>";
        $headers = 'From: dukadukss@gmail.com'."\r\n";
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers = "Content-type:text/html;charset=UTF-8"."\r\n";

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();*/

        echo "<script language='javascript'>";
        echo "alert('Sign-Up Successful!');\n";
        echo "window.location.href='../ecom-sign-in.php'"; //Redirects the user with JavaScript
        echo "</script>";

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "<script language='javascript'>";
        echo "alert('Sign-Up Successful!');\n";
        echo "window.location.href='../ecom-sign-in.php'"; //Redirects the user with JavaScript
        echo "</script>";
        exit();
    }

//Sign-In Code

    function emptyInputSignin($username, $pwd){
    $result = true; 
    if (empty($username) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
    }

    function loginUser($link, $username, $pwd){
        $uidExists = uidExists($link, $username);

        if ($uidExists == false){
            header("location: ../ecom-sign-in.php?error=wronglogin");
            exit();
        }

        $pwdHashed = $uidExists['usersPwd'];
        $checkPwd = password_verify($pwd, $pwdHashed);

        if($checkPwd === false){
            header("location: ../ecom-sign-in.php?error=wrongpassword");
            exit();
        }
        else if($checkPwd === true){
            session_start();
            $_SESSION["usersid"] = $uidExists['usersId'];
            $_SESSION["usersuid"] = $uidExists['usersUid'];
            echo "<script>alert('Login successful!')</script>";
            header("location: ../home.php");
            exit();
        }
    }

    //Display Products
    function getproducts(){
        global $link;
        // if(!isset($_GET['category']))
        if(isset($_GET['products'])){
        $select_product = "SELECT * FROM products ORDER BY rand()";
                $result_product = mysqli_query($link, $select_product);
                while ($row_data = mysqli_fetch_assoc($result_product)){
                    $product_id = $row_data['product_id'];
                    $product_title = $row_data['product_title'];
                    $retail_price = $row_data['retail_price'];
                    $product_desc = $row_data['product_desc'];
                    $product_image = $row_data['product_img'];
                    echo"<div class='product'>
                    <!-- Image -->
                    <img class ='product-img-class' src='./Category Images/$product_image' alt='$product_title'>
                    <h2 class='product-title'>$product_title</h2>
                    <!-- Price -->
                    <p class='product-price'>P$retail_price.00</p>
                    <!-- View Button -->
                    <button type='button' class='btn-cart'><a href='ecom-product-details-new.php?prod_id=$product_id'>View Product<span><i class='fa-solid fa-plus-large'></i></span></a></button>
            </div>";
                }
            }
    }
    
    //Display Products based on a Category
    function get_unique_category(){
        global $link;

        if(isset($_GET['category'])){
        $category_id = $_GET['category'];
        $select_product = "SELECT * FROM products WHERE product_categ = ".mysqli_escape_string($link,$category_id);"";
                $result_product = mysqli_query($link, $select_product);
                $num_of_rows = mysqli_num_rows($result_product);
                if ($num_of_rows==0){
                    echo"<div style='border: 2px solid blue; padding: 15px 0px;'>
                    <i style='display: inline-block; width: 100%; font-size: 100px; text-align: center; color: blue;' class='fa-solid fa-circle-exclamation'></i>
                    <h1 style='text-align: center; color: blue;'>Oops!</h1>
                    <h3 style='text-align: center; color: blue;'>No stock for this category</h3>
                    <p style='text-align:center'><a href='home.php'>Go back to Homepage</a></p>
                    </div>";
                }
                while ($row_data = mysqli_fetch_assoc($result_product)){
                    $product_id = $row_data['product_id'];
                    $product_title = $row_data['product_title'];
                    $product_desc = $row_data['product_desc'];
                    $retail_price = $row_data['retail_price'];
                    $product_image = $row_data['product_img'];
                    echo"
                    <div class='product'>
                    <!-- Image -->
                    <img class ='product-img-class' src='./Product Images/$product_image' alt='$product_title'>
                    <h2 class='product-title'>$product_title</h2>
                    <!-- Price -->
                    <p class='product-price'>P$retail_price.00</p>
                    <!-- View Button -->
                    <button type='button' class='btn-cart'><a href='ecom-product-details-new.php?prod_id=$product_id'>View Product</a></button>
            </div>";
                }
            }
    }

    // Search Products on Ecommerce Website
    function searchproducts(){
        global $link;
        if(isset($_GET['search_data_product'])){
        $search = $_GET['search_data'];
        $search_product = "SELECT * FROM products WHERE product_title LIKE '%$search%'";
                $result_product = mysqli_query($link, $search_product);
                while ($row_data = mysqli_fetch_assoc($result_product)){
                    $product_title = $row_data['product_title'];
                    $retail_price = $row_data['retail_price'];
                    $product_image = $row_data['product_img'];
                    echo"<div class='product'>
                    <!-- Image -->
                    <img class ='product-img-class' src='./Product Images/$product_image' alt='$product_title'>
                    <h2 class='product-title'>$product_title</h2>
                    <!-- Price -->
                    <p class='product-price'>$retail_price</p>
                    <!-- View Button -->
                    <button type='button' class='btn-cart'>View Product<span><i class='fa-solid fa-plus-large'></i></span></button>
                    <!-- Add to Cart Button -->
                    <button type='button' class='btn-buy'>Add to Cart</button>
            </div>";
                }
            }
    }

    function getByID($categories, $id){
        global $link;
        $select_category = "SELECT * FROM $categories WHERE category_id='$id'";
        return $result_query = mysqli_query($link,$select_category);
    }

    function registerAdmin(){
    global $link;
    $username = "bulacanpetfish";
    $password = "BulacanPetFish2020";

    $register_admin = "INSERT INTO admin_login (admin_user,admin_pass) VALUES ('$username', '$password')";
    return $result = mysqli_query($link, $register_admin);
    }


    function getIPAddress() {
        $ip = '';
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    } 

    // function getIPAddress() {  
    //     //whether ip is from the share internet  
    //      if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
    //                 $ip = $_SERVER['HTTP_CLIENT_IP'];  
    //         }  
    //     //whether ip is from the proxy  
    //     elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
    //                 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    //      }  
    // //whether ip is from the remote address  
    //     else{  
    //              $ip = $_SERVER['REMOTE_ADDR'];  
    //      }  
    //      return $ip;  
    // } 

    //Add to Cart Function
    function addToCart(){
        if(isset($_GET['cart'])){
            global $link;
            $get_ip = getIPAddress();
            $prod_id = mysqli_real_escape_string($link, $_GET['cart']);
            $select = "SELECT * FROM `cart_details` WHERE `ip_address`='$get_ip' AND `product_id`=$prod_id";
            $result = mysqli_query($link, $select);
            //$num_of_rows = mysqli_num_rows($result);
            if(!mysqli_num_rows($result)>0){
                $insert = "INSERT into cart_details (product_id, ip_address, quantity) VALUES ($prod_id, '$get_ip', 1)";
                $result_insert = mysqli_query($link, $insert);
                echo"<script>alert('Item added to cart')</script>";
                echo"<script>location.href = 'ecom-product-details.php?prod_id=$prod_id';</script>";
                
            } else if (mysqli_num_rows($result)>0) {
                echo"<script>alert('Item already in cart.')</script>";
                echo"<script>location.href = 'ecom-product-details.php?prod_id=$prod_id';</script>";
            }
        }
    }

    //Display Number of Items in Cart
    function cartItem(){
        if(isset($_SESSION['usersuid'])){//Show how many on user cart      
            if(isset($_GET['cart'])){
                global $link;
                $get_ip = getIPAddress();
                $usersid = mysqli_escape_string($link,$_SESSION["usersid"]);
                $select = "SELECT * FROM `cart_details` WHERE `ip_address`='$get_ip' AND userId = '$usersid'";
                $result = mysqli_query($link, $select);
                $count_cart_items = mysqli_num_rows($result);
                }else{
                    global $link;
                    $get_ip = getIPAddress();
                    $usersid = mysqli_escape_string($link,$_SESSION["usersid"]);
                    $select = "SELECT * FROM `cart_details` WHERE `ip_address`='$get_ip' AND userId = '$usersid'";
                    $result = mysqli_query($link, $select);
                    $count_cart_items = mysqli_num_rows($result);  
                }
                echo $count_cart_items;
            }
        if (isset($_SESSION['guest'])){//Show how many on guest cart   
            // Header to Sign-In Page
        }
    }

    function totalCartPrice(){
        global $link;
        $get_ip = getIPAddress();
        $total_price = 0;
        $cart_query = "SELECT * FROM `cart_details` WHERE `ip_address`='$get_ip'";
        $result = mysqli_query($link, $cart_query); 
        while($row=mysqli_fetch_array($result)){
            $product_id = $row['product_id'];
            $select_products = "SELECT * FROM `products` WHERE `product_id` = $product_id";
            $result_products = mysqli_query($link, $select_products);
            while($row_product_price=mysqli_fetch_array($result_products)){
                $product_price = array($row_product_price['product_price']);
                $product_values = array_sum($product_price);
                $total_price+=$product_values;
            }
        }
        echo $total_price;
    }

function cleanInput(string $data) : string
{
$data = trim($data); // removes whitespace
$data = stripslashes($data); // strips slashes
$data = htmlspecialchars($data); // replaces html chars
return $data;
}

function getOrderDetails(){
global $link;
$username = $_SESSION['usersuid'];
$order_details = "SELECT * FROM `users` WHERE usersUid=$username";
$result_query = mysqli_query($link, $order_details);
while($row_query = mysqli_fetch_array($result_query)){
    if(!isset($_GET[''])){
        
    }
}
}