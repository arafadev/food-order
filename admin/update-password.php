<?php include 'partials/menu.php'; ?>



<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Chang Password</h1><br><br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New  password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" class="btn-secondary" value="change password">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>



<?php


if (isset($_POST['submit'])) {


    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password     = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT password FROM tbl_admin WHERE id = $id AND password = '$current_password'";

    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);

    if ($res == true) {

        $count = mysqli_num_rows($res);

        if ($count == 1) {

            if ($new_password == $confirm_password) {
                $sql2 = "UPDATE tbl_admin SET password = '$new_password' WHERE id = $id";
                $res2 = mysqli_query($conn, $sql2);
                if ($res2 == true) {

                    $_SESSION['change_pwd'] = '<div class="success">Password Changed Successfully</div>';
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    $_SESSION['change_pwd'] = '<div class="success">Failed to change Password </div>';
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                $_SESSION['pwd_not_math'] = '<div class="error">Password Not Math</div>';
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            $_SESSION['user_not_found'] = '<div class="error">User Not Found</div>';
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
}



?>




<?php include 'partials/footer.php'; ?>