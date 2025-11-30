<?php
// 1. Hubungkan ke database
// Kita panggil file koneksi dari dalam folder admin
include 'admin/koneksi.php';

// 2. Ambil data profil perusahaan (untuk footer & tombol WA)
// Data ini akan dibutuhkan di setiap halaman
$result_profil = mysqli_query($koneksi, "SELECT * FROM profil_perusahaan WHERE id = 1");
$profil = mysqli_fetch_assoc($result_profil);

// $active_page akan di-set di halaman utama (beranda.php, gallery.php, dll)
// Ini untuk menentukan menu mana yang 'active' di navbar
if (!isset($active_page)) {
    $active_page = '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title><?php echo isset($page_title) ? $page_title : 'Kepiting Segar'; ?></title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="style.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container-fluid px-4">
      <a class="navbar-brand d-flex align-items-center" href="beranda.php">
    <span class="logo-icon me-2" style="width: 50px; height: 50px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
        <img src="FOTO.JPG" alt="Logo Kepiting Segar" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: cover; border-radius: 50%;">
    </span>
    <span class="logo-text">Kepiting Segar</span>
</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?php if($active_page == 'beranda') echo 'active'; ?>" href="beranda.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($active_page == 'gallery') echo 'active'; ?>" href="gallery.php">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($active_page == 'profile') echo 'active'; ?>" href="profile.php">Profile</a>
          </li>
        </ul>
        <a class="btn btn-ws" href="https://wa.me/<?php echo htmlspecialchars($profil['whatsapp']); ?>" target="_blank">
          <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
        </a>
      </div>
    </div>
  </nav>