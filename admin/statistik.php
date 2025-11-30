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
    <style>
        :root {
            --maroon-primary: #8B0000;
            --maroon-dark: #5A0000;
            --maroon-light: #A52A2A;
            --gold-accent: #FFD700;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #f1f3f4 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 400px;
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            clip-path: polygon(0 0, 100% 0, 100% 70%, 0 100%);
            z-index: -1;
        }
        
        /* NAVBAR GLASS MORPHISM */
        .navbar {
            background: rgba(139, 0, 0, 0.9) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(139, 0, 0, 0.3);
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(45deg, #FFFFFF, var(--gold-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 10px 20px !important;
            border-radius: 10px;
            margin: 0 3px;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white !important;
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
        }
        
        /* HEADER HERO - JUDUL DI KIRI */
        .page-header {
            background: transparent;
            color: white;
            padding: 60px 0 40px 0;
            margin-bottom: 40px;
            position: relative;
        }
        
        .page-header::after {
            content: "";
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100px;
            height: 4px;
            background: var(--gold-accent);
            border-radius: 2px;
        }
        
        .page-title {
            font-size: 3.2rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 2px 4px 8px rgba(0,0,0,0.3);
            background: linear-gradient(45deg, #FFFFFF, var(--gold-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: left;
        }
        
        .page-subtitle {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.9);
            text-align: left;
            margin-bottom: 0;
        }
        
        /* STATISTIC CARDS */
        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 30px 25px;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
        }
        
        .stat-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--maroon-primary), var(--gold-accent), var(--maroon-dark));
        }
        
        .stat-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(139, 0, 0, 0.15);
        }
        
        .stat-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            display: inline-block;
            padding: 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            color: white;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px auto;
            box-shadow: 0 8px 25px rgba(139, 0, 0, 0.3);
            transition: all 0.4s ease;
        }
        
        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 30px rgba(139, 0, 0, 0.4);
        }
        
        .stat-value {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--maroon-dark);
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .stat-label {
            font-size: 1.1rem;
            color: #555;
            font-weight: 600;
            margin-bottom: 0;
        }
        
        /* FORM CARD */
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            overflow: hidden;
            position: relative;
        }
        
        .form-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--maroon-primary), var(--gold-accent), var(--maroon-dark));
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            color: white;
            padding: 25px 30px;
            border-bottom: none;
            font-size: 1.4rem;
            font-weight: 700;
        }
        
        .card-body {
            padding: 30px !important;
        }
        
        /* FORM STYLING */
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: #fff;
            font-weight: 500;
        }
        
        .form-control:focus {
            border-color: var(--maroon-primary);
            box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25);
            background: #fff;
            transform: translateY(-2px);
        }
        
        .input-group-text {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px 0 0 12px;
            padding: 15px 20px;
            font-size: 1.2rem;
        }
        
        .form-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        /* TOMBOL */
        .btn-custom {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            border: none;
            color: white;
            font-weight: 700;
            padding: 15px 35px;
            border-radius: 12px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 25px rgba(139, 0, 0, 0.3);
            font-size: 1.1rem;
        }
        
        .btn-custom:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 30px rgba(139, 0, 0, 0.4);
            color: white;
        }
        
        .btn-secondary-custom {
            background: linear-gradient(135deg, #6c757d, #868e96);
            border: none;
            color: white;
            font-weight: 600;
            padding: 15px 30px;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            color: white;
        }
        
        /* ALERT */
        .alert {
            border: none;
            border-radius: 15px;
            padding: 20px 25px;
            font-size: 1.1rem;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border-left: 5px solid #28a745;
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(212, 237, 218, 0.9), rgba(195, 230, 203, 0.9));
            color: #155724;
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.5rem;
            }
            
            .page-subtitle {
                font-size: 1.2rem;
            }
            
            .stat-value {
                font-size: 2.2rem;
            }
            
            .stat-icon {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }
            
            body::before {
                height: 300px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-crab"></i> 
                <span>Admin Kepiting Segar</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-home me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk.php"><i class="fa-solid fa-boxes-stacked me-1"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php"><i class="fa-solid fa-building me-1"></i> Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="statistik.php"><i class="fa-solid fa-chart-line me-1"></i> Statistik</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user me-1"></i> <?php echo htmlspecialchars($username); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket me-1"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HEADER - JUDUL DI KIRI -->
    <div class="page-header">
        <div class="container">
            <div class="text-left">
                <h1 class="page-title">MANAJEMEN STATISTIK</h1>
                <p class="page-subtitle">Kelola angka statistik yang ditampilkan di beranda website</p>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        // Tampilkan pesan sukses jika ada
        if (isset($_GET['status']) && $_GET['status'] == 'sukses_update') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i>
                    <strong>BERHASIL!</strong> Angka statistik telah diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>

        <!-- PREVIEW STATISTIK -->
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div class="stat-value"><?php echo htmlspecialchars($data['tahun_berpengalaman']); ?>+</div>
                    <div class="stat-label">Tahun Berpengalaman</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-value"><?php echo htmlspecialchars($data['pelanggan_puas']); ?>+</div>
                    <div class="stat-label">Pelanggan Puas</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-value"><?php echo htmlspecialchars($data['jenis_daging']); ?>+</div>
                    <div class="stat-label">Jenis Daging Kepiting</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="stat-value"><?php echo htmlspecialchars($data['rating_kepuasan']); ?>/10</div>
                    <div class="stat-label">Rating Kepuasan</div>
                </div>
            </div>
        </div>

        <!-- FORM EDIT STATISTIK -->
        <div class="form-card">
            <div class="card-header-custom">
                <i class="fa-solid fa-pen-to-square me-2"></i>EDIT DATA STATISTIK
            </div>
            <div class="card-body">
                <form action="statistik_proses.php" method="POST">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <label for="tahun_berpengalaman" class="form-label">
                                <i class="fa-solid fa-calendar-days"></i>
                                Tahun Berpengalaman
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                <input type="number" class="form-control" id="tahun_berpengalaman" name="tahun_berpengalaman" 
                                       value="<?php echo htmlspecialchars($data['tahun_berpengalaman']); ?>" required>
                            </div>
                            <div class="form-text">Jumlah tahun pengalaman usaha Kepiting Segar</div>
                        </div>
                        
                        <div class="col-lg-6">
                            <label for="pelanggan_puas" class="form-label">
                                <i class="fa-solid fa-users"></i>
                                Pelanggan Puas
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                                <input type="number" class="form-control" id="pelanggan_puas" name="pelanggan_puas" 
                                       value="<?php echo htmlspecialchars($data['pelanggan_puas']); ?>" required>
                            </div>
                            <div class="form-text">Total pelanggan yang merasa puas dengan layanan</div>
                        </div>
                        
                        <div class="col-lg-6">
                            <label for="jenis_daging" class="form-label">
                                <i class="fa-solid fa-crab"></i>
                                Jenis Daging Kepiting
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-crab"></i></span>
                                <input type="number" class="form-control" id="jenis_daging" name="jenis_daging" 
                                       value="<?php echo htmlspecialchars($data['jenis_daging']); ?>" required>
                            </div>
                            <div class="form-text">Variasi jenis daging kepiting yang tersedia</div>
                        </div>
                        
                        <div class="col-lg-6">
                            <label for="rating_kepuasan" class="form-label">
                                <i class="fa-solid fa-star"></i>
                                Rating Kepuasan
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-star"></i></span>
                                <input type="number" step="0.1" class="form-control" id="rating_kepuasan" name="rating_kepuasan" 
                                       value="<?php echo htmlspecialchars($data['rating_kepuasan']); ?>" min="0" max="10" required>
                            </div>
                            <div class="form-text">Rating kepuasan pelanggan (skala 0-10)</div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                        <a href="index.php" class="btn btn-secondary-custom">
                            <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Dashboard
                        </a>
                        <button type="submit" class="btn btn-custom">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan Statistik
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>