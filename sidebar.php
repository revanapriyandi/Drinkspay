<?php
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '';
?>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <img src="assets/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 h6 font-weight-bold">Drink's Pay</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo $page === 'dashboard' || !$page ? 'active' : '' ?>" href="index.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Beranda</span>
                </a>
            </li>
            <?php
            $user = $_SESSION['user'];

            if ($user['role'] === 'owner') {
            ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'user' ? 'active' : '' ?>" href="index.php?page=user">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Pengguna
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'kategori' ? 'active' : '' ?>" href="index.php?page=kategori">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-list text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Kategori
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'produk' ? 'active' : '' ?>" href="index.php?page=produk">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-layer-group text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Produk
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo $page == 'transaksi' ? 'active' : '' ?>" href="index.php?page=transaksi">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-money-check text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">
                            Laporan Penjualan
                        </span>
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $page == 'konsumen' ? 'active' : '' ?>" href="index.php?page=konsumen">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user-tag text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">
                        Konsumen
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $page == 'order' ? 'active' : '' ?>" href="index.php?page=order">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-money text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">
                        Transaksi Penjualan
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 my-3">
        <a class="btn btn-danger btn-sm mb-0 w-100" href="logout.php" type="button">Keluar</a>
    </div>
</aside>