<?php
$conn = mysqli_connect("localhost", "root", "", "kantin_im");
// Periksa apakah ada parameter ID yang diterima
if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];

    // Query SQL untuk menghapus data produk berdasarkan id_barang
    $sql = "DELETE FROM produk WHERE id_barang = '$id_barang'";
    $result = $conn->query($sql);

    // Tampilkan konfirmasi alert sebelum menghapus barang
    echo "<script>
        var confirmDelete = confirm('Apakah Anda yakin ingin menghapus barang ini?');
        if (confirmDelete) {
            // Jika pengguna menekan OK, lanjutkan dengan proses delete
            window.location.href = '../index.php';
        } else {
            // Jika pengguna menekan Cancel, kembali ke halaman sebelumnya
            window.history.back();
        }
    </script>";

}
?>