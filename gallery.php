<?php 
// Set variabel untuk halaman ini
$active_page = 'gallery';
$page_title = 'Gallery Produk - Kepiting Segar';

// Panggil header
include '_header.php'; 

// --- Ambil Data Spesifik untuk Halaman Gallery ---

// Ambil semua data produk, diurutkan berdasarkan kategori
$result_produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY kategori, nama_produk ASC");
?>

  <section class="gallery-section py-5 mt-5">
    <div class="container">
      <h2 class="fw-bold text-center mb-2">Gallery Kepiting Premium</h2>
      <p class="text-center text-muted mb-4">Koleksi lengkap daging kepiting segar berkualitas tinggi</p>

      <div class="text-center mb-5">
        <button class="btn btn-danger me-2">Semua Produk</button>
        <button class="btn btn-outline-secondary me-2">bimbo</button>
        <button class="btn btn-outline-secondary me-2">flower</button>
        <button class="btn btn-outline-secondary">capit</button>
      </div>

      <div class="row g-4 justify-content-center">

        <?php
        // Loop untuk menampilkan SEMUA produk
        if (mysqli_num_rows($result_produk) > 0) {
            while ($produk = mysqli_fetch_assoc($result_produk)) {
        ?>
        
        <div class="col-md-4 col-sm-6">
          <div class="card product-card shadow-sm">
            <img src="admin/uploads/<?php echo htmlspecialchars($produk['gambar']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>">
            <div class="card-body text-center">
              <h5 class="fw-bold"><?php echo htmlspecialchars($produk['nama_produk']); ?></h5>
              </div>
          </div>
        </div>
        <?php
            } // Akhir while loop
        } else {
            echo '<p class="text-center text-muted">Belum ada produk di gallery.</p>';
        }
        ?>

      </div>

      <div class="text-center mt-5">
        <a href="beranda.php" class="btn btn-dark">
          <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
      </div>
    </div>
  </section>

<?php 
// Panggil footer
include '_footer.php'; 
?>