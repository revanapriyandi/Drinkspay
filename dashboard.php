<?php
require './connect.php';

if (empty($_SESSION['user'])) {
    header('location:login.php');
}

$user = $_SESSION['user'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'dashboard';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/logo.png">
    <link rel="icon" type="image/png" href="./assets/img/logo.png">

    <meta name="description" content="Drink's Pay adalah aplikasi kasir untuk usaha minuman.">
    <meta name="author" content="Drink's Pay">
    <title>
        Drink's Pay - <?php echo ucfirst($page); ?>
    </title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/argon-dashboard.min.css" rel="stylesheet" />
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <script src="assets/vendor/jQuery-3.7.0/jquery-3.7.0.min.js"></script>

</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 position-absolute w-100" style="background-image: url('./assets/img/bg-auth.jpg'); background-position: top;"></div>
    <?php
    if ($page != 'order') {
        include 'sidebar.php';
    } ?>
    <main class="main-content position-relative border-radius-lg ">
        <?php
        $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '';
        if ($page != 'order') {
            include 'navbar.php';
        }
        ?>
        <div class="container-fluid py-4">

            <?php include "page.php"; ?>

            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                Drink's Pay
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
    </main>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>