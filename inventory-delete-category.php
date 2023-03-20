<?php
include ('php/dbh.php');
    if (isset($_POST['delete-categ'])){
        $category_id = mysqli_real_escape_string($link, $_POST['categ-id']);
        
        $delete_query = "DELETE FROM categories WHERE category_id='$category_id'";
        $delete_query_run = mysqli_query($link, $delete_query);

        if ($delete_query_run){ 
            echo "<script>alert('Category Deleted.')</script>";
            echo "<script type='text/javascript'> document.location = 'inventory-categories.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong.')</script>";
            echo "<script type='text/javascript'> document.location = 'inventory-categories.php'; </script>";
        }
    }

    if (isset($_GET['categ_id'])){
        $category_id = $_GET['categ_id'];
        //$category_id = $_POST['categ-id'];
        
        $delete_query = "DELETE FROM categories WHERE category_id='$category_id'";
        $delete_query_run = mysqli_query($link, $delete_query);

        if ($delete_query_run){ 
            echo "<script>alert('Category Deleted.')</script>";
            echo "<script type='text/javascript'> document.location = 'inventory-categories.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong.')</script>";
            echo "<script type='text/javascript'> document.location = 'inventory-categories.php'; </script>";
        }
    }
?>