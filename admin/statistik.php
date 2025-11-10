<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['admin_username'];

// 1. Ambil data statistik (kita tahu id-nya selalu 1)
$query = "SELECT * FROM statistik WHERE id = 1";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    die("Error: Data statistik tidak ditemukan. Harap jalankan query INSERT awal.");
}
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Statistik - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body style="background-color: #f4f7f6;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fa-solid fa-shield-halved"></i> Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-home"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk.php"><i class="fa-solid fa-boxes-stacked"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php"><i class="fa-solid fa-building"></i> Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="statistik.php"><i class="fa-solid fa-chart-line"></i> Statistik</a>
                    </li>
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
        <h1 class="fw-bold mb-4">Manajemen Statistik Beranda</h1>

        <?php
        // Tampilkan pesan sukses jika ada
        if (isset($_GET['status']) && $_GET['status'] == 'sukses_update') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Angka statistik telah diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                
                <form action="statistik_proses.php" method="POST">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tahun_berpengalaman" class="form-label">Tahun Berpengalaman</label>
                            <input type="number" class_="" id="tahun_berpengalaman" name="tahun_berpengalaman" value="<?php echo htmlspecialchars($data['tahun_berpengalaman']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="pelanggan_puas" class="form-label">Pelanggan Puas</label>
                            <input type="number" class_="" id="pelanggan_puas" name="pelanggan_puas" value="<?php echo htmlspecialchars($data['pelanggan_puas']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_daging" class="form-label">Jenis Daging Kepiting</label>
                            <input type="number" class_="" id="jenis_daging" name="jenis_daging" value="<?php echo htmlspecialchars($data['jenis_daging']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="rating_kepuasan" class="form-label">Rating Kepuasan (misal: 9.8)</label>
                            <input type="number" step="0.1" class_="" id="rating_kepuasan" name="rating_kepuasan" value="<?php echo htmlspecialchars($data['rating_kepuasan']); ?>" required>
                        </div>
                    </div>
                    
                    <hr class="mt-4">
                    
                    <button type="submit" class="btn btn-danger">Simpan Perubahan Statistik</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>