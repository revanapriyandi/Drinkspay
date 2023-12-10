<?php
if (isset($_GET['id'])) {
    $id = htmlspecialchars(@$_GET['id']);

    $action = "./proses/prosesUbah.php";
    $query = "SELECT * FROM produk WHERE id = '$id'";
    $execute = $konek->query($query);
    $data = $execute->fetch_assoc();
} else {
    $action = "./proses/prosesTambah.php";
    $data = [
        'id' => '',
        'name' => '',
        'kategori_id' => '',
        'harga' => '',
        'stok' => '',
        'image' => '',
        'kode' => ''
    ];
}
?>
<form id="form" action="<?php echo $action ?>" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="font-weight-bolder">Product Image</h5>
                    <div class="row">
                        <div class="col-12">
                            <img class="w-100 border-radius-lg shadow-lg mt-3" src="<?php
                                                                                    if ($data['image'] == '') {
                                                                                        echo 'https://via.placeholder.com/150';
                                                                                    } else {
                                                                                        echo "assets/img/" . $data['image'];
                                                                                    }
                                                                                    ?>" alt="product_image" id="imagePreview">

                        </div>
                        <div class="col-12 mt-3">
                            <div class="d-flex">
                                <div class="form-file ms-3 me-3">
                                    <input type="file" class="form-file-input form-control" id="inputFile" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-lg-0 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="font-weight-bolder">Produk Information</h5>
                    <input type="hidden" value="<?php echo $data['id'] ?>" name="id">
                    <input type="hidden" value="produk" name="op">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" value="<?php echo $data['name'] ?>" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label>Kode Produk</label>
                            <input class="form-control" type="text" name="kode" value="<?php echo $data['kode'] ?>" required>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12">
                            <label class="mt-4">Kategori</label>
                            <select class="form-control" name="kategori_id">
                                <?php
                                $kategoriQuery = "SELECT * FROM kategori";
                                $kategoriExecute = $konek->query($kategoriQuery);
                                foreach ($kategoriExecute as $kategori) {
                                ?>
                                    <option value="<?php echo $kategori['id'] ?>" <?php if ($data['kategori_id'] == $kategori['id']) {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo $kategori['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="mt-4">Harga</label>
                            <input class="form-control" type="number" name="harga" value="<?php echo $data['harga'] ?>" required>
                        </div>
                        <div class="col-6">
                            <label class="mt-4">Stok</label>
                            <input class="form-control" type="number" name="stok" value="<?php echo $data['stok'] ?>" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="index.php?page=produk" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-dark">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    document.getElementById("inputFile").addEventListener("change", function(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imagePreview = document.getElementById("imagePreview");
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    });
</script>