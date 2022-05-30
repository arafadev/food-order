<?php include 'partials/menu.php'; ?>
<!-- Start Content -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br /><br /><br />
        <?php

        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        ?>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>
    </div>
    <div class="clearfix"></div>

</div>
<!-- End Content-->
<?php include('partials/footer.php') ?>