<?php include 'partials/menu.php' ?>
<?php

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_category WHERE id = $id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);


    if ($count == 1) {

        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        $_SESSION['non-category-found'] = "<div class='error'>Category can not found</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-category.php');
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1> <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>file: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") { ?>


                            <img src="../images/category/<?php echo $current_image ?>" alt="" width="150px">


                        <?php } else {
                            echo '<div class="error">Image Not Added</div>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" <?php if ($featured == 'Yes') {
                                                                echo 'checked';
                                                            } ?> value="Yes">Yes
                        <input type="radio" name="featured" <?php if ($featured == 'No') {
                                                                echo 'checked';
                                                            } ?> value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" <?php if ($active == 'Yes') {
                                                                echo 'checked';
                                                            } ?> value="Yes">Yes
                        <input type="radio" name="active" <?php if ($active == 'No') {
                                                                echo 'checked';
                                                            } ?> value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>
        <?php

        if (isset($_POST['submit'])) {

            $id             = $_POST['id'];
            $title          = $_POST['title'];
            $current_image  = $_POST['current_image'];
            $featured       = $_POST['featured'];
            $active         = $_POST['active'];

            if (isset($_FILES['image']['name'])) {

                $image_name = $_FILES['image']['name']; //that's new photo

                if ($image_name != "") {

                    $ext = explode('.', $image_name);
                    $ext = end($ext);

                    $image_name = "Food_Category_" . rand(000, 99) . '.' . $ext;  // Send to database


                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);


                    if ($upload == false) {
                        $_SESSION['upload_image'] = "<div class='error'>Failed to upload Image</div>";
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        die();
                    }


                    if ($current_image != "") { // the previews image not empty

                        $remove_path = "../images/category/" . $current_image;

                        $remove = unlink($remove_path);

                        if ($remove == false) {

                            $_SESSION['remove_image'] = '<div class="error">Failed to remove Image</div>';
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $sql2 = "UPDATE tbl_category 
                    SET 
                        title    = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active   = '$active'
                    WHERE id = $id";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['update'] = "<div class='success'>Update Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {

                $_SESSION['update'] = "<div class='error'>Failed to Update  .</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }


        ?>


    </div>
</div>




























<?php include 'partials/footer.php' ?>