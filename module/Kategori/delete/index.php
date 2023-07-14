<?php
// Periksa apakah ada parameter ID yang diterima
if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];

    // Query SQL untuk menghapus data kategori berdasarkan id_kategori
    $sql = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
    $result = $conn->query($sql);
    echo "<script>
    window.location.href= 'index.php?page=barang';
    </script>";
}
?>