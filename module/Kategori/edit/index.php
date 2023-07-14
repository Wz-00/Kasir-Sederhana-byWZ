<?php


$id_kategori = $_GET["id_kategori"];

$kt = query("SELECT * FROM kategori WHERE id_kategori = '$id_kategori'")[0];



//cek tombol submit sudah di tekan
if (isset($_POST["submit"])) {

    if (edit_kategori($_POST) > 0) {
        echo "<script>
        alert('Berhasil mengupdate kategori!');
        document.location.href = 'index.php?page=Kategori';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengupdate kategori!');
        document.location.href = 'index.php?page=Kategori';
        </script>";
    }

}

?>
<a href="index.php?page=Kategori" class="btn btn-primary mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Tambah Kategori</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="id_kategori">ID Kategori</label></td>
                    <td><input type="text" name="id_kategori" value="<?php echo $kt['id_kategori']; ?>"
                            class="form-control" readonly></td>
                </tr>
                <tr>
                    <td><label for="nama_kategori">Nama Barang:</label></td>
                    <td><input type="text" name="nama_kategori" value="<?php echo $kt['nama_kategori']; ?>"
                            class="form-control"></td>
                </tr>
                <tr></tr>
                <td></td>
                <td><input type="submit" name='submit' value="Update" class="btn btn-primary"></td>
            </form>
        </table>
    </div>
</div>