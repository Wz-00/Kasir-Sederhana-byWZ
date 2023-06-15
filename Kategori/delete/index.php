<?php
$conn = mysqli_connect("localhost", "root", "", "kantin_im");
// Periksa apakah ada parameter ID yang diterima
if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];

    // Query SQL untuk menghapus data kategori berdasarkan id_kategori
    $sql = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
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