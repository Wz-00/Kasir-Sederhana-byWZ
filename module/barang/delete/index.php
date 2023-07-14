<?php
// Periksa apakah ada parameter ID yang diterima
if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];

    // Query SQL untuk menghapus data produk berdasarkan id_barang
    $sql = "DELETE FROM produk WHERE id_barang = '$id_barang'";
    $result = $conn->query($sql);
    echo "<script>
    window.location.href= 'index.php?page=barang';
    </script>";
}
?>