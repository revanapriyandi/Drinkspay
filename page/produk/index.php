<div class="row my-4">
    <div class="col-12">
        <div class="d-lg-flex mb-3">
            <div>
            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                    <a href="index.php?page=produk-add&action=add" class="btn bg-gradient-dark btn-sm mb-0">+&nbsp; Tambah Produk</a>
                    <button type="button" class="btn btn-warning btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modalStokProduk">
                        Ubah Stok
                    </button>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="tableProduk">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Produk</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stok</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // join produk dan kategori
                        $query = "SELECT 
                        produk.id,
                        produk.name,
                        produk.kode,
                        produk.image,
                        produk.harga,
                        produk.stok,
                        kategori.name AS kategori
                         FROM produk INNER JOIN kategori ON produk.kategori_id = kategori.id ORDER BY produk.id DESC";
                        $execute = $konek->query($query);
                        foreach ($execute as $row) {
                        ?>

                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="form-check my-auto">
                                            <input class="form-check-input" type="checkbox" id="produkCheck" value="<?php echo $row['id']; ?>">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0">
                                        <?php echo $row['kode']; ?>
                                    </p>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="<?php
                                                        if ($row['image'] == '') {
                                                            echo 'https://via.placeholder.com/150';
                                                        } else {
                                                            echo "assets/img/" . $row['image'];
                                                        }
                                                        ?>" class="avatar avatar-sm me-3" alt="avatar image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">
                                                <?php echo $row['name']; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0">
                                        <?php echo $row['stok']; ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0">
                                        <?php echo $row['kategori']; ?>
                                    </p>
                                </td>
                                <td>
                                    <span class="text-dark text-sm">
                                        <?php echo "Rp. " . number_format($row['harga'], 0, ',', '.'); ?>
                                    </span>
                                </td>
                                <td class="text-sm">
                                    <a href="index.php?page=produk-edit&id=<?php echo $row['id'] ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit Produk" class="p-2">
                                        <i class="fas fa-edit text-secondary" aria-hidden="true"></i>
                                    </a>
                                    <a href="proses/prosesHapus.php/?op=produk&id=<?php echo $row['id'] ?>" onclick="return confirm('Anda yakin ingin menghapus produk ini?');" data-bs-toggle="tooltip" data-bs-original-title="Hapus Produk" class="p-2">
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

<div class="modal fade" id="modalStokProduk" tabindex="-1" role="dialog" aria-labelledby="modalStokProdukLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStokProdukLabel">Ubah Stok Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./proses/prosesUbah.php" method="POST">
                    <input type="hidden" name="op" value="stok">
                    <input type="hidden" value="" id="produk_id" name="produk_id">
                    <div class="row">
                        <div class="col-12">
                            <label>Stok</label>
                            <input class="form-control" type="number" name="stok" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn bg-gradient-dark">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tableProduk').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
        });

        $('#modalStokProduk').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            var stok = [];
            $("input:checkbox:checked").each(function() {
                stok.push($(this).val());
            });
            modal.find('.modal-body #produk_id').val(stok);
        })
    });
</script>