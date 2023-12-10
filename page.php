<?php
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '';
switch ($page) {
    case null:
        include 'page/beranda.php';
        break;
    case 'user':
        include 'page/users/index.php';
        break;
    case 'user-add':
        include 'page/users/form.php';
        break;
    case 'user-edit':
        include 'page/users/form.php';
        break;
    case 'kategori':
        include 'page/kategori/index.php';
        break;
    case 'kategori-add':
        include 'page/kategori/form.php';
        break;
    case 'kategori-edit':
        include 'page/kategori/form.php';
        break;
    case 'konsumen':
        include 'page/konsumen/index.php';
        break;
    case 'konsumen-add':
        include 'page/konsumen/form.php';
        break;
    case 'konsumen-edit':
        include 'page/konsumen/form.php';
        break;
    case 'produk':
        include 'page/produk/index.php';
        break;
    case 'produk-add':
        include 'page/produk/form.php';
        break;
    case 'produk-edit':
        include 'page/produk/form.php';
        break;
    case 'transaksi':
        include 'page/transaksi/index.php';
        break;
    case 'order':
        include 'page/transaksi/order.php';
        break;
    default:
        include 'page/404.php';
}
