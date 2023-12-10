<?php
if (isset($_GET['id'])) {
    $id = htmlspecialchars(@$_GET['id']);

    $action = "./proses/prosesUbah.php";
    $query = "SELECT * FROM users WHERE id = '$id'";
    $execute = $konek->query($query);
    $user = $execute->fetch_assoc();
} else {
    $action = "./proses/prosesTambah.php";
    $user = [
        'id' => '',
        'name' => '',
        'email' => '',
        'role' => ''
    ];
}
?>

<div class="col-lg-8 mt-lg-0 mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder">User Information</h5>
            <form id="form" action="<?php echo $action ?>" method="POST">
                <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
                <input type="hidden" value="user" name="op">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" value="<?php echo $user['name'] ?>" required>
                    </div>
                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value="<?php echo $user['email'] ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="mt-4">Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="col-6">
                        <label class="mt-4">Password Confirmation</label>
                        <input class="form-control" type="password" name="password_confirmation">
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <label class="mt-4">Role</label>
                        <select class="form-control" name="role">
                            <option value="owner" <?php if ($user['role'] == 'owner') {
                                                        echo 'selected';
                                                    } ?>>Owner</option>
                            <option value="kasir" <?php if ($user['role'] == 'kasir') {
                                                        echo 'selected';
                                                    } ?>>Kasir</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <a href="index.php?page=user" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>