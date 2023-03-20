<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/960bfa3deb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Fish Category</title>
    <link rel="stylesheet" href="css/inventory-stock.css">
    <link rel="icon" type="image/x-icon" href="images/PlaceholderFavIcon.ico">
</head>
<body>

    <?php
    /*
    include ('inventory-header.php');
    if(isset($_POST['insert-categ'])){
        $category_title = $_POST['categ-title'];

        //Select Data from Database
        $select_query = "SELECT * from accesso_categories WHERE category_title='$category_title'";
        $result_select = mysqli_query($link, $select_query);
        $number = mysqli_num_rows($result_select);

        if ($category_title==''){
            echo "<script>alert('Please fill all the details.')</script>";
        }
        else if ($number>0){
            echo "<script>alert('Oops! This category already exists.')</script>";
        } 
        else {
            //Insert Data to Database 
            $insert_query = "INSERT into accessocategories (category_title) values ('$category_title')";
            $result = mysqli_query($link, $insert_query);
            if ($result){
                echo "<script>alert('Category has been inserted successfully.')</script>";
            }
        }

    }*/
    ?>

    <?php
    include ('inventory-header.php');

    //Insert Accessories Category
    if(isset($_POST['insert-categ'])){
        $category_title = $_POST['categ-title'];
        $category_image = $_FILES['categ-img']['name'];
        $temp_image = $_FILES['categ-img']['tmp_name'];

        move_uploaded_file($temp_image,"./Category Images/$category_image");
        //Insert Query
        $insert_category = "INSERT into accesso_categories (category_title, category_img) values ('$category_title', '$category_image')";
        $result_query = mysqli_query($link, $insert_category);
        if ($result_query){
            echo "<script>alert('Category has been inserted successfully.')</script>";
        }
    }
    ?>


        <div class="add-details-container">
            <div class="add_container">
                <div class="add_topNav">
                    <h1>Insert Category | Accessories</h1>
                    <a href="inventory-categories.php" class="href"><button id="add-cancel-btn">Cancel</button></a>
                </div>
            </div>
            
            <div class="details-container">
            <form action="" method="post" class="ins-categ" enctype="multipart/form-data">
                <label for="p-title">Category Title:</label>
                    <input type="text" id="p-title" name="categ-title" required="required">
                    <br>
                    <!--UPLOAD CATEGORY IMAGE TRIAL-->
                    <label for="p-title">Upload Category Image:</label>
                    <input type="file" id="p-title" name="categ-img"  required="required">
                    <br>
                    <button type="submit" class="add-prdct-btn" name="insert-categ">Add Category</button>
                </form>
            </div>
        </div>

    </div>

</body>    