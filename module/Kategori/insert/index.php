<?php

// cek apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {
    // cek apakah gambar sudah diupload
    if (add_kategori($_POST) > 0) {
        echo "<script>
        alert('Berhasil menambahkan kategori!');
        window.location.href = 'index.php?page=Kategori';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan kategori!');
        window.location.href = 'index.php?page=Kategori';
        </script>";
    }
}

?>
<a href="index.php?page=Kategori" class="btn btn-primary mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Tambah Barang</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="nama_kategori">Nama Kategori:</label></td>
                    <td><input type="text" name="nama_kategori" class="form-control"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name='submit' value="Update" class="btn btn-primary"></td>
                </tr>
            </form>
        </table>
    </div>
</div>