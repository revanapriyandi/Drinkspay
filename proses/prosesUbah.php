<?php
require '../connect.php';
require '../class/Controller.php';

$crud = new Controller($konek);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = @$_POST['id'];
    $op = @$_POST['op'];
}

switch ($op) {
    case 'user':
        $name = @$_POST['name'];
        $email = @$_POST['email'];
        $password = @$_POST['password'];
        $password_confirmation = @$_POST['password_confirmation'];
        $role = @$_POST['role'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        if ($password != '' || $password_confirmation != '') {
            if ($password != $password_confirmation) {
                $redirect_url = "../index.php?page=user-edit&id=$id&op=edit-user";
                $message = 'Password tidak sama!';
            }

            $query = "UPDATE users SET name=?, email=?, password=?, role=? WHERE id=?";
            $stmt = $konek->prepare($query);
            $stmt->bind_param("ssssi", $name, $email, $password_hash, $role, $id);
        } else {
            $query = "UPDATE users SET name=?, email=?, role=? WHERE id=?";
            $stmt = $konek->prepare($query);
            $stmt->bind_param("sssi", $name, $email, $role, $id);
        }

        if ($stmt->execute()) {
            echo "<script>alert('Berhasil memperbarui data pengguna!');window.location.href='../index.php?page=user';</script>";
        } else {
            $redirect_url = "../index.php?page=user-edit&id=$id&op=edit-user";
            $message = 'Gagal memperbarui data pengguna.';
        }
        break;

    case 'kategori':
        $name = @$_POST['name'];

        $query = "UPDATE kategori SET name=? WHERE id=?";
        $stmt = $konek->prepare($query);
        $stmt->bind_param("si", $name, $id);

        if ($stmt->execute()) {
            $redirect_url = "../index.php?page=kategori";
        } else {
            $redirect_url = "../index.php?page=kategori-edit&id=$id";
            $message = 'Gagal memperbarui kategori.';
        }
        break;

    case 'konsumen':
        $name = @$_POST['name'];

        $query = "UPDATE konsumen SET name=? WHERE id=?";
        $stmt = $konek->prepare($query);
        $stmt->bind_param("si", $name, $id);

        if ($stmt->execute()) {
            $redirect_url = "../index.php?page=konsumen";
        } else {
            $redirect_url = "../index.php?page=konsumen-edit&id=$id";
            $message = 'Gagal memperbarui data konsumen.';
        }
        break;

    case 'produk':
        $name = @$_POST['name'];
        $kode = @$_POST['kode'];
        $kategori_id = intval(@$_POST['kategori_id']);
        $harga = @$_POST['harga'];
        $stok =  intval(@$_POST['stok']);
        $image = @$_FILES['image']['name'];
        $updated_at = date('Y-m-d H:i:s');

        if ($image == '') {
            $query = "UPDATE produk SET name=?, kode=?, kategori_id=?, harga=?, stok=?, updated_at=? WHERE id=?";
            $stmt = $konek->prepare($query);
            $stmt->bind_param("ssisisi", $name, $kode, $kategori_id, $harga, $stok, $updated_at, $id);
        } else {
            $tmp = @$_FILES['image']['tmp_name'];
            $path = "../assets/img/" . $image;

            $query = "UPDATE produk SET name=?, kode=?, kategori_id=?, harga=?, stok=?, image=?, updated_at=? WHERE id=?";
            $stmt = $konek->prepare($query);
            $stmt->bind_param("ssisissi", $name, $kode, $kategori_id, $harga, $stok, $image, $updated_at, $id);

            move_uploaded_file($tmp, $path);
        }

        if ($stmt->execute()) {
            $redirect_url = "../index.php?page=produk";
        } else {
            $redirect_url = "../index.php?page=produk-edit&id=$id";
            $message = 'Gagal memperbarui produk.';
        }
        break;

    case 'stok':
        $produk_ids = isset($_POST['produk_id']) ? explode(',', $_POST['produk_id']) : [];

        if (empty($produk_ids)) {
            echo "<script>alert('Pilih setidaknya satu produk untuk merubah stok.');window.location.href='../index.php?page=produk';</script>";
            exit;
        }

        $stok = isset($_POST['stok']) ? intval($_POST['stok']) : 0;

        if ($stok <= 0) {
            echo "<script>alert('Stok harus bernilai positif.');window.location.href='../index.php?page=produk';</script>";
            exit;
        }

        foreach ($produk_ids as $id) {
            $id = intval($id);
            $query = "UPDATE produk SET stok=? WHERE id=?";
            $stmt = $konek->prepare($query);
            $stmt->bind_param("ii", $stok, $id);

            $stmt->execute();
        }

        echo "<script>alert('Berhasil merubah stok produk terpilih!');window.location.href='../index.php?page=produk';</script>";
        break;

    case 'bayar':
        $konsumen_id = @$_POST['konsumen_id'];
        $kasir_id = @$_POST['kasir_id'];

        if (!$konsumen_id) {
            echo "<script>alert('Invoice tidak ditemukan!');window.location.href='../index.php?page=transaksi';</script>";
        }

        $query = "UPDATE transaksi SET status='Selesai' WHERE konsumen_id=? AND kasir_id=? AND status='Pending'";
        $stmt = $konek->prepare($query);
        $stmt->bind_param("ii", $konsumen_id, $kasir_id);
        $stmt->execute();

        echo "<script>alert('Transaksi Selesai!');window.location.href='../index.php?page=order';</script>";
}
if (isset($redirect_url)) {
    if (isset($message)) {
        echo "<script>alert('$message');</script>";
    }
    header("location:$redirect_url");
}
