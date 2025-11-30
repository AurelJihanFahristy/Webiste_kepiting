<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['admin_username'];

// Ambil semua data produk dari database
$query = "SELECT * FROM produk ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Admin</title>
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
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .nav-link:hover::before,
        .nav-link.active::before {
            left: 100%;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white !important;
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
        }
        
        /* HEADER HERO */
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
            left: 50%;
            transform: translateX(-50%);
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
        }
        
        /* TOMBOL NEOMORPHISM */
        .btn-custom {
            background: linear-gradient(145deg, var(--maroon-primary), var(--maroon-dark));
            border: none;
            color: white;
            font-weight: 700;
            padding: 15px 30px;
            border-radius: 15px;
            transition: all 0.4s ease;
            box-shadow: 8px 8px 16px rgba(139, 0, 0, 0.3),
                        -4px -4px 8px rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .btn-custom::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-custom:hover::before {
            left: 100%;
        }
        
        .btn-custom:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 12px 12px 24px rgba(139, 0, 0, 0.4),
                        -6px -6px 12px rgba(255, 255, 255, 0.15);
            color: white;
        }
        
        /* CARD GLASS MORPHISM */
        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1),
                        0 5px 15px rgba(0, 0, 0, 0.07);
            margin-bottom: 30px;
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
        }
        
        .main-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--maroon-primary), var(--gold-accent), var(--maroon-dark));
            background-size: 200% 100%;
            animation: shimmer 3s infinite linear;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .main-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(139, 0, 0, 0.15),
                        0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .card-body {
            padding: 30px !important;
        }
        
        /* TABLE ENHANCED */
        .table {
            font-size: 1.05rem;
            margin-bottom: 0;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .table thead th {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            color: white;
            font-weight: 700;
            padding: 20px 15px;
            border: none;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
        }
        
        .table thead th::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--gold-accent);
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .table tbody tr:last-child {
            border-bottom: none;
        }
        
        .table tbody tr:hover {
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.03) 0%, rgba(255, 215, 0, 0.03) 100%);
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .table tbody td {
            padding: 18px 15px;
            vertical-align: middle;
            border-color: rgba(0,0,0,0.05);
        }
        
        /* PERBAIKAN GAMBAR PRODUK - SEDERHANA DAN PASTI TAMPIL */
        .product-image-container {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 3px solid #f8f9fa;
            transition: all 0.4s ease;
        }
        
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        .product-image-container:hover {
            transform: scale(1.15) rotate(2deg);
            box-shadow: 0 10px 25px rgba(139, 0, 0, 0.3);
            border-color: var(--maroon-primary);
        }
        
        /* Fallback jika gambar tidak ada */
        .product-image-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--maroon-primary), var(--maroon-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }
        
        /* BADGE ENHANCED */
        .badge-custom {
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 700;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .badge-featured {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            animation: pulse 2s infinite;
        }
        
        .badge-regular {
            background: linear-gradient(135deg, #6c757d, #868e96);
            color: white;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        /* BUTTON ACTION ENHANCED */
        .btn-action {
            font-weight: 700;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.4s ease;
            margin: 3px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: white;
        }
        
        .btn-edit:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
            color: white;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
        }
        
        .btn-delete:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
            color: white;
        }
        
        /* ALERT ENHANCED */
        .alert {
            border: none;
            border-radius: 15px;
            padding: 20px 25px;
            font-size: 1.1rem;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border-left: 5px solid;
            position: relative;
            overflow: hidden;
        }
        
        .alert-success {
            border-left-color: #28a745;
            background: linear-gradient(135deg, rgba(212, 237, 218, 0.9), rgba(195, 230, 203, 0.9));
            color: #155724;
        }
        
        .alert::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: inherit;
            filter: brightness(0.8);
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.2rem;
            }
            
            body::before {
                height: 300px;
                clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%);
            }
            
            .product-image-container {
                width: 80px;
                height: 80px;
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
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-home me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="produk.php"><i class="fa-solid fa-boxes-stacked me-1"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php"><i class="fa-solid fa-building me-1"></i> Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistik.php"><i class="fa-solid fa-chart-line me-1"></i> Statistik</a>
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

    <!-- HEADER -->
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Manajemen Produk</h1>
                    <p class="mb-0 text-light fs-5">Kelola semua produk Kepiting Segar dengan mudah</p>
                </div>
                <a href="produk_tambah.php" class="btn btn-custom">
                    <i class="fa-solid fa-plus me-2"></i> Tambah Produk Baru
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        // Tampilkan pesan sukses jika ada
        if (isset($_GET['status']) && $_GET['status'] == 'sukses_tambah') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i>
                    <strong>Berhasil!</strong> Produk baru telah ditambahkan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }

        if (isset($_GET['status']) && $_GET['status'] == 'sukses_hapus') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i>
                    <strong>Berhasil!</strong> Produk telah dihapus.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }

        if (isset($_GET['status']) && $_GET['status'] == 'sukses_edit') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i>
                    <strong>Berhasil!</strong> Data produk telah diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>

        <!-- CARD TABEL -->
        <div class="main-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Unggulan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; ?>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td class="fw-bold fs-5"><?php echo $no++; ?></td>
                                    <td>
                                        <div class="product-image-container">
                                            <?php 
                                            $gambar_path = 'uploads/' . htmlspecialchars($row['gambar']);
                                            if (file_exists($gambar_path) && !empty($row['gambar'])): 
                                            ?>
                                                <img src="<?php echo $gambar_path; ?>" 
                                                     alt="<?php echo htmlspecialchars($row['nama_produk']); ?>" 
                                                     class="product-image"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="product-image-placeholder" style="display: none;">
                                                    <i class="fa-solid fa-image"></i>
                                                </div>
                                            <?php else: ?>
                                                <div class="product-image-placeholder">
                                                    <i class="fa-solid fa-image"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="fw-semibold fs-6"><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                                    <td>
                                        <span class="badge badge-custom badge-regular"><?php echo htmlspecialchars($row['kategori']); ?></span>
                                    </td>
                                    <td>
                                        <?php if($row['is_unggulan'] == 1): ?>
                                            <span class="badge badge-custom badge-featured">★ Unggulan</span>
                                        <?php else: ?>
                                            <span class="badge badge-custom badge-regular">Biasa</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="produk_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-action btn-edit">
                                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                            </a>
                                            <a href="produk_hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                <i class="fa-solid fa-trash me-1"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                                        <h4 class="text-muted">Belum ada data produk</h4>
                                        <p class="text-muted">Mulai dengan menambahkan produk pertama Anda</p>
                                        <a href="produk_tambah.php" class="btn btn-custom mt-2">
                                            <i class="fa-solid fa-plus me-2"></i> Tambah Produk Pertama
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>