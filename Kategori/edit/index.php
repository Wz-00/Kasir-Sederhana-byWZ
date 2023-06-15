<head>
    <link rel="stylesheet" href="../../css/form.css">
</head>
<?php
require '../../function.php';


$id_kategori = $_GET["id_kategori"];

$kt = query("SELECT * FROM kategori WHERE id_kategori = '$id_kategori'")[0];



//cek tombol submit sudah di tekan
if (isset($_POST["submit"])) {

    if (edit_kategori($_POST) > 0) {
        echo "<script>
        alert('Berhasil mengupdate kategori!');
        document.location.href = '../index.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengupdate kategori!');
        document.location.href = '../index.php';
        </script>";
    }

}

?>


<form action="" method="POST">
    <div class="row">
        <div class="col-25">
            <label for="id_kategori">ID Kategori</label>
        </div>
        <div class="col-75">
            <input type="text" name="id_kategori" value="<?php echo $kt['id_kategori']; ?>" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="nama_kategori">Nama Barang:</label>
        </div>
        <div class="col-75">
            <input type="text" name="nama_kategori" value="<?php echo $kt['nama_kategori']; ?>">
        </div>
    </div>

    <div class="row">
        <input type="submit" name='submit' value="Update">
        <input type="button" name="cancel" value="cancel" onclick="window.location.href='../index.php'">
    </div>
</form>