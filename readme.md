# Aplikasi Toko Minuman dengan PHP Native

Selamat datang di Aplikasi Toko Minuman! Aplikasi ini dibangun dengan menggunakan PHP Native untuk memudahkan pengelolaan toko minuman Anda. Berikut adalah langkah-langkah instalasi dan penjelasan singkat tentang cara menggunakan aplikasi ini.

## Instalasi

1. **Clone Repository**

   - Unzip folder atau clone dari `([https://github.com/revanapriyandi/toko_minuman.git](https://github.com/revanapriyandi/Drinkspay.git))`
   - Pindahkan folder TokoMinuman yang ada file php ke dalam file htdocs atau www web server anda.

2. **Buat Database**

   - Buat database baru di MySQL.

   ```
   mysql -u root -p < create database toko_minuman;
   ```

   - Impor skema database dari file `toko_minuman.sql` yang ada di dalam folder `SQL`.
     ```
     mysql -u root -p < source toko_minuman.sql;
     ```

3. **Konfigurasi Database**

   - Buka file `connect.php` di root directori.
   - Sesuaikan konfigurasi database dengan informasi yang sesuai.
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'username');
     define('DB_PASSWORD', 'password');
     define('DB_NAME', 'nama_database');
     ```

4. **Jalankan Aplikasi**
   - Buka aplikasi di web browser dengan alamat [http://localhost/toko-minuman](http://localhost/toko-minuman).

## Penggunaan Aplikasi

1. **Login**

   - Login ke aplikasi menggunakan email dan password yang telah ditentukan.
   - Login awal dapat menggunakan `owner@gmail.com` dan password `admin` untuk role owner.
   - Password di ecrypt dengan bcrypt.

2. **Register**

   - Register ke aplikasi, inputan yang diperlukan `name`, `email`,`password`, dan `password confirmation`.
   - Pengguna yang mendaftar akan otomatis mendapatkan role `kasir`. dan dapat di ubah oleh `owner` di edit user.
   - Password di ecrypt dengan bcrypt.

3. **Owner**

   - Owner memiliki akses ke semua fitur di aplikasi `(User, Kategori, Produk, Laporan Penjualan, Konsumen dan Order)`.

4. **Kasir**

   - Kasir hanya memiliki akses ke menu `(Konsumen dan Order)`.

5. **Kelola Produk**

   - Tambahkan, edit, atau hapus produk di halaman "Kelola Produk".
   - Setiap produk memiliki stok masing-masing.
   - Terdapat tombol edit stok di atas table, untuk mengedit stok produk yang di select / di centang.

6. **Kelola Kategori**

   - Atur kategori produk di halaman "Kelola Kategori".

7. **Transaksi Penjualan**

   - Catat transaksi penjualan di halaman "Transaksi".
   - Melakukan penjualan produk minuman oleh kasir.

8. **Laporan Penjualan**
   - Lihat laporan penjualan harian, bulanan, atau tahunan di halaman "Laporan".

## Library yang digunakan

1. **DataTables**

   DataTables adalah plugin jQuery yang digunakan untuk membuat tampilan tabel interaktif. Dalam aplikasi ini, DataTables digunakan untuk meningkatkan pengalaman pengguna pada halaman "Laporan" dan "Transaksi". Fitur pencarian, pengurutan, dan paginasi yang disediakan oleh DataTables membantu pengguna untuk dengan mudah menjelajahi dan menganalisis data.

   **Situs Resmi:** [DataTables](https://datatables.net/)

2. **Chart.js**

   Chart.js adalah library JavaScript untuk membuat grafik interaktif. Digunakan di halaman "Laporan", Chart.js membantu dalam merepresentasikan data penjualan dengan grafik batang yang informatif. Pengguna dapat dengan cepat melihat tren penjualan harian, bulanan, dan tahunan.

   **Situs Resmi:** [Chart.js](https://www.chartjs.org/)

3. **Perfect Scrollbar**

   Perfect Scrollbar adalah library JavaScript untuk membuat scrollbar yang responsif dan mudah disesuaikan. Digunakan di berbagai bagian aplikasi, Perfect Scrollbar meningkatkan tampilan dan interaksi pada daftar produk, kategori, dan riwayat transaksi.

   **Situs Resmi:** [Perfect Scrollbar](https://github.com/mdbootstrap/perfect-scrollbar)

4. **Bootstrap**

   Bootstrap adalah framework front-end yang digunakan untuk membangun tata letak responsif dan gaya yang konsisten. Dalam aplikasi ini, Bootstrap digunakan untuk mempercepat pengembangan dan memastikan tampilan yang baik di berbagai perangkat.

   **Situs Resmi:** [Bootstrap](https://getbootstrap.com/)

## Catatan Penting

- Pastikan web server Anda mendukung PHP dan telah dihubungkan dengan MySQL.
- Pastikan bahwa ekstensi `mysqli` untuk PHP telah diaktifkan.
- Backup database secara berkala untuk mencegah kehilangan data.
- Jangan lupa untuk mengamankan aplikasi ini dengan pengaturan hak akses dan perlindungan password.

Selamat menggunakan Aplikasi Toko Minuman! Jika Anda memiliki pertanyaan atau masalah, jangan ragu untuk menghubungi Developer. Terima kasih!
