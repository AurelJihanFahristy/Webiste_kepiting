<?php
// 1. Panggil koneksi
// Ini akan otomatis memulai session dan mengecek koneksi
include 'koneksi.php';

// 2. Cek apakah admin sudah login
// Jika belum, lempar kembali ke halaman login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

// Ambil username dari session untuk sapaan
$username = $_SESSION['admin_username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kepiting Segar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .card-link {
            text-decoration: none;
            color: inherit;
        }
        .card-link .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body style="background-color: #f4f7f6;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fa-solid fa-shield-halved"></i> Admin Panel Kepiting Segar
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> Halo, <?php echo htmlspecialchars($username); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="fw-bold">Dashboard</h1>
        <p class="text-muted">Selamat datang di halaman manajemen website Kepiting Segar.</p>

        <div class="row mt-4 g-4">
            
            <div class="col-md-4">
                <a href="produk.php" class="card-link">
                    <div class="card h-100 p-3 text-center">
                        <div class="card-body">
                            <i class="fa-solid fa-boxes-stacked fa-3x text-danger mb-3"></i>
                            <h4 class="fw-bold">Manajemen Produk</h4>
                            <p class="text-muted">Tambah, edit, atau hapus data produk di gallery.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="profil.php" class="card-link">
                    <div class="card h-100 p-3 text-center">
                        <div class="card-body">
                            <i class="fa-solid fa-building fa-3x text-danger mb-3"></i>
                            <h4 class="fw-bold">Manajemen Profil</h4>
                            <p class="text-muted">Edit info kontak, alamat, dan profil perusahaan.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="statistik.php" class="card-link">
                    <div class="card h-100 p-3 text-center">
                        <div class="card-body">
                            <i class="fa-solid fa-chart-line fa-3x text-danger mb-3"></i>
                            <h4 class="fw-bold">Manajemen Statistik</h4>
                            <p class="text-muted">Ubah angka statistik di halaman beranda.</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>