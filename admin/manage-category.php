<?php include 'partials/menu.php' ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br />
        <br />

        <?php

        if (isset($_SESSION['add'])) {
            echo  $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo  $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['empty'])) {
            echo  $_SESSION['empty'];
            unset($_SESSION['empty']);
        }
        if (isset($_SESSION['remove'])) {
            echo  $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo  $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['non-category-found'])) {
            echo  $_SESSION['non-category-found'];
            unset($_SESSION['non-category-found']);
        }
        if (isset($_SESSION['update'])) {
            echo  $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['upload_image'])) {
            echo  $_SESSION['upload_image'];
            unset($_SESSION['upload_image']);
        }
        if (isset($_SESSION['remove_image'])) {
            echo  $_SESSION['remove_image'];
            unset($_SESSION['remove_image']);
        }
        ?>
        <br />
        <br />
        <!-- Button to add admin -->
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br />
        <br />

        <table class="tbl-full">
            <?php
            if (!isset($_SESSION['empty'])) { ?>
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th> Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Control</th>
                </tr>
                <?php }


            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {

                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count  > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
                ?>

                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $title ?></td>

                            <td>
                                <?php
                                if (empty($image_name))
                                    echo "No Image";
                                else { ?>
                                    <img src="../images/category/<?php echo $image_name ?>" width="100px">
                                <?php } ?>
                            </td>
                            <td><?php echo $featured ?></td>
                            <td><?php echo $active ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {

                    $_SESSION['empty'] = '<div class="error">No Category Added</div>';

                    // Delete all Images where no category in database.
                    $dir = "../images/category/";
                    array_map('unlink', glob("{$dir}*.*"));
                }
            } ?>


        </table>
    </div>
</div>
<?php include 'partials/footer.php' ?>