<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['admin_username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin</title>
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
            height: 300px;
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%);
            z-index: -1;
        }
        
        /* NAVBAR */
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
        
        /* HEADER */
        .page-header {
            background: transparent;
            color: white;
            padding: 50px 0 30px 0;
            margin-bottom: 30px;
            position: relative;
        }
        
        .page-header::after {
            content: "";
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--gold-accent);
            border-radius: 2px;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 2px 4px 8px rgba(0,0,0,0.3);
            background: linear-gradient(45deg, #FFFFFF, var(--gold-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* CARD FORM */
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
        
        .card-body {
            padding: 30px !important;
        }
        
        /* FORM STYLING */
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fff;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--maroon-primary);
            box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25);
            background: #fff;
        }
        
        .form-text {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* CHECKBOX CUSTOM */
        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.2em;
        }
        
        .form-check-input:checked {
            background-color: var(--maroon-primary);
            border-color: var(--maroon-primary);
        }
        
        .form-check-label {
            font-weight: 500;
            color: #333;
            font-size: 1rem;
        }
        
        /* PREVIEW GAMBAR */
        .image-preview-container {
            position: relative;
            margin-bottom: 15px;
        }
        
        .image-preview {
            width: 200px;
            height: 200px;
            border: 3px dashed #dee2e6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }
        
        .image-preview:hover {
            border-color: var(--maroon-primary);
            transform: scale(1.02);
        }
        
        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
        
        .image-preview-placeholder {
            color: #6c757d;
            text-align: center;
            padding: 20px;
        }
        
        .image-preview-placeholder i {
            font-size: 3rem;
            margin-bottom: 10px;
            display: block;
        }
        
        /* TOMBOL */
        .btn-custom {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            border: none;
            color: white;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(139, 0, 0, 0.3);
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 0, 0, 0.4);
            color: white;
        }
        
        .btn-secondary-custom {
            background: linear-gradient(135deg, #6c757d, #868e96);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            color: white;
        }
        
        /* FILE UPLOAD */
        .file-upload {
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }
        
        .file-upload-input {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
            width: 100%;
            height: 100%;
        }
        
        .file-upload-label {
            display: block;
            padding: 12px 15px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-upload-label:hover {
            border-color: var(--maroon-primary);
            background: #e9ecef;
        }
        
        /* FORM SECTION */
        .form-section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--maroon-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: var(--gold-accent);
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
                    <h1 class="page-title">Tambah Produk Baru</h1>
                    <p class="mb-0 text-light fs-5">Tambahkan produk baru ke katalog Kepiting Segar</p>
                </div>
                
            </div>
        </div>
    </div>

    <div class="container">
        <!-- CARD FORM -->
        <div class="form-card">
            <div class="card-body">
                <form action="produk_proses_tambah.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Informasi Produk -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fa-solid fa-info-circle"></i>
                                    Informasi Produk
                                </h3>
                                
                                <!-- Nama Produk -->
                                <div class="mb-4">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" 
                                           placeholder="Masukkan nama produk" required>
                                </div>

                                <!-- Kategori -->
                                <div class="mb-4">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="bimbo">Bimbo</option>
                                        <option value="flower">Flower</option>
                                        <option value="capit">Capit</option>
                                    </select>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-4">
                                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" 
                                              placeholder="Jelaskan detail produk, keunggulan, dan spesifikasinya" required></textarea>
                                    <div class="form-text">Jelaskan produk dengan detail untuk menarik pelanggan.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Media & Pengaturan -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fa-solid fa-image"></i>
                                    Gambar Produk
                                </h3>
                                
                                <!-- Preview Gambar -->
                                <div class="image-preview-container">
                                    <div class="image-preview">
                                        <div class="image-preview-placeholder">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                            <div>Preview Gambar</div>
                                            <small class="text-muted">Gambar akan muncul di sini</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Gambar -->
                                <div class="file-upload">
                                    <input type="file" class="file-upload-input" id="gambar" name="gambar" 
                                           accept="image/jpeg, image/png, image/jpg" required 
                                           onchange="previewImage(this)">
                                    <label for="gambar" class="file-upload-label">
                                        <i class="fa-solid fa-upload me-2"></i> Pilih Gambar Produk
                                    </label>
                                </div>
                                <div class="form-text">Format: JPG, JPEG, PNG. Ukuran maksimal 2MB.</div>
                            </div>

                            <!-- Pengaturan -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fa-solid fa-star"></i>
                                    Pengaturan
                                </h3>
                                
                                <!-- Unggulan -->
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_unggulan" name="is_unggulan" value="1">
                                        <label class="form-check-label" for="is_unggulan">
                                            Jadikan Produk Unggulan
                                        </label>
                                    </div>
                                    <div class="form-text">Produk unggulan akan ditampilkan di bagian khusus beranda.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-flex gap-3 justify-content-end mt-4 pt-4 border-top">
                        <a href="produk.php" class="btn btn-secondary-custom">
                            <i class="fa-solid fa-times me-2"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-custom">
                            <i class="fa-solid fa-plus me-2"></i> Tambah Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function previewImage(input) {
            const preview = document.querySelector('.image-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Buat elemen gambar baru
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '100%';
                    img.style.objectFit = 'cover';
                    
                    // Ganti konten preview dengan gambar baru
                    preview.innerHTML = '';
                    preview.appendChild(img);
                    preview.style.borderStyle = 'solid';
                    preview.style.borderColor = '#28a745';
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Validasi form sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('gambar');
            if (fileInput.files.length === 0) {
                e.preventDefault();
                alert('Harap pilih gambar produk!');
                fileInput.focus();
            }
        });
    </script>
</body>
</html>