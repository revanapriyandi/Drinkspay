<?php
session_start();
require '../connect.php';

$id = @$_GET['id'];
$op = @$_GET['op'];

function deleteData($table, $id, $konek)
{
    $query = "DELETE FROM $table WHERE id=?";
    $stmt = $konek->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Berhasil dihapus!");history.go(-1)</script>';
    } else {
        echo '<script>alert("Gagal menghapus data.");history.go(-1)</script>';
    }
}

switch ($op) {
    case 'user':
        $user = $_SESSION['user'];
        if ($id == $user['id']) {
            echo "<script>alert('Tidak dapat menghapus akun sendiri!');history.go(-1);</script>";
        } else {
            deleteData('users', $id,  $konek);
        }
        break;
    case 'kategori':
        deleteData('kategori', $id,  $konek);
        break;
    case 'konsumen':
        deleteData('konsumen', $id,  $konek);
        break;
    case 'produk':
        deleteData('produk', $id,  $konek);
        break;
    case 'produkOrder':
        deleteData('transaksi', $id,  $konek);
        break;
    case 'transaksi':
        deleteData('transaksi', $id,  $konek);
        break;
    default:
        echo "<script>alert('Tidak ada data yang dihapus!');history.go(-1);</script>";
        break;
}
