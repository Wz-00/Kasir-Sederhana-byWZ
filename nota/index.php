<?php
require '../function.php';

// Inisialisasi variabel
$result = null;
$totalKeuntungan = 0;

// Cek jika terdapat parameter tanggal pada URL
if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];

    // Query untuk mencari nota berdasarkan tanggal input
    $sql = "SELECT * FROM nota WHERE tgl_input = '$tanggal'";
    $result = $conn->query($sql);

    // Menghitung total keuntungan per tanggal
    $totalKeuntungan = 0;
    foreach ($result as $row) {
        $totalKeuntungan += $row['total'];
    }
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
        integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <title>Nota</title>
</head>

<body>
    <div>
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
                <a class="text-white" href="#">
                    <i class="bi bi-newspaper mr-2"></i>
                    Laporan
                </a>
            </li>

        </div>

        <div>
            <section class="p-4" id="main-content">
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

                <div class="card mt-5">
                    <div class="card-body">
                        <h4>Tabel Nota</h4>
                    </div>
                </div>
                <!-- Form input tanggal -->
                <form method="GET" action="">
                    <div class="form-group">
                        <label for="tanggal">Cari nota berdasarkan tanggal input:</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>

                <?php if (isset($_GET['tanggal']) && $result && $result->num_rows > 0): ?>
                    <h5 class='text-right'>
                        <?= $tanggal ?>
                    </h5>
                <?php endif; ?>

                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <tbody>
                        <?php if (is_array($result) || is_object($result)): ?>
                            <?php foreach ($result as $row): ?>
                                <tr>
                                    <td>
                                        <?= $i ?>
                                    </td>
                                    <td>
                                        <?= getProdukById($row['id_barang'])['nama_barang']; ?>
                                    </td>
                                    <td>
                                        <?= $row['jumlah'] ?>
                                    </td>
                                    <td>
                                        <?= $row['total'] ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <th>Total Omset</th>
                            <td colspan="2">
                                <?= $totalKeuntungan ?>
                            </td>

                        </tr>
                    </tbody>

                </table>
            </section>

            <div class="footer">
                <center style="float: bottom;">
                    <p>2023 - Project pengembangan aplikasi kasir</p>
                </center>
                <center style="float: bottom;">
                    <p>Oleh Kelompok 4</p>
                </center>
            </div>
        </div>
    </div>
    <script>
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