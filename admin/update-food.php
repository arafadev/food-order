<?php include 'partials/menu.php' ?>



<?php

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql2 = "SELECT * FROM tbl_food WHERE id = $id";

    $res2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_assoc($res2);

    $title              = $row2['title'];
    $description        = $row2['description'];
    $price              = $row2['price'];
    $current_image      = $row2['image_name'];
    $current_category   = $row2['category_id'];
    $featured           = $row2['featured'];
    $active             = $row2['active'];
} else {
    header('location:' . SITEURL . 'admin/manage-food.php');
}

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1><br><br>
        <?php

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td> <input type="text" name="title" value="<?php echo $title ?>"> </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td> <textarea type="text" cols="30" rows="5" name="description"><?php echo $description ?> </textarea>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td> <input type="number" name="price" value="<?php echo $price ?>"> </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            echo "<div class='error'>Image not available</div>";
                        } else { ?>

                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image ?>" alt="" width="150">


                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php

                            $sql = "SELECT * FROM `tbl_category` WHERE active = 'Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $title = $row['title'];
                            ?>

                                    <option <?php if ($current_category == $category_id) {
                                                echo 'selected';
                                            } ?> value="<?php echo $category_id ?>"><?php echo $title ?></option>

                                <?php }
                            } else { ?>

                                <option value="0">No Category Found</option>
                            <?php
                            }



                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td> <input type="file" name="image"> </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <label for="yesf">Yes</label>
                        <input id="yesf" type="radio" name="featured" <?php

                                                                        if ($featured == 'Yes') {
                                                                            echo 'checked';
                                                                        }

                                                                        ?> value="Yes">
                        <label for="nof">No</label>
                        <input id="nof" type="radio" name="featured" <?php if ($featured == 'No') {
                                                                            echo 'checked';
                                                                        } ?> value="No">
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <label for="yes">Yes</label>
                        <input id="yes" type="radio" name="active" <?php if ($active == "Yes") {
                                                                        echo "checked";
                                                                    } ?> value="Yes">
                        <label for="no">No</label>
                        <input id="no" type="radio" name="active" <?php if ($active == "No") {
                                                                        echo "checked";
                                                                    } ?> value="No">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="current_image" value="<?php $current_image ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>




        <?php

        if (isset($_POST['submit'])) {

            $id =  $_POST['id'];
            $title = $_POST['title'];
            $description =  $_POST['description'];
            $price =  $_POST['price'];
            $current_image = $_POST['current_image'];
            $category =  $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];



            if (isset($_FILES['image']['name'])) { // that's New Image

                $image_name = $_FILES['image']['name'];

                if ($image_name != "") { // if image is not empty move that image to folder food

                    $ex = explode('.', $image_name);
                    $ex = end($ex);

                    $image_name = "food-Name-" . rand(000, 9999) . '.' . $ex; //new image name, that's sent into database and food file

                    $src = $_FILES['image']['tmp_name'];

                    $newSrc = "../images/food/" . $image_name;

                    $upload = move_uploaded_file($src, $newSrc);

                    // before delete current image, check if new image is uploaded or not.
                    if ($upload == false) {
                        $_SESSION['upload'] = '<div class="error">Failed to upload new Image</div>';
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        die();
                    }

                    if ($current_image != "") { // if the old image is found

                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        if ($remove == false) {
                            $_SESSION['remove-failed'] = "<div class='error'> Failed to remove current image</div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image; // Setting default value as blank
            }

            $sql3 = "UPDATE tbl_food 
                SET
                    title          =  '$title',
                    description    =  '$description',
                    price         =   $price,
                    image_name    =  '$image_name',
                    category_id    =  '$category' ,
                    featured    =  '$featured' ,
                    active    =  '$active' ,
                WHERE
                    id = $id 
            ";


            $res3 = mysqli_query($conn, $sql3);

            if ($res3 == true) {
                $_SESSION['update'] = '<div class="success">Food Updated Successfully</div>';
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {

                $_SESSION['update'] = '<div class="error">Failed to update food</div>';
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }



        ?>






    </div>
</div>

<?php include 'partials/footer.php' ?>