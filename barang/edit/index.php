<head>
    <link rel="stylesheet" href="../../css/form.css">
</head>
<?php
require '../../function.php';


$id_barang = $_GET["id_barang"];

$br = query("SELECT * FROM produk WHERE id_barang = '$id_barang'")[0];



//cek tombol submit sudah di tekan
if (isset($_POST["submit"])) {

    if (edit($_POST) > 0) {
        echo "<script>
        alert('Berhasil mengupdate produk!');
        document.location.href = '../index.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengupdate produk!');
        document.location.href = '../index.php';
        </script>";
    }

}

?>


<form action="" method="POST">
    <div class="row">
        <div class="col-25">
            <label for="id_barang">ID Barang</label>
        </div>
        <div class="col-75">
            <input type="text" name="id_barang" value="<?php echo $br['id_barang']; ?>" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="nama_barang">Nama Barang:</label>
        </div>
        <div class="col-75">
            <input type="text" name="nama_barang" value="<?php echo $br['nama_barang']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="stok">Stok:</label>
        </div>
        <div class="col-75">
            <input type="text" name="stok" value="<?php echo $br['stok']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="harga_jual">Harga Jual:</label>
        </div>
        <div class="col-75">
            <input type="text" name="harga_jual" value="<?php echo $br['harga_jual']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="harga_beli">Harga Beli:</label>
        </div>
        <div class="col-75">
            <input type="text" name="harga_beli" value="<?php echo $br['harga_beli']; ?>">
        </div>
    </div>
    <div class="row">
        <input type="submit" name='submit' value="Update">
        <input type="button" name="cancel" value="cancel" onclick="window.location.href='../index.php'">
    </div>
</form>