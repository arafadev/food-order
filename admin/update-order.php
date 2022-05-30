<?php include 'partials/menu.php' ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update oreder</h1> <br><br>

        <?php

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_order where id = $id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count == 1) {

                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customers_name = $row['customers_name'];
                $customers_content = $row['customers_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-order.php');
        }

        ?>
        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>Food Name</td>
                    <td><?php echo $food ?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>$<?php echo $price ?></td>
                </tr>
                <tr>
                    <td>QTY</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == 'Ordered') {
                                        echo "selected";
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == 'On Delivery') {
                                        echo "selected";
                                    } ?> value="On Delivery">On delivery</option>
                            <option <?php if ($status == 'Delivered') {
                                        echo "selected";
                                    } ?> value="Delivered">Delivered</option>
                            <option <?php if ($status == 'Cancelled') {
                                        echo "selected";
                                    } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php $customers_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php $customers_content ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php $customer_email ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customers_address" cols="30" rows="5"><?php $customer_address ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" class="btn-secondary" value="update order">
                    </td>
                </tr>
            </table>



        </form>


    </div>
</div>

<?php include 'partials/footer.php' ?>