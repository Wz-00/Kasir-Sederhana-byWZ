<link rel="stylesheet" href="../../css/form.css">

<?php
require '../../function.php';

// cek apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {
    // cek apakah gambar sudah diupload
    if (add_produk($_POST) > 0) {
        echo "<script>
        alert('Berhasil menambahkan produk!');
        window.location.href = '../index.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan produk!');
        window.location.href = '../index.php';
        </script>";
    }
}

?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <div class="row">
        <div class="col-25">
            <label for="nama_kategori">Nama Kategori</label>
        </div>
        <div class="col-75">
            <select id="nama_kategori" name="nama_kategori">
                <?php
                // buat query untuk mengambil data kategori
                $query_kategori = "SELECT * FROM kategori";
                $result_kategori = mysqli_query($conn, $query_kategori);

                // cek jika ada hasil dari query
                if (mysqli_num_rows($result_kategori) > 0) {
                    while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
                        $id_kategori = $row_kategori['id_kategori'];
                        $nama_kategori = $row_kategori['nama_kategori'];

                        // tampilkan opsi kategori
                        echo "<option value='$nama_kategori'>$nama_kategori</option>";
                    }
                } else {
                    echo "<option value='' disabled>Tidak ada kategori</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="nama_barang">Nama Barang:</label>
        </div>
        <div class="col-75">
            <input type="text" name="nama_barang">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="stok">Stok:</label>
        </div>
        <div class="col-75">
            <input type="text" name="stok">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="harga_jual">Harga Jual:</label>
        </div>
        <div class="col-75">
            <input type="text" name="harga_jual">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="harga_beli">Harga Beli:</label>
        </div>
        <div class="col-75">
            <input type="text" name="harga_beli">
        </div>
    </div>
    <div class="row">
        <input type="submit" name='submit' value="Update">
        <input type="button" name="cancel" value="Cancel" onclick="window.location.href='../index.php'">
    </div>
</form>