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
                        <a class="nav-link active" href="profil.php"><i class="fa-solid fa-building"></i> Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistik.php"><i class="fa-solid fa-chart-line"></i> Statistik</a>
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
        <h1 class="fw-bold mb-4">Manajemen Profil Perusahaan</h1>

        <?php
        // Tampilkan pesan sukses jika ada
        if (isset($_GET['status']) && $_GET['status'] == 'sukses_update') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Data profil perusahaan telah diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                
                <form action="profil_proses.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_cv" class="form-label">Nama Perusahaan (CV)</label>
                            <input type="text" class="form-control" id="nama_cv" name="nama_cv" value="<?php echo htmlspecialchars($data['nama_cv']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_ceo" class="form-label">Nama CEO / Founder</label>
                            <input type="text" class="form-control" id="nama_ceo" name="nama_ceo" value="<?php echo htmlspecialchars($data['nama_ceo']); ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat (di Footer)</label>
                            <textarea class="form-control" id="deskripsi_singkat" name="deskripsi_singkat" rows="3" required><?php echo htmlspecialchars($data['deskripsi_singkat']); ?></textarea>
                        </div>
                        
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
                        </div>

                        <div class="col-md-4">
                            <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?php echo htmlspecialchars($data['whatsapp']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="jam_operasional" class="form-label">Jam Operasional</label>
                            <input type="text" class="form-control" id="jam_operasional" name="jam_operasional" value="<?php echo htmlspecialchars($data['jam_operasional']); ?>" required>
                        </div>

                        <hr class="my-3">

                        <div class="col-md-6">
                            <label for="foto_ceo" class="form-label">Foto CEO</label><br>
                            <img src="uploads/<?php echo htmlspecialchars($data['foto_ceo']); ?>" width="150" class="img-thumbnail mb-2">
                            <input type="hidden" name="foto_ceo_lama" value="<?php echo $data['foto_ceo']; ?>">
                            <input type="file" class="form-control" id="foto_ceo" name="foto_ceo" accept="image/*">
                            <div class="form-text">Kosongkan jika tidak ingin mengganti foto CEO.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="foto_fasilitas" class="form-label">Foto Fasilitas</label><br>
                            <img src="uploads/<?php echo htmlspecialchars($data['foto_fasilitas']); ?>" width="150" class="img-thumbnail mb-2">
                            <input type="hidden" name="foto_fasilitas_lama" value="<?php echo $data['foto_fasilitas']; ?>">
                            <input type="file" class="form-control" id="foto_fasilitas" name="foto_fasilitas" accept="image/*">
                            <div class="form-text">Kosongkan jika tidak ingin mengganti foto fasilitas.</div>
                        </div>

                    </div>
                    
                    <hr class="mt-4">
                    
                    <button type="submit" class="btn btn-danger">Simpan Perubahan Profil</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>