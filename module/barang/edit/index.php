<?php

$id_barang = $_GET["id_barang"];

$br = query("SELECT * FROM produk WHERE id_barang = '$id_barang'")[0];



//cek tombol submit sudah di tekan
if (isset($_POST["submit"])) {

    if (edit_produk($_POST) > 0) {
        echo "<script>
        alert('Berhasil mengupdate produk!');
        document.location.href = 'index.php?page=barang';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengupdate produk!');
        document.location.href = 'index.php?page=barang';
        </script>";
    }

}

?>

<a href="index.php?page=barang" class="btn btn-primary mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Edit Barang</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="id_barang">ID Barang</label></td>
                    <td><input type="text" name="id_barang" value="<?php echo $br['id_barang']; ?>" readonly
                            class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="nama_barang">Nama Barang:</label></td>
                    <td><input type="text" name="nama_barang" value="<?php echo $br['nama_barang']; ?>"
                            class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="stok">Stok:</label></td>
                    <td><input type="text" name="stok" value="<?php echo $br['stok']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td> <label for="harga_jual">Harga Jual:</label></td>
                    <td><input type="text" name="harga_jual" value="<?php echo $br['harga_jual']; ?>"
                            class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="harga_beli">Harga Beli:</label></td>
                    <td><input type="text" name="harga_beli" value="<?php echo $br['harga_beli']; ?>"
                            class="form-control"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name='submit' value="Update" class="btn btn-primary"></td>
                </tr>
            </form>
        </table>
    </div>
</div>