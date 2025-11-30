<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

// 1. Ambil data dari form
$id = (int)$_POST['id_produk'];
$nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
$kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$is_unggulan = isset($_POST['is_unggulan']) ? 1 : 0;
$gambar_lama = mysqli_real_escape_string($koneksi, $_POST['gambar_lama']);

$nama_gambar_baru = ""; // Siapkan variabel untuk gambar baru

// 2. Logika Cek Upload Gambar Baru
// Cek apakah ada file baru yang di-upload
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    
    // Ada file baru, proses upload seperti biasa
    $gambar = $_FILES['gambar'];
    $folder_target = "uploads/";
    $nama_unik = time() . "_" . $_SESSION['admin_username'] . "_" . basename($gambar['name']);
    $file_target = $folder_target . $nama_unik;
    
    // Validasi tipe file
    $tipe_file = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
    if ($tipe_file != "jpg" && $tipe_file != "png" && $tipe_file != "jpeg") {
        die("Error: Hanya file JPG, JPEG, & PNG yang diizinkan.");
    }
    
    // Pindahkan file baru
    if (move_uploaded_file($gambar['tmp_name'], $file_target)) {
        $nama_gambar_baru = $nama_unik; // Simpan nama file baru
        
        // Hapus file gambar lama
        $file_path_lama = "uploads/" . $gambar_lama;
        if (file_exists($file_path_lama)) {
            unlink($file_path_lama);
        }
    } else {
        die("Error: Terjadi kesalahan saat meng-upload file baru.");
    }
} else {
    // Tidak ada file baru yang di-upload, tetap gunakan gambar lama
    $nama_gambar_baru = $gambar_lama;
}

// 3. Update ke Database
$query = "UPDATE produk SET 
            nama_produk = '$nama_produk',
            deskripsi = '$deskripsi',
            gambar = '$nama_gambar_baru',
            kategori = '$kategori',
            is_unggulan = $is_unggulan
          WHERE id = $id";

if (mysqli_query($koneksi, $query)) {
    // Jika berhasil, redirect kembali ke halaman produk.php
    // Kita buat pesan sukses_edit
    header("Location: produk.php?status=sukses_edit");
    exit();
} else {
    // Jika gagal
    die("Error: Gagal mengupdate data. " . mysqli_error($koneksi));
}
?>