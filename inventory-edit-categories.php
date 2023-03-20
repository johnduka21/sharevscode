<?php
include 'inventory-header.php';
?>

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

    //Edit Category (Update Category Module)
        if (isset($_POST['updt-categ'])){
        $category_id = mysqli_real_escape_string($link, $_POST['category_id']);
        $category_title = mysqli_real_escape_string($link, $_POST['categ-title']);
        $new_image = mysqli_real_escape_string($link, $_FILES['categ-img']['name']);
        $temp_image = mysqli_real_escape_string($link, $_FILES['categ-img']['tmp_name']);
        
        $old_image = mysqli_real_escape_string($link, $_POST['old_image']);

            //Update Image or Not
            if ($new_image != ""){
                $update_image = $new_image;
            }
            else {
                $update_image = $old_image;
            }

        //Update query
        $update_query = "UPDATE categories SET category_title='$category_title', category_img='$update_image' WHERE category_id='$category_id'";

        //Run the query
        $update_query_run = mysqli_query($link, $update_query);

        //Update Category Images Folder with New Image
        if ($update_query_run){
            if($temp_image){
                move_uploaded_file($temp_image,"./Category Images/$update_image");
                //So if Old Image File Exists...
                if(file_exists("./Category Images/".$old_image)){
                    //Delete Old Image
                    unlink("./Category Images/".$old_image);
                }
            }
            echo"<script>alert('Category Updated Successfully!')</script>";
        }
    }
    ?>

        <!-- Top of Page -->
        <div class="stock_container">
            <div class="add_container">
                <div class="top-part">
                    <h1>Edit Category</h1>
                    <a href="inventory-categories-new.php" class="href"><button id="add-cancel-btn">Cancel</button></a>
                </div>
            </div>

            <?php
                //PHP: Fetch URL Category ID (To Edit Specific Category)
                if(isset($_GET['category_id'])){
                    global $link;
                    $id = mysqli_real_escape_string($link, $_GET['category_id']);
                    $select_category = "SELECT * FROM categories WHERE category_id='$id'";
                    $result_query = mysqli_query($link,$select_category);
                    
                    if (mysqli_num_rows($result_query) > 0){
                        $data = mysqli_fetch_array($result_query);
                    
                ?>
                        <!-- Edit Category Form -->
                        <div class="details-container">
                            <form action="" method="post" class="ins-categ" enctype="multipart/form-data">
                                <!-- Purpose: To fetch category_id from categories -->
                                <input type="hidden" name="category_id" value="<?php echo $data['category_id'];?>">
                                <!-- Start of Form -->
                                <label for="p-title">Category Title:</label>
                                <input type="text" id="p-title" name="categ-title" value="<?=$data['category_title']?>" required="required">
                                <br>
                                <label for="p-title">Edit Category Image:</label>
                                <input type="file" id="p-title" name="categ-img" >

                                <label for="p-title">Current Image</label>
                                <input type="hidden" name="old_image" value="<?=$data['category_img']?>">
                                <img src="Category Images/<?=$data['category_img']?>" height = "50px" width="50px">
                                <br>
                                <!--Update Category Module Button-->
                                <button type="submit" class="add-prdct-btn" name="updt-categ" onClick="javascript: return confirm('Are You Sure You Want to Update This Category?')">Update Category</button>
                            </form>
                        </div>
                        <?php
                    } 
                    else{
                        //Display Error Message (if category_id does not exist)    
                        echo "Category not found.";
                    }
                }
                else{
                    //Display Error Message (if no category_id in URL)
                    echo "Category ID not found: Please click the edit button properly.";
                }
            ?>
        </div>

    </div>

</body>    