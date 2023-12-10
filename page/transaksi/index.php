<?php
$query =  "SELECT t.id, t.invoice, t.tanggal, t.jumlah, t.total, t.status, p.name, p.harga FROM transaksi t JOIN produk p ON t.produk_id = p.id ORDER BY t.id DESC";

if (isset($_POST['start']) && isset($_POST['end'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Validasi format tanggal atau gunakan fungsi date untuk mengonversi format tanggal yang diinput
    $start = date('Y-m-d', strtotime($_POST['start']));
    $end = date('Y-m-d', strtotime($_POST['end']));

    $query =  "SELECT t.id, t.invoice, t.tanggal, t.jumlah, t.total, t.status, p.name, p.harga FROM transaksi t JOIN produk p ON t.produk_id = p.id WHERE t.tanggal BETWEEN '$start' AND '$end' ORDER BY t.id DESC";
}

$execute = $konek->query($query);


?>
<div class="row my-4">
    <div class="card">
        <div class="card-body">
            <div class=" text-right d-flex flex-column justify-content-center mb-3">
                <a href="index.php?page=order" class="btn btn-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Tambah
                    Transaksi</a>
            </div>
            <h5 class="text-center">Data Transaksi</h5>
            <hr>
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="date" class="form-control" name="start" id="start" required>
                    </div>
                    <div class="col-md-6">
                        <input type="date" class="form-control" name="end" id="end" required>
                        <button type="submit" class="btn btn-primary mt-3 float-end" id="filter">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-12 mt-3">
        <div class="card card-body">

            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="tableKonsumen">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                No</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                Invoice</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                Tanggal</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                Produk</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                Jumlah</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                Total</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $key = 1;
                        foreach ($execute as  $row) {
                        ?>
                            <tr>
                                <td class="text-sm text-center text-secondary mb-0">
                                    <?php echo $key++; ?>
                                </td>
                                <td>
                                    <p class="text-sm text-center text-secondary mb-0">
                                        <?php echo $row['invoice']; ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm text-center text-secondary mb-0">
                                        <?php echo date('d F Y', strtotime($row['tanggal'])); ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm text-center text-secondary mb-0">
                                        <?php echo $row['name']; ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm text-center text-secondary mb-0">
                                        <?php echo $row['jumlah']; ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm text-center text-secondary mb-0">
                                        <?php echo 'Rp. ' . number_format($row['total'], 0, ',', '.'); ?>
                                    </p>
                                </td>
                                <td>
                                    <?php
                                    if ($row['status'] == 'pending') {
                                        echo '<span class="badge rounded-pill text-bg-warning text-white">Belum Selesai</span>';
                                    } else {
                                        echo '<span class="badge rounded-pill text-bg-success text-white">Selesai</span>';
                                    }
                                    ?>
                                </td>

                                <td class="text-sm">
                                    <a href="proses/prosesHapus.php/?op=transaksi&id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus transaksi ini?');" data-bs-toggle="tooltip" data-bs-original-title="Hapus Transaksi" class="p-2">
                                        <i class="fas fa-trash text-danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tableKonsumen').DataTable();
    });
</script>