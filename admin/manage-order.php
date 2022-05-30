<?php include 'partials/menu.php' ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br />
        <br />
        <br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th> Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order date</th>
                <th>Status</th>
                <th>Customers Name</th>
                <th>content</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php


            $sql = "SELECT * FROM tbl_order order by id desc";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {

                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customers_name = $row['customers_name'];
                    $customer_email = $row['customer_email'];
                    $customers_contact = $row['customers_contact'];
                    $customer_address = $row['customer_address'];
            ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $food ?></td>
                        <td><?php echo $price ?></td>
                        <td><?php echo $qty ?></td>
                        <td><?php echo $total ?></td>
                        <td><?php echo $order_date ?></td>
                        <td><?php echo $status ?></td>
                        <td><?php echo $customers_name ?></td>
                        <td><?php echo $customers_contact ?></td>
                        <td><?php echo $customer_email ?></td>
                        <td><?php echo $customer_address ?></td>
                        <td>
                            <a href="update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>


            <?php  }
            } else {
                echo "<tr><td colspan='12'>orders not available</td></tr>";
            }



            ?>

        </table>
    </div>
</div>
<?php include 'partials/footer.php' ?>