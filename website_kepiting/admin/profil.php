<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['admin_username'];

// 1. Ambil data profil (kita tahu id-nya selalu 1)
$query = "SELECT * FROM profil_perusahaan WHERE id = 1";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    die("Error: Data profil tidak ditemukan. Harap jalankan query INSERT awal.");
}
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Profil - Admin</title>
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
        
        /* PREVIEW GAMBAR */
        .image-preview-container {
            position: relative;
            margin-bottom: 15px;
        }
        
        .image-preview {
            width: 200px;
            height: 200px;
            border: 3px solid #e9ecef;
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
            padding: 10px 15px;
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
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 2px solid #e9ecef;
        }
        
        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--maroon-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--gold-accent);
        }
        
        .section-title i {
            color: var(--gold-accent);
            background: rgba(139, 0, 0, 0.1);
            padding: 8px;
            border-radius: 8px;
        }
        
        /* CURRENT IMAGE INFO */
        .current-image-info {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border: 1px solid #90caf9;
            border-radius: 8px;
            padding: 10px 15px;
            margin-top: 10px;
        }
        
        /* ALERT */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(212, 237, 218, 0.9), rgba(195, 230, 203, 0.9));
            color: #155724;
            border-left: 4px solid #28a745;
        }

        /* INPUT GROUP */
        .input-group-text {
            background: linear-gradient(135deg, var(--maroon-primary), var(--maroon-dark));
            color: white;
            border: none;
            font-weight: 600;
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
                        <a class="nav-link" href="produk.php"><i class="fa-solid fa-boxes-stacked me-1"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="profil.php"><i class="fa-solid fa-building me-1"></i> Profil</a>
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
            <div class="text-center">
                <h1 class="page-title">Manajemen Profil Perusahaan</h1>
                <p class="mb-0 text-light fs-5">Kelola informasi dan identitas Kepiting Segar</p>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        // Tampilkan pesan sukses jika ada
        if (isset($_GET['status']) && $_GET['status'] == 'sukses_update') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i>
                    <strong>Berhasil!</strong> Data profil perusahaan telah diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>

        <!-- CARD FORM -->
        <div class="form-card">
            <div class="card-body">
                <form action="profil_proses.php" method="POST" enctype="multipart/form-data">
                    
                    <!-- Informasi Perusahaan -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fa-solid fa-building"></i>
                            Informasi Perusahaan
                        </h3>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama_cv" class="form-label">Nama Perusahaan (CV)</label>
                                <input type="text" class="form-control" id="nama_cv" name="nama_cv" 
                                       value="<?php echo htmlspecialchars($data['nama_cv']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nama_ceo" class="form-label">Nama CEO / Founder</label>
                                <input type="text" class="form-control" id="nama_ceo" name="nama_ceo" 
                                       value="<?php echo htmlspecialchars($data['nama_ceo']); ?>" required>
                            </div>

                            <div class="col-12">
                                <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat (Footer)</label>
                                <textarea class="form-control" id="deskripsi_singkat" name="deskripsi_singkat" 
                                          rows="3" required><?php echo htmlspecialchars($data['deskripsi_singkat']); ?></textarea>
                                <div class="form-text">Tampilan singkat perusahaan di bagian footer website.</div>
                            </div>
                            
                            <div class="col-12">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" 
                                          required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak & Operasional -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fa-solid fa-address-book"></i>
                            Kontak & Operasional
                        </h3>
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </span>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" 
                                           value="<?php echo htmlspecialchars($data['whatsapp']); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo htmlspecialchars($data['email']); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="jam_operasional" class="form-label">Jam Operasional</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-clock"></i>
                                    </span>
                                    <input type="text" class="form-control" id="jam_operasional" name="jam_operasional" 
                                           value="<?php echo htmlspecialchars($data['jam_operasional']); ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media & Gambar -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fa-solid fa-images"></i>
                            Media & Gambar
                        </h3>
                        
                        <div class="row g-4">
                            <!-- Foto CEO -->
                            <div class="col-md-6">
                                <label class="form-label">Foto CEO</label>
                                
                                <div class="image-preview-container">
                                    <div class="image-preview">
                                        <?php if (!empty($data['foto_ceo'])): ?>
                                            <img src="uploads/<?php echo htmlspecialchars($data['foto_ceo']); ?>" 
                                                 alt="Foto CEO" id="previewFotoCeo">
                                        <?php else: ?>
                                            <div class="image-preview-placeholder">
                                                <i class="fa-solid fa-user-tie"></i>
                                                <div>Foto CEO</div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <input type="hidden" name="foto_ceo_lama" value="<?php echo htmlspecialchars($data['foto_ceo']); ?>">
                                
                                <div class="file-upload">
                                    <input type="file" class="file-upload-input" id="foto_ceo" name="foto_ceo" 
                                           accept="image/*" onchange="previewImage(this, 'previewFotoCeo')">
                                    <label for="foto_ceo" class="file-upload-label">
                                        <i class="fa-solid fa-camera me-2"></i> Ganti Foto CEO
                                    </label>
                                </div>
                                <div class="form-text">Kosongkan jika tidak ingin mengganti foto.</div>
                            </div>

                            <!-- Foto Fasilitas -->
                            <div class="col-md-6">
                                <label class="form-label">Foto Fasilitas</label>
                                
                                <div class="image-preview-container">
                                    <div class="image-preview">
                                        <?php if (!empty($data['foto_fasilitas'])): ?>
                                            <img src="uploads/<?php echo htmlspecialchars($data['foto_fasilitas']); ?>" 
                                                 alt="Foto Fasilitas" id="previewFotoFasilitas">
                                        <?php else: ?>
                                            <div class="image-preview-placeholder">
                                                <i class="fa-solid fa-warehouse"></i>
                                                <div>Foto Fasilitas</div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <input type="hidden" name="foto_fasilitas_lama" value="<?php echo htmlspecialchars($data['foto_fasilitas']); ?>">
                                
                                <div class="file-upload">
                                    <input type="file" class="file-upload-input" id="foto_fasilitas" name="foto_fasilitas" 
                                           accept="image/*" onchange="previewImage(this, 'previewFotoFasilitas')">
                                    <label for="foto_fasilitas" class="file-upload-label">
                                        <i class="fa-solid fa-camera me-2"></i> Ganti Foto Fasilitas
                                    </label>
                                </div>
                                <div class="form-text">Kosongkan jika tidak ingin mengganti foto.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-custom">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const container = input.closest('.col-md-6').querySelector('.image-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Jika ada gambar sebelumnya, ganti src-nya
                    if (preview) {
                        preview.src = e.target.result;
                    } else {
                        // Jika belum ada gambar, buat elemen img baru
                        const img = document.createElement('img');
                        img.id = previewId;
                        img.src = e.target.result;
                        img.style.maxWidth = '100%';
                        img.style.maxHeight = '100%';
                        img.style.objectFit = 'cover';
                        
                        // Hapus placeholder dan tambahkan gambar baru
                        container.innerHTML = '';
                        container.appendChild(img);
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>