<?php
// query kategori
$sqlCat = "SELECT COUNT(*) AS total_kategori FROM kategori";
$resultCat = $conn->query($sqlCat);

// query produk
$sqlStok = "SELECT SUM(stok) AS total_stok FROM produk";
$resultStok = $conn->query($sqlStok);

// query nota
$sqlNota = "SELECT SUM(total) AS total_nota FROM nota";
$resultNota = $conn->query($sqlNota);

// query kasir
$sqlKasir = "SELECT COUNT(*) AS sum_nota FROM nota";
$resultKasir = $conn->query($sqlKasir);
?>
<div class="badan">
    <h2>Dashboard</h2>
    <br>
    <?php if ($resultCat && $resultStok && $resultKasir && $resultNota) {
        $rowcat = $resultCat->fetch_assoc();
        $total_kategori = $rowcat['total_kategori'];

        // Ambil nilai total stok produk
        $rowStok = $resultStok->fetch_assoc();
        $totalStok = $rowStok['total_stok'];

        // Ambil nilai banyaknya query kasir
        $rowKasir = $resultKasir->fetch_assoc();
        $totalKasir = $rowKasir['sum_nota'];

        // Ambil nilai total nota
        $rowNota = $resultNota->fetch_assoc();
        $totalNota = $rowNota['total_nota'];
        ?>
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h6 class="pt-2"><i class="bi bi-basket2-fill mr-2"></i> Stok Barang</h6>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1>
                                <?= $totalStok ?>
                            </h1>
                        </center>
                    </div>
                    <div class="card-footer">
                        <a href='index.php?page=barang'>Tabel
                            Barang </a>
                    </div>
                </div>
                <!--/grey-card -->
            </div>
            <div class="col-md-3 mb-3">

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h6 class="pt-2"><i class="bi bi-boxes mr-2"></i></i> Kategori</h6>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1>
                                <?= $total_kategori ?>
                            </h1>
                        </center>
                    </div>
                    <div class="card-footer">
                        <a href='index.php?page=Kategori'>Tabel Kategori </a>
                    </div>
                </div>

                <!--/grey-card -->
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h6 class="pt-2"><i class="bi bi-shop mr-2"></i> Penjualan</h6>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1>
                                <?= $totalKasir ?>
                            </h1>
                        </center>
                    </div>
                    <div class="card-footer">
                        <a href='index.php?page=kasir'>Kasir </a>
                    </div>
                </div>
                <!--/grey-card -->
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h6 class="pt-2"><i class="bi bi-cash-stack mr-2"></i> Pendapatan</h6>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1>
                                <?= "Rp.", number_format($totalNota, 2, ",", ".") ?>
                            </h1>
                        </center>
                    </div>
                    <div class="card-footer">
                        <a href='index.php?page=nota'>Tabel
                            Nota</a>
                    </div>
                </div>
                <!--/grey-card -->
            </div>
        </div>
    <?php } ?>
</div>