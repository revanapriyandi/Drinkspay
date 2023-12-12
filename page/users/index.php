<div class="row my-4">
    <div class="col-12">
        <div class=" text-right d-flex flex-column justify-content-center mb-3">
            <a href="index.php?page=user-add&action=add" class="btn btn-dark mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Tambah Pengguna</a>
        </div>
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="tableUser">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM users ORDER BY id DESC";
                        $execute = $konek->query($query);
                        foreach ($execute as $row) {
                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://ui-avatars.com/api/?name=revan&color=7F9CF5&background=EBF4FF" class="avatar avatar-sm me-3" alt="avatar image">
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
                                        <?php echo $row['email']; ?>
                                    </p>
                                </td>
                                <td>
                                    <span class="badge badge-dot me-4">
                                        <i class="<?php
                                                    if ($row['role'] == 'owner') {
                                                        echo 'bg-success';
                                                    } elseif ($row['role'] == 'kasir') {
                                                        echo 'bg-warning';
                                                    }
                                                    ?>"></i>
                                        <span class="text-dark text-xs">
                                            <?php echo $row['role']; ?>
                                        </span>
                                    </span>
                                </td>
                                <td class="text-sm">
                                    <a href="index.php?page=user-edit&id=<?php echo $row['id'] ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit User" class="p-2">
                                        <i class="fas fa-edit text-secondary" aria-hidden="true"></i>
                                    </a>
                                    <a href="proses/prosesHapus.php/?op=user&id=<?php echo $row['id'] ?>" onclick="return confirm('Anda yakin ingin menghapus user ini?');" data-bs-toggle="tooltip" data-bs-original-title="Hapus User" class="p-2">
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
        $('#tableUser').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
        });
    });
</script>