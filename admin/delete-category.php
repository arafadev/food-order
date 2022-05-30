<?php


include '../config/constant.php';

if (isset($_GET['id']) && isset($_GET['image_name'])) {

    $id = $_GET['id'];

    $image_name = $_GET['image_name'];

    $path = "../images/category/" . $image_name;

    if ($image_name != "") {

        $path = "../images/category/" . $image_name;

        $remove = unlink($path);
        // if failed to remove the img than add an error message
        if ($remove == false) {
            // set the message 
            $_SESSION['remove'] = "<div class='error'>Failed to remove category Image</div>";
            // set the header
            header('location:' . SITEURL . 'admin/manage-category.php');
            die();
        }
    }

    // delete data from database
    $sql = "DELETE FROM tbl_category WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    } else {


        
        $_SESSION['delete'] = "<div class='error'>Failed To Deleted Category</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

    }
} else {
    header('location:' . SITEURL . 'admin/manage-category.php');
}
