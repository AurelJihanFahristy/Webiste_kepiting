<?php
// Panggil koneksi (yang otomatis memulai session)
include 'koneksi.php';

// Hapus semua data session
session_unset();

// Hancurkan session
session_destroy();

// Arahkan kembali ke halaman login
header("Location: login.php");
exit();
?>