<?php
if (isset($_GET['id'])) {
    $id = htmlspecialchars(@$_GET['id']);

    $action = "./proses/prosesUbah.php";
    $query = "SELECT * FROM konsumen WHERE id = '$id'";
    $execute = $konek->query($query);
    $data = $execute->fetch_assoc();
} else {
    $action = "./proses/prosesTambah.php";
    $data = [
        'id' => '',
        'name' => '',
    ];
}
?>

<div class="col-lg-8 mt-lg-0 mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bolder">Konsumen Information</h5>
            <form id="form" action="<?php echo $action ?>" method="POST">
                <input type="hidden" value="<?php echo $data['id'] ?>" name="id">
                <input type="hidden" value="konsumen" name="op">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" value="<?php echo $data['name'] ?>" required>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class=" text-right d-flex flex-column justify-content-center mb-3">
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>