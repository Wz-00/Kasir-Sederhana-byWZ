<?php

$conn = mysqli_connect("localhost", "root", "", "kantin_im");



function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;

    }
    return $rows;
}

function edit_produk($edit)
{
    global $conn;

    //ambil data dari form edit
    $id_barang = $edit["id_barang"];
    $nama_barang = $edit["nama_barang"];
    $stok = $edit["stok"];
    $harga_jual = $edit["harga_jual"];
    $harga_beli = $edit["harga_beli"];

    //query insert data

    $query = "UPDATE produk SET nama_barang='$nama_barang', stok='$stok', harga_jual='$harga_jual', harga_beli='$harga_beli' WHERE id_barang='$id_barang'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function edit_kategori($editK)
{
    global $conn;

    // ambil data dari form edit kategori
    $id_kategori = $editK["id_kategori"];
    $nama_kategori = $editK["nama_kategori"];


    $query = "UPDATE kategori SET nama_kategori='$nama_kategori', tanggal_input= NOW() WHERE id_kategori='$id_kategori'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function add_produk($add_produk)
{
    global $conn;

    // ambil data dari form insert

    $nama_kategori = $add_produk["nama_kategori"];
    $nama_barang = $add_produk["nama_barang"];
    $stok = $add_produk["stok"];
    $harga_jual = $add_produk["harga_jual"];
    $harga_beli = $add_produk["harga_beli"];

    // cek apakah nama_kategori ada dalam tabel kategori
    $query_cek_kategori = "SELECT id_kategori FROM kategori WHERE nama_kategori = '$nama_kategori'";
    $result_cek_kategori = mysqli_query($conn, $query_cek_kategori);


    if (mysqli_num_rows($result_cek_kategori) > 0) {
        // ambil id_kategori berdasarkan nama_kategori
        $row_kategori = mysqli_fetch_assoc($result_cek_kategori);
        $id_kategori = $row_kategori["id_kategori"];

        // query insert data
        $query = "INSERT INTO produk (id_kategori, nama_barang, stok, harga_jual, harga_beli) VALUES ('$id_kategori', '$nama_barang', '$stok', '$harga_jual', '$harga_beli')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    } else {
        // kategori tidak ditemukan, lakukan penanganan error sesuai kebutuhan
        // throw new Exception("Kategori tidak valid");
        // atau: return 0;
    }
}

function add_kategori($add_kategori)
{
    global $conn;
    // ambil data dari form insert
    $nama_kategori = $add_kategori["nama_kategori"];

    $query = "INSERT INTO kategori (nama_kategori, tanggal_input) values ('$nama_kategori', now())";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function getProduk()
{
    global $conn;

    $query = "SELECT * FROM produk";
    $result = mysqli_query($conn, $query);

    $produk = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $produk[] = $row;
    }

    return $produk;
}

// Fungsi untuk mendapatkan data produk berdasarkan ID barang
function getProdukById($id_barang)
{
    global $conn;

    $query = "SELECT * FROM produk WHERE id_barang = '$id_barang'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

// Fungsi untuk input barang ke tabel kasir
function inputBarangKasir($id_barang, $jumlah, $total)
{
    global $conn;

    // Cek apakah barang sudah ada di tabel kasir
    $query = "SELECT COUNT(*) as count FROM kasir WHERE id_barang = '$id_barang'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['count'] > 0) {
        // Jika barang sudah ada, update jumlah dan total
        $query = "UPDATE kasir SET jumlah = jumlah + $jumlah, total = total + '$total' WHERE id_barang = '$id_barang'";
    } else {
        // Jika barang belum ada, lakukan operasi INSERT
        $query = "INSERT INTO kasir (id_barang, jumlah, total, tgl_input) VALUES ('$id_barang', $jumlah, $total, NOW())";
    }

    mysqli_query($conn, $query);
}

// Fungsi untuk menghitung kembalian
function hitungKembalian($bayar)
{
    global $conn;

    $query = "SELECT SUM(total) AS total FROM kasir";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $total = $row['total'];

    // Validasi input adalah angka
    if (is_numeric($bayar)) {
        $kembalian = $bayar - $total;
        return $kembalian;
    } else {
        return "Input pembayaran harus berupa angka.";
    }
}


// Fungsi untuk memasukkan data ke tabel nota
function masukkanDataNota()
{
    global $conn;

    $query = "INSERT INTO nota (id_barang, jumlah, total, tgl_input) SELECT id_barang, jumlah, total, tgl_input FROM kasir";
    mysqli_query($conn, $query);
}

// Fungsi untuk menghapus data di tabel kasir
function clearDataKasir()
{
    global $conn;

    $query = "DELETE FROM kasir";
    mysqli_query($conn, $query);
}

// Fungsi untuk mendapatkan data kasir
function getDataKasir()
{
    global $conn;

    $query = "SELECT * FROM kasir";
    $result = mysqli_query($conn, $query);

    $kasir = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $kasir[] = $row;
    }

    return $kasir;
}

function hitungTotalHarga()
{
    global $conn;

    $query = "SELECT SUM(total) AS total_harga FROM kasir";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['total_harga'];
}

// Fungsi untuk mengupdate stok produk setelah transaksi pembelian
function kurangiStokBarang()
{
    global $conn;

    $query = "SELECT id_barang, jumlah FROM kasir";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $id_barang = $row['id_barang'];
        $jumlah = $row['jumlah'];

        $query_update_stok = "UPDATE produk SET stok = stok - $jumlah WHERE id_barang = '$id_barang'";
        mysqli_query($conn, $query_update_stok);
    }
}
function getKategori($id_kategori)
{
    global $conn;

    $query = "SELECT * FROM kategori WHERE id_kategori = '$id_kategori'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row;
}


?>
