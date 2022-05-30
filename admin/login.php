<?php include '../config/constant.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login text-center">
        <h1>Login</h1><br><br>
        <?php

        if(isset($_SESSION['user'])){

            header('location:index.php');
                
        }


        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }



        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="text-center">
            <br>
            <label for="user">Username: </label>
            <input id="user" type="text" name="username" placeholder="Enter Your Username"><br><br>
            <label for="pass">Password</label>
            <input type="password" id="pass" name="password" placeholder="Enter your password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
        </form>

    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {

        $_SESSION['login'] = "<div class='success'>Login Successfully</div>";
        $_SESSION['user'] = $username;
        header('location:' . SITEURL . 'admin/index.php');
    } else {
        $_SESSION['error'] = "<div class='error text-center'>Username or password did not math</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}



?>