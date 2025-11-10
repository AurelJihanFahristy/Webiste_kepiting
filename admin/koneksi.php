<?php
// Pengaturan Database
$host = 'localhost'; // Server database kamu
$user = 'root';      // Username database
$pass = '';          // Password database (kosongkan jika tidak ada, misal di XAMPP)
$db   = 'db_kepiting'; // Nama database

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengatur zona waktu (opsional tapi disarankan)
date_default_timezone_set('Asia/Jakarta');

// Memulai session
// Session wajib ada untuk menyimpan status login
if (!session_id()) {
    session_start();
}
?>