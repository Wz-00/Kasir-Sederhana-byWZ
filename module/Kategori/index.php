<div class="card mt-5">
    <div class="card-header">
        <h2>Tabel kategori</h2>
        <a class="btn btn-primary mb-2" href="index.php?page=Kategori/insert"><i class="bi bi-plus-square"></i>
            Insert kategori</a>
    </div>
    <div class="card-body">

        <table class="table table-hover table-dark" id="example">
            <thead>
                <tr>
                    <th scope="col">ID Kategori</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Tanggal Input</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM kategori";
                $result = $conn->query($sql);
                ?>
                <?php if ($result) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td>
                                <?= $row['id_kategori'] ?>
                            </td>
                            <td>
                                <?= $row['nama_kategori'] ?>
                            </td>
                            <td>
                                <?= $row['tanggal_input'] ?>
                            </td>
                            <td>
                                <a href="index.php?page=Kategori/edit&id_kategori=<?= $row['id_kategori'] ?>">Edit</a> | <a
                                    href="index.php?page=Kategori/delete&id_kategori=<?= $row['id_kategori'] ?>"
                                    onclick="javascript:return confirm('Hapus Data kategori ?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>