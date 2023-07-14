<?php

// cek apakah tombol submit sudah ditekan
if (isset($_POST['submit'])) {
    // cek apakah gambar sudah diupload
    if (add_produk($_POST) > 0) {
        echo "<script>
        alert('Berhasil menambahkan produk!');
        window.location.href = 'index.php?page=barang';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan produk!');
        window.location.href = 'index.php?page=barang';
        </script>";
    }
}

?>

<a href="index.php?page=barang" class="btn btn-primary mb-3"><i class="bi bi-chevron-left"></i> Kembali</a>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <h2>Tambah Barang</h2>
            <form action="" method="POST">
                <tr>
                    <td><label for="nama_kategori">Nama Kategori</label></td>
                    <td><select id="nama_kategori" name="nama_kategori" class="form-control">
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
                        </select></td>
                </tr>
                <tr>
                    <td><label for="nama_barang">Nama Barang:</label></td>
                    <td><input type="text" name="nama_barang" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="stok">Stok:</label></td>
                    <td><input type="text" name="stok" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="harga_jual">Harga Jual:</label></td>
                    <td><input type="text" name="harga_jual" class="form-control"></td>
                </tr>
                <tr>
                    <td><label for="harga_beli">Harga Beli:</label></td>
                    <td><input type="text" name="harga_beli" class="form-control"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name='submit' value="Update" class="btn btn-primary"></td>
                </tr>
            </form>
        </table>
    </div>
</div>