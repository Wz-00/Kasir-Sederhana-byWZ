<?php

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
if (isset($_POST['bayar'])) {
    $bayar = $_POST['bayar'];

    // Validasi input adalah angka
    if (is_numeric($bayar)) {
        $kembalian = hitungKembalian($bayar);

        if (is_numeric($kembalian)) {
            if ($kembalian >= 0) {
                // Masukkan data ke tabel nota
                masukkanDataNota();
                kurangiStokBarang(); // Kurangi stok barang
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