<?php

require '../function.php';

// Ambil data produk
$produk = getProduk();

// Proses input barang ke tabel kasir
if (isset($_POST['input_barang'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    $produk_data = getProdukById($id_barang);
    $harga_jual = $produk_data['harga_jual'];
    $total = $harga_jual * $jumlah;

    inputBarangKasir($id_barang, $jumlah, $total);
}

// Proses pembayaran
if (isset($_POST['beli'])) {
    $bayar = $_POST['bayar'];

    // Validasi input adalah angka
    if (is_numeric($bayar)) {
        $kembalian = hitungKembalian($bayar);

        if (is_numeric($kembalian)) {
            if ($kembalian >= 0) {
                // Masukkan data ke tabel nota
                masukkanDataNota();
                clearDataKasir(); // Hapus data dari tabel kasir
                echo "<script>alert('Kembalian: Rp " . number_format($kembalian, 2, ",", ".") . "');</script>";
            } else {
                echo "<script>alert('Jumlah pembayaran tidak mencukupi.');</script>";
            }
        } else {
            // Jika kembalian bukan angka, tampilkan pesan kesalahan
            echo "<script>alert('$kembalian');</script>";
        }
    }
}

// Proses menghapus data di tabel kasir
if (isset($_POST["clear"])) {
    clearDataKasir();
    echo '<script>
    alert("Data berhasil dihapus");
    </script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/content.css">
    <link rel="stylesheet" href="../css/kasir.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
        integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <title>Kasir</title>
</head>

<body>
    <div>
        <!--  -->
        <div class="sidebar p-4 bg-primary" id="sidebar">
            <h4 class="mb-5 text-white">Kantin IM</h4>
            <li>
                <!-- dashboard, produk, kategori, report, kasir -->
                <a class="text-white" href="../index.php">
                    <i class="bi bi-house mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a class="text-white" href="../barang/index.php">
                    <i class="bi bi-basket2-fill mr-2"></i>
                    Barang
                </a>
            </li>
            <li>
                <a class="text-white" href="../kategori/index.php">
                    <i class="bi bi-boxes mr-2"></i>
                    Kategori
                </a>
            </li>
            <li>
                <a class="text-white" href="../kasir/kasir.php">
                    <i class="bi bi-shop mr-2"></i>
                    Penjualan
                </a>
            </li>
            <li>
                <a class="text-white" href="../nota/index.php">
                    <i class="bi bi-newspaper mr-2"></i>
                    Laporan
                </a>
            </li>

        </div>

        <div>
            <section class="p-4" id="main-content">
                <!-- navbar -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="button-toggle">
                            <i class="bi bi-list"></i>
                        </button>
                        <a class="navbar-brand" href="#">
                            <img src="http://elearning.stmik-im.ac.id/pluginfile.php/1/theme_klass/footerlogo/1623432954/PTIMKecilSekali.png"
                                alt="">
                            <b id="name">Kantin IM</b>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavDropdown">
                            <ul class="navbar-nav mt-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle bg-secondary" href="#"
                                        id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="bi bi-person-circle"></i> Profile
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="../logout.php">logout</a></li>
                                    </ul>

                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- input kasir  -->
                <div class="card mt-5">
                    <div class='row'>
                        <div class='col-md-8 mb-4'>
                            <div class='card mb-4'>
                                <div class="card-header py-3">
                                    <h2 class='mb-0'>Kasir</h2>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="">
                                        <div class="form-outline mb-4">
                                            <label for="id_barang">Nama Barang:</label>
                                            <select name="id_barang" class='form-control'>
                                                <?php foreach ($produk as $row): ?>
                                                    <option value="<?php echo $row['id_barang']; ?>"><?php echo $row['nama_barang']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label for="jumlah">Jumlah:</label>
                                            <input type="number" name="jumlah" required class='form-control'>
                                        </div>
                                        <br>
                                        <input type="submit" name="input_barang" value="Tambahkan ke Kasir"
                                            class="btn btn-primary btn-lg btn-block">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <?php $kasir = getDataKasir(); ?>
                                    <h2 class="mb-0">Keranjang</h2>
                                    <div class="card-body">
                                        <div class='table-responsive'>
                                            <table class='table'>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Total</th>
                                                </tr>
                                                <?php foreach ($kasir as $row): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo getProdukById($row['id_barang'])['nama_barang']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['jumlah']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['total']; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        </div>
                                        <p class='text-right'>
                                            <?php echo "Rp " . number_format(hitungTotalHarga(), 2, ",", "."); ?>
                                        </p>
                                    </div>
                                    <form method="POST" action="">

                                        <br><br>
                                        <label for="bayar">Bayar:</label>
                                        <input type="number" name="bayar">
                                        <br>
                                        <input type="submit" name="beli" value="Bayar" class="btn btn-primary btn-sm">
                                        <button name="clear" value="Clear" class="btn btn-primary btn-sm">Clear
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <center style="float: bottom;">
                        <p>2023 - Project pengembangan aplikasi kasir</p>
                    </center>
                    <center style="float: bottom;">
                        <p>Oleh Kelompok 4</p>
                    </center>
                </div>
            </section>
        </div>
        <script>
            function showKembalian($kembalian) {
                alert("Kembalian: Rp " + $kembalian);
            }
            // event will be executed when the toggle-button is clicked
            document.getElementById("button-toggle").addEventListener("click", () => {

                // when the button-toggle is clicked, it will add/remove the active-sidebar class
                document.getElementById("sidebar").classList.toggle("active-sidebar");

                // when the button-toggle is clicked, it will add/remove the active-main-content class
                document.getElementById("main-content").classList.toggle("active-main-content");
            });
        </script>
</body>

</html>