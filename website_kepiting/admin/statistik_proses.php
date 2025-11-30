<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

// 1. Ambil data dari form dan pastikan itu angka
$tahun = (int)$_POST['tahun_berpengalaman'];
$pelanggan = (int)$_POST['pelanggan_puas'];
$jenis = (int)$_POST['jenis_daging'];
$rating = (float)$_POST['rating_kepuasan']; // Gunakan float untuk angka desimal

// 2. Update ke Database (ID selalu 1)
$query = "UPDATE statistik SET 
            tahun_berpengalaman = $tahun,
            pelanggan_puas = $pelanggan,
            jenis_daging = $jenis,
            rating_kepuasan = $rating
          WHERE id = 1";

if (mysqli_query($koneksi, $query)) {
    header("Location: statistik.php?status=sukses_update");
    exit();
} else {
    die("Error: Gagal mengupdate data statistik. " . mysqli_error($koneksi));
}
?>