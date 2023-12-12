<div class="row my-4">
    <div class="col-12">
        <div class=" text-right d-flex flex-column justify-content-center mb-3">
            <a href="index.php?page=konsumen-add&action=add" class="btn btn-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Tambah Konsumen</a>
        </div>
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="tableKonsumen">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Konsumen</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Total Pembayaran</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Rentang Pembelian</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT konsumen.id AS id, konsumen.name AS name, SUM(transaksi.total) AS total, MIN(transaksi.tanggal) AS rentangTanggalMin, MAX(transaksi.tanggal) as rentangTanggalMax, konsumen.created_at FROM konsumen LEFT JOIN transaksi ON konsumen.id = transaksi.konsumen_id GROUP BY konsumen.id ORDER BY konsumen.id DESC;";
                        $execute = $konek->query($query);
                        $key = 1;
                        foreach ($execute as  $row) {
                        ?>
                            <tr>
                                <td class="text-sm text-center text-secondary mb-0">
                                    <?php echo $key++; ?>
                                </td>
                                <td>
                                    <p class="text-sm text-center text-secondary mb-0">
                                        <?php echo $row['name']; ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm text-center text-secondary mb-0">
                                        <?php
                                        if ($row['total'] == null) {
                                            echo 'Rp. 0';
                                        } else {
                                            echo 'Rp. ' . number_format($row['total'], 0, ',', '.');
                                        }

                                        ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm text-center text-secondary mb-0">
                                        <?php
                                        if ($row['rentangTanggalMin'] == null || $row['rentangTanggalMax'] == null) {
                                            echo 'Belum ada pembelian';
                                        } else {
                                            echo date('d F Y', strtotime($row['rentangTanggalMin'])) . ' - ' . date('d F Y', strtotime($row['rentangTanggalMax']));
                                        }

                                        ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm text-center text-secondary mb-0">
                                        <?php echo date('d F Y', strtotime($row['created_at'])); ?>
                                    </p>
                                </td>
                                <td class="text-sm">
                                    <a href="index.php?page=konsumen-edit&id=<?php echo $row['id'] ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit Konsumen" class="p-2">
                                        <i class="fas fa-edit text-secondary" aria-hidden="true"></i>
                                    </a>
                                    <a href="proses/prosesHapus.php/?op=konsumen&id=<?php echo $row['id'] ?>" onclick="return confirm('Anda yakin ingin menghapus konsumen ini?');" data-bs-toggle="tooltip" data-bs-original-title="Hapus Konsumen" class="p-2">
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
        $('#tableKonsumen').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
        });
    });
</script>