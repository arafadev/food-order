<?php include 'partials/menu.php' ?>;

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1><br><br>
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
                    <td> <input type="text" name="title" placeholder="Title of the food"> </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td> <textarea type="text" cols="30" rows="5" name="description" placeholder="Enter Description"> </textarea>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td> <input type="number" name="price"> </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td> <input type="file" name="image"> </td>
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
                                    $id = $row['id'];
                                    $title = $row['title']; ?>

                                    <option value="<?php echo $id ?>"><?php echo $title ?></option>

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
                    <td>Featured</td>
                    <td>
                        <label for="yesf">Yes</label>
                        <input id="yesf" type="radio" name="featured" value="Yes">
                        <label for="nof">No</label>
                        <input id="nof" type="radio" name="featured" value="No">
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <label for="yes">Yes</label>
                        <input id="yes" type="radio" name="active" value="Yes">
                        <label for="no">No</label>
                        <input id="no" type="radio" name="active" value="No">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>




        <?php

        if (isset($_POST['submit'])) {

            $title =  $_POST['title'];
            $description =  $_POST['description'];
            $price =  $_POST['price'];
            $category_id =  $_POST['category'];


            if (isset($_POST['featured'])) {

                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            if (isset($_FILES['image']['name'])) {

                $image_name = $_FILES['image']['name'];

                if ($image_name != "") { // if image is not empty

                    $ex = explode('.', $image_name);
                    $ex = end($ex);

                    $image_name = "food-Name-" . rand(000, 9999) . '.' . $ex; //new image name, that's sent into database and food file

                    $src = $_FILES['image']['tmp_name'];

                    $newSrc = "../images/food/" . $image_name;

                    $upload = move_uploaded_file($src, $newSrc);

                    if ($upload == false) {
                        $_SESSION['upload'] = '<div class="error">Failed to upload Image</div>';
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image_name = ""; // Setting default value as blank
            }

            $sql2 = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active)
                    VALUES ('$title', '$description', $price, '$image_name', $category_id, '$featured', '$active' )";
          

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true){
                $_SESSION['add'] = '<div class="success">Food Added Successfully</div>';
                header('location:'.SITEURL.'admin/manage-food.php');
            }else{
                
                $_SESSION['add'] = '<div class="error">Failed Added Food</div>';
                header('location:'.SITEURL.'admin/manage-food.php');
            }


        }   



        ?>






    </div>
</div>

<?php include 'partials/footer.php' ?>