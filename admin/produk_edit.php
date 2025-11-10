<?php
include 'koneksi.php';

// Cek sesi login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['admin_username'];

// 1. Ambil ID dari URL
if (!isset($_GET['id'])) {
    die("Error: ID Produk tidak ditemukan.");
}
$id = (int)$_GET['id'];

// 2. Ambil data produk yang akan diedit
$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    die("Error: Data produk tidak ditemukan.");
}
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin</title>
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
                        <a class="nav-link active" href="produk.php"><i class="fa-solid fa-boxes-stacked"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php"><i class="fa-solid fa-building"></i> Profil</a>
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
        <h1 class="fw-bold mb-4">Edit Produk</h1>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                
                <form action="produk_proses_edit.php" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id_produk" value="<?php echo $data['id']; ?>">
                    <input type="hidden" name="gambar_lama" value="<?php echo $data['gambar']; ?>">

                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo htmlspecialchars($data['nama_produk']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="bimbo" <?php if($data['kategori'] == 'bimbo') echo 'selected'; ?>>bimbo</option>
                            <option value="flower" <?php if($data['kategori'] == 'flower') echo 'selected'; ?>>flower</option>
                            <option value="capit" <?php if($data['kategori'] == 'capit') echo 'selected'; ?>>capit</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Produk</label><br>
                        <img src="uploads/<?php echo htmlspecialchars($data['gambar']); ?>" width="150" class="img-thumbnail mb-2">
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/jpeg, image/png, image/jpg">
                        <div class="form-text">Kosongkan jika tidak ingin mengganti gambar.</div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_unggulan" name="is_unggulan" value="1" <?php if($data['is_unggulan'] == 1) echo 'checked'; ?>>
                        <label class="form-check-label" for="is_unggulan">Jadikan Produk Unggulan (Tampil di Beranda)?</label>
                    </div>

                    <hr>
                    
                    <button type="submit" class="btn btn-danger">Update Produk</button>
                    <a href="produk.php" class="btn btn-secondary">Batal</a>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>