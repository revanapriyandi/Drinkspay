<?php
$tanggal = date('Y-m-d');
$kasir = $_SESSION['user']['name'];

$konsumen_id = isset($_POST['pelanggan']) ? intval($_POST['pelanggan']) : 0;
$kasir_id = $_SESSION['user']['id'];
$checkInvoice = mysqli_query($konek, "SELECT * FROM transaksi WHERE kasir_id = $kasir_id AND status = 'pending' LIMIT 1");

if (mysqli_num_rows($checkInvoice) > 0) {
    $row = mysqli_fetch_assoc($checkInvoice);
    $invoice = $row['invoice'];
} else {
    $invoice = 'INV' . date('Ymdhis') . '001';
}

$sql = "SELECT konsumen.id, konsumen.name, transaksi.konsumen_id as konsumen_id, SUM(transaksi.total) as total 
        FROM konsumen 
        LEFT JOIN transaksi ON konsumen.id = transaksi.konsumen_id AND transaksi.status = 'pending'
        GROUP BY konsumen.id, konsumen.name";

$result = mysqli_query($konek, $sql);
$options = '';
$total = 0;
$konsumen_id = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total += $row['total'] ? $row['total'] : 0;
    $konsumen_id = $row['konsumen_id'];
    $selected = ($row['konsumen_id'] == $row['id']) ? 'selected' : '';
    $options .= '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
}

?>
<div class="container-fluid">
    <button class="btn btn-dark mb-3 btn-sm mb-0 btn-sm" type="button" onclick="window.location.href='index.php?page=transaksi'">
        <i class="fa fa-arrow-left"></i> Kembali
    </button>

    <form method="POST" id="formOrder" action="./proses/prosesTambah.php">
        <input type="hidden" name="invoice" value="<?php echo $invoice ?>">
        <input type="hidden" value="order" name="op">
        <input type="hidden" value="<?php echo $_SESSION['user']['id'] ?>" name="kasir_id">
        <div class="row ">
            <div class="col-md-4 col-12 ">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="tanggal" class="form-label text-sm">Date</label>
                                </div>
                                <div class="mb-4">
                                    <label for="kasir" class="form-label text-sm">Kasir</label>
                                </div>
                                <div class="mb-4">
                                    <label for="pelanggan" class="form-label text-sm">Pelanggan</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <input type="date" class="form-control   text-sm" readonly name="tanggal" value="<?php echo $tanggal ?>" id="tanggal" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control   text-sm" readonly name="kasir" id="kasir" value="<?php echo $kasir ?>" required>
                                </div>
                                <div class="mb-3">
                                    <select name="pelanggan" id="pelanggan" class="form-control   text-sm" required>
                                        <option value="">Pilih Pelanggan</option>
                                        <?php echo $options; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="tanggal" class="form-label text-sm">Kode Produk</label>
                                </div>
                                <div class="mb-4">
                                    <label for="kasir" class="form-label text-sm">Jumlah</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control text-sm" name="kode" placeholder="Kode Produk" aria-label="Kode Produk" aria-describedby="kode-produk" id="kodeProduk" required>
                                        <button class="btn btn-outline-primary mb-0" type="button" data-bs-toggle="modal" data-bs-target="#modalProduk">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control text-sm" name="jumlah" placeholder="Jumlah" autofocus aria-label="Jumlah" id="jumlah" required>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary btn-sm mb-0 mt-3 btn-sm" type="submit" id="tambah">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4  col-12  text-sm">
                <div class="card bg-dark">
                    <div class="card-body">
                        <div class="card-body d-sm-flex pt-0">
                            <div class="d-flex align-items-center mb-sm-0 mb-4">
                                <h6 class="mb-2 text-white ">Invoice</h6>
                            </div>
                            <span class="text-white ms-auto "><?php echo $invoice ?></span>
                        </div>
                        <div class="mb-2">
                            <h4 class="mb-2 text-white ">Total</h4>
                            <sup class="text-white text-end ">Rp. </sup> <span class="h1 text-white">
                                <?php echo number_format($total, 0, ',', '.') ?>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <div class="row pt-3">
        <div class="card text-sm">
            <div class="card-body">
                <div class="table-responsive table-wrapper-scroll-y" style="overflow: auto;height: 250px;">
                    <table class="table table-striped text-center" id="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php
                            $kasir_id = $_SESSION["user"]["id"];
                            $transaksi = mysqli_query($konek, "SELECT 
                                transaksi.id as id,
                                produk.kode,
                                produk.name as name,
                                produk.harga as harga,
                                transaksi.jumlah as jumlah,
                                transaksi.total as total
                             FROM transaksi 
                                  JOIN produk ON transaksi.produk_id = produk.id 
                                  WHERE transaksi.status = 'pending' AND transaksi.kasir_id = $kasir_id");


                            if (mysqli_num_rows($transaksi) > 0) {
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($transaksi)) {
                                    echo '<tr>
                                    <td>' . $no++ . '</td>
                                    <td>' . $row['kode'] . '</td>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['harga'] . '</td>
                                    <td>' . $row['jumlah'] . '</td>
                                    <td> Rp. ' . number_format($row['total'], 0, ',', '.') . '</td>
                                     <td><a href="proses/prosesHapus.php?op=produkOrder&id=' . $row['id'] . '" onclick="return confirm(\'Anda yakin ingin menghapus produk ini?\');" class="btn btn-outline-danger btn-sm mb-0" type="button" id="hapus">Hapus</a></td>
                                </tr>';
                                }
                            } else {
                                echo '<tr>
                                    <td colspan="7">Tidak ada data</td>
                                </tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <form action="./proses/prosesUbah.php" method="POST">
                        <input type="hidden" name="invoice" value="<?php echo $invoice ?>">
                        <input type="hidden" value="bayar" name="op">
                        <input type="hidden" value="<?php echo $konsumen_id ?>" name="konsumen_id">
                        <input type="hidden" value="<?php echo $kasir_id ?>" name="kasir_id">
                        <button class="btn btn-success btn-md mb-0" type="submit" id="bayar">
                            <i class="fa fa-money"></i> Process Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modalProdukLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProdukLabel">
                    List Produk
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center" id="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php
                            $produk = mysqli_query($konek, "SELECT * FROM produk");

                            if (mysqli_num_rows($produk) > 0) {
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($produk)) {
                                    echo '<tr>
                                    <td>' . $no++ . '</td>
                                    <td>' . $row['kode'] . '</td>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['harga'] . '</td>
                                    <td>' . $row['stok'] . '</td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm mb-0" type="button" data-kode="' . $row['kode'] . '" id="pilihProduk">Pilih</button>
                                    </td>
                                </tr>';
                                }
                            } else {
                                echo '<tr>
                                    <td colspan="7">Tidak ada data</td>
                                </tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#modalProduk').on('click', '#pilihProduk', function() {
            var kode = $(this).data('kode');
            document.getElementById('kodeProduk').value = kode;
            document.getElementById('jumlah').focus();
            $('#modalProduk').modal('hide');
        })
    })
</script>