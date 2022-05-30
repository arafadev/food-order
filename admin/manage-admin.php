<?php include 'partials/menu.php' ?>


<!-- Start Content -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br /><br /><br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {

            echo  $_SESSION['delete'];

            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {

            echo  $_SESSION['update'];

            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user_not_found'])) {

            echo  $_SESSION['user_not_found'];

            unset($_SESSION['user_not_found']);
        }
        if (isset($_SESSION['user_found'])) {

            echo  $_SESSION['user_found'];

            unset($_SESSION['user_found']);
        }
        if (isset($_SESSION['pwd_not_math'])) {

            echo  $_SESSION['pwd_not_math'];

            unset($_SESSION['pwd_not_math']);
        }


        if (isset($_SESSION['change_pwd'])) {
            echo $_SESSION['change_pwd'];
            unset($_SESSION['change_pwd']);
        }


        ?> <br />



        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /> <br /> <br />
        <table class="tbl-full">

            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th> Image</th>
                <th>Featured</th>
          
            </tr>

            <?php

            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {

                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count  > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                        $password = $rows['password']; ?>

                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id ?>" class="btn-primary">Change-password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn-danger">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                }
            } else { ?>
                <td colspan="6">
                    <div class="error">Not Categories Added</div>
                </td>

            <?php } ?>
        </table>
    </div>
</div>

<!-- End Content-->



<?php include 'partials/footer.php' ?>