<?php
// 1. Panggil file koneksi
include 'koneksi.php'; // Session sudah otomatis dimulai dari sini

// 2. Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// 3. Validasi dasar (pastikan tidak kosong)
if (empty($username) || empty($password)) {
    // Jika kosong, lempar kembali ke login dengan pesan error
    header("Location: login.php?error=kosong");
    exit();
}

// 4. Amankan input (mencegah SQL Injection dasar)
$username = mysqli_real_escape_string($koneksi, $username);

// 5. Query untuk mencari username
$query = "SELECT * FROM admin WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);

// 6. Cek apakah username ditemukan
if (mysqli_num_rows($result) === 1) {
    // Username ditemukan, ambil datanya
    $row = mysqli_fetch_assoc($result);

    // 7. Verifikasi password
    // Kita gunakan password_verify() untuk membandingkan password form
    // dengan password hash di database
    if (password_verify($password, $row['password'])) {
        
        // --- LOGIN BERHASIL ---
        
        // Simpan username ke session sebagai tanda sudah login
        $_SESSION['admin_username'] = $row['username'];
        $_SESSION['admin_id'] = $row['id'];
        
        // Arahkan ke dashboard admin
        header("Location: index.php");
        exit();

    } else {
        // Password salah
        header("Location: login.php?error=salah");
        exit();
    }

} else {
    // Username tidak ditemukan
    header("Location: login.php?error=salah");
    exit();
}

// Tutup koneksi (opsional karena PHP biasanya otomatis)
mysqli_close($koneksi);
?>