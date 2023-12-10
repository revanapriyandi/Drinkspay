<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $op = isset($_POST['op']) ? $_POST['op'] : null;

    switch ($op) {
        case 'user':
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $password_confirmation = isset($_POST['password_confirmation']) ? $_POST['password_confirmation'] : '';
            $role = isset($_POST['role']) ? $_POST['role'] : 'kasir';

            if (empty($name) || empty($email) || empty($password) || empty($password_confirmation) || empty($role)) {
                echo "<script>alert('Semua field harus diisi!');window.location.href='../index.php?page=user-edit&id=$id&op=edit-user';</script>";
                exit;
            }

            if ($password != $password_confirmation) {
                echo "<script>alert('Password tidak sama!');window.location.href='../index.php?page=user-edit&id=$id&op=edit-user';</script>";
                exit;
            }

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $cek = "SELECT email FROM users WHERE email='$email'";
            $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password_hash', '$role')";
            mysqli_query($konek, $cek);
            mysqli_query($konek, $query);
            echo "<script>alert('Data berhasil ditambahkan!');window.location.href='../index.php?page=user';</script>";
            break;

        case 'kategori':
            $name = isset($_POST['name']) ? $_POST['name'] : '';

            if (empty($name)) {
                echo "<script>alert('Field nama kategori harus diisi!');window.location.href='../index.php?page=kategori';</script>";
                exit;
            }

            $cek = "SELECT name FROM kategori WHERE name='$name'";
            $query = "INSERT INTO kategori (name) VALUES ('$name')";
            mysqli_query($konek, $cek);
            mysqli_query($konek, $query);
            echo "<script>alert('Data berhasil ditambahkan!');window.location.href='../index.php?page=kategori';</script>";
            break;

        case 'konsumen':
            $name = isset($_POST['name']) ? $_POST['name'] : '';

            if (empty($name)) {
                echo "<script>alert('Field nama konsumen harus diisi!');window.location.href='../index.php?page=konsumen';</script>";
                exit;
            }

            $created_at = date('Y-m-d H:i:s');
            $cek = "SELECT name FROM konsumen WHERE name='$name'";
            $query = "INSERT INTO konsumen (name, created_at) VALUES ('$name', '$created_at')";
            mysqli_query($konek, $cek);
            mysqli_query($konek, $query);
            echo "<script>alert('Data berhasil ditambahkan!');window.location.href='../index.php?page=konsumen';</script>";
            break;

        case 'produk':
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $kode = isset($_POST['kode']) ? $_POST['kode'] : '';
            $kategori_id = isset($_POST['kategori_id']) ? intval($_POST['kategori_id']) : 0;
            $harga = isset($_POST['harga']) ? $_POST['harga'] : '';
            $stok = isset($_POST['stok']) ? intval($_POST['stok']) : 0;
            $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
            $tmp = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
            $path = "../assets/img/" . $image;

            if (empty($name) || empty($kategori_id) || empty($harga) || empty($stok) || empty($kode)) {
                echo "<script>alert('Semua field harus diisi!');window.location.href='../index.php?page=produk';</script>";
                exit;
            }

            $cek = "SELECT name FROM produk WHERE name='$name'";
            $query = "INSERT INTO produk (name, kode, kategori_id, harga, stok, image) VALUES ('$name', '$kode', '$kategori_id', '$harga', '$stok', '$image')";
            mysqli_query($konek, $cek);
            mysqli_query($konek, $query);
            move_uploaded_file($tmp, $path);
            echo "<script>alert('Data berhasil ditambahkan!');window.location.href='../index.php?page=produk';</script>";
            break;

        case 'order':
            session_start();
            $kode = isset($_POST['kode']) ? $_POST['kode'] : '';
            $jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 0;
            $pelanggan = isset($_POST['pelanggan']) ? intval($_POST['pelanggan']) : 0;
            $tanggal = date('Y-m-d H:i:s');
            $kasir = isset($_POST['kasir_id']) ? intval($_POST['kasir_id']) : '';
            $invoice = isset($_POST['invoice']) ? $_POST['invoice'] : '';

            // Validasi input
            if (empty($kode) || $jumlah <= 0 || $pelanggan <= 0 || empty($tanggal) || empty($kasir) || empty($invoice)) {
                echo "<script>alert('Semua field harus diisi dengan benar!');window.location.href='../index.php?page=order';</script>";
                exit;
            }

            // Periksa apakah produk dengan kode tersebut ada
            $cek = "SELECT * FROM produk WHERE kode='$kode'";
            $produk = mysqli_query($konek, $cek);
            $row = mysqli_fetch_assoc($produk);

            if (empty($row)) {
                echo "<script>alert('Produk tidak ditemukan!');window.location.href='../index.php?page=order';</script>";
                exit;
            }

            // Periksa stok produk
            if ($jumlah > $row['stok']) {
                echo "<script>alert('Stok tidak mencukupi!');window.location.href='../index.php?page=order';</script>";
                exit;
            }

            // Hitung total dan sisipkan pesanan ke database
            $total = $row['harga'] * $jumlah;
            $produk_id = $row['id'];
            $status = 'pending';

            $query = "INSERT INTO transaksi (invoice, tanggal, kasir_id, konsumen_id, produk_id, jumlah, total, status) VALUES ('$invoice', '$tanggal','$kasir', '$pelanggan', '$produk_id', '$jumlah', '$total', '$status')";
            mysqli_query($konek, $query);

            // Kurangi stok produk
            $updateStok = "UPDATE produk SET stok = stok - $jumlah WHERE id = $produk_id";
            mysqli_query($konek, $updateStok);

            echo "<script>alert('Data berhasil ditambahkan!');window.location.href='../index.php?page=order';</script>";
            break;
    }
}
