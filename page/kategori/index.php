<div class="row my-4">
    <div class="col-12">
        <div class=" text-right d-flex flex-column justify-content-center mb-3">
            <a href="index.php?page=kategori-add&action=add" class="btn btn-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Tambah Kategori</a>
        </div>
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="tableKategori">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM kategori ORDER BY id DESC";
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
                                <td class="text-sm">
                                    <a href="index.php?page=kategori-edit&id=<?php echo $row['id'] ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit Kategori" class="p-2">
                                        <i class="fas fa-edit text-secondary" aria-hidden="true"></i>
                                    </a>
                                    <a href="proses/prosesHapus.php/?op=kategori&id=<?php echo $row['id'] ?>" onclick="return confirm('Anda yakin ingin menghapus kategori ini?');" data-bs-toggle="tooltip" data-bs-original-title="Hapus Kategori" class="p-2">
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
        $('#tableKategori').DataTable();
    });
</script>