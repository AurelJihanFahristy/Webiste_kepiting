<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

// 1. Ambil data dari form
$nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
$kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

// Cek checkbox 'is_unggulan'. Jika dicentang, nilainya 1, jika tidak, 0.
$is_unggulan = isset($_POST['is_unggulan']) ? 1 : 0;

// 2. Logika Upload Gambar
$gambar = $_FILES['gambar'];
$nama_gambar = ""; // Variabel untuk menyimpan nama file yang akan ke database

if ($gambar['error'] === UPLOAD_ERR_OK) {
    // Tentukan folder target
    $folder_target = "uploads/";
    
    // Buat nama file yang unik untuk menghindari tabrakan nama file
    // Format: timestamp_namalogin_namaasli.jpg
    $nama_unik = time() . "_" . $_SESSION['admin_username'] . "_" . basename($gambar['name']);
    $file_target = $folder_target . $nama_unik;
    
    // Validasi tipe file
    $tipe_file = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
    if ($tipe_file != "jpg" && $tipe_file != "png" && $tipe_file != "jpeg") {
        die("Error: Hanya file JPG, JPEG, & PNG yang diizinkan.");
    }
    
    // Pindahkan file yang di-upload ke folder target
    if (move_uploaded_file($gambar['tmp_name'], $file_target)) {
        // Jika upload berhasil, simpan nama unik ke variabel
        $nama_gambar = $nama_unik;
    } else {
        die("Error: Terjadi kesalahan saat meng-upload file.");
    }
} else {
    die("Error: Tidak ada gambar yang di-upload atau terjadi kesalahan.");
}

// 3. Simpan ke Database
// Pastikan nama_gambar tidak kosong
if (!empty($nama_gambar)) {
    $query = "INSERT INTO produk (nama_produk, deskripsi, gambar, kategori, is_unggulan) 
              VALUES ('$nama_produk', '$deskripsi', '$nama_gambar', '$kategori', $is_unggulan)";
              
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, redirect kembali ke halaman produk.php dengan pesan sukses
        header("Location: produk.php?status=sukses_tambah");
        exit();
    } else {
        // Jika gagal simpan ke DB
        die("Error: Gagal menyimpan data ke database. " . mysqli_error($koneksi));
    }
}
?>