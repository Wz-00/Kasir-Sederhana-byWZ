<head>
    <link rel="stylesheet" href="../../css/form.css">
</head>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kantin_im";

$conn = new mysqli($servername, $username, $password, $dbname);






// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}



// Periksa apakah ada parameter id_barang yang diterima
if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];

    // Query SQL untuk mengambil data produk berdasarkan id_barang
    $sql = "SELECT * FROM produk WHERE id_barang = '$id_barang'";
    $result = $conn->query($sql);

    // Periksa apakah query berhasil dieksekusi dan data ditemukan
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Tampilkan form edit dengan nilai-nilai awal yang diambil dari database
        ?>
        <div class="container ">
            <h2>Form Update Barang</h2>
            <form action="update.php" method="POST">
                <div class="row">
                    <div class="col-25">
                        <label for="id_barang">ID Barang</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="id_barang" value="<?php echo $row['id_barang']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="nama_barang">Nama Barang:</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="stok">Stok:</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="stok" value="<?php echo $row['stok']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="harga_jual">Harga Jual:</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="harga_jual" value="<?php echo $row['harga_jual']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="harga_beli">Harga Beli:</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="harga_beli" value="<?php echo $row['harga_beli']; ?>">
                    </div>
                </div>
                <div class="row">
                    <input type="submit" name='submit' value="Update">
                </div>
            </form>
        </div>
        <?php
    } else {
        echo "Data tidak ditemukan.";
    }

}


// Fungsi edit produk

?>