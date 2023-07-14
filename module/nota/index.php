<?php

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
<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel Nota</h2>

    </div>
    <div class="card-body">
        <p>Cari nota berdasarkan tanggal input:</p>
        <!-- Form input tanggal -->
        <form method="GET" action="index.php" class="row g-3">
            <input type="hidden" name="page" value="nota">
            <div class="col-auto">
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
        <br>
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
    </div>
</div>