<link rel="stylesheet" href="../../css/form.css">

<?php
require '../../function.php';

// cek apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {
    // cek apakah gambar sudah diupload
    if (add_kategori($_POST) > 0) {
        echo "<script>
        alert('Berhasil menambahkan kategori!');
        window.location.href = '../index.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan kategori!');
        window.location.href = '../index.php';
        </script>";
    }
}

?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <div class="row">
        <div class="col-25">
            <label for="nama_kategori">Nama Kategori:</label>
        </div>
        <div class="col-75">
            <input type="text" name="nama_kategori">
        </div>
    </div>
    <div class="row">
        <input type="submit" name='submit' value="Update">
        <input type="button" name="cancel" value="Cancel" onclick="window.location.href='../index.php'">
    </div>
</form>