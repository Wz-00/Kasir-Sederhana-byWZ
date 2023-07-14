<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel Barang</h2>
        <a class="btn btn-primary mb-2" href="index.php?page=barang/insert"><i class="bi bi-plus-square"></i>
            Insert produk</a>
    </div>

    <div class="card-body">
        <table class="table table-hover table-dark" id="example">
            <thead>
                <tr>
                    <th scope="col">ID Barang</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM produk";
                $result = $conn->query($sql);
                ?>
                <?php if ($result) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>

                            <td>
                                <?= $row['id_barang'] ?>
                            </td>
                            <td>
                                <?= getKategori($row['id_kategori'])['nama_kategori'] ?>
                            </td>
                            <td>
                                <?= $row['nama_barang'] ?>
                            </td>
                            <td>
                                <?= $row['stok'] ?>
                            </td>
                            <td>
                                <?= $row['harga_jual'] ?>
                            </td>
                            <td>
                                <?= $row['harga_beli'] ?>
                            </td>
                            <td>
                                <a href="index.php?page=barang/edit&id_barang=<?= $row['id_barang'] ?>">Edit</a> | <a
                                    href="index.php?page=barang/delete&id_barang=<?= $row['id_barang'] ?>"
                                    onclick="javascript:return confirm('Hapus Data Produk ?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
