<?php include 'partials/menu.php' ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br />
        <br />
        <!-- Button to add admin -->
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <br />
        <br />
        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }


        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }


        if (isset($_SESSION['unauthorized'])) {
            echo $_SESSION['unauthorized'];
            unset($_SESSION['unauthorized']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <table class="tbl-full text-center">
            <tr>
                <th class="text-center">S.N.</th>
                <th class="text-center">Title</th>
                <th class="text-center"> Price</th>
                <th class="text-center">Image</th>
                <th class="text-center">Featured</th>
                <th class="text-center">Active</th>
                <th class="text-center"> Action</th>
            </tr>
            <?php

            $sql = "SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            $sn = 0;
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active']; ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title ?></td>
                        <td><?php echo $price ?></td>
                        <td>
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image Not Added.</div>";
                            } else { ?>
                                <img src="../images/food/<?php echo $image_name ?>" alt="Food Image" width="150px">
                            <?php }
                            ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="update-food.php?id=<?php echo $id ?>" class="btn-secondary">Update Food</a>
                            <a href="delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>
            <?php }
            } else {
                echo "<tr colspan = '7' class='error'>Food not Added yet</tr>";
            }  ?>

        </table>
    </div>
</div>
<?php include 'partials/footer.php' ?>