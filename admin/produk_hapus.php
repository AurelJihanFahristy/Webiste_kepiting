<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

// 1. Ambil ID dari URL
if (!isset($_GET['id'])) {
    die("Error: ID Produk tidak ditemukan.");
}
$id = (int)$_GET['id'];

// 2. Ambil nama file gambar sebelum dihapus dari database
$query_select = "SELECT gambar FROM produk WHERE id = $id";
$result_select = mysqli_query($koneksi, $query_select);

if (mysqli_num_rows($result_select) > 0) {
    $row = mysqli_fetch_assoc($result_select);
    $nama_gambar = $row['gambar'];
    $file_path = "uploads/" . $nama_gambar;

    // 3. Hapus file gambar dari folder 'uploads/'
    if (file_exists($file_path)) {
        unlink($file_path); // Fungsi untuk menghapus file
    }

    // 4. Hapus data dari database
    $query_delete = "DELETE FROM produk WHERE id = $id";
    if (mysqli_query($koneksi, $query_delete)) {
        // Redirect kembali ke halaman produk dengan pesan sukses
        header("Location: produk.php?status=sukses_hapus");
        exit();
    } else {
        die("Error: Gagal menghapus data dari database. " . mysqli_error($koneksi));
    }

} else {
    die("Error: Data produk tidak ditemukan.");
}
?>