<?php 
// Set variabel untuk halaman ini
$active_page = 'beranda';
$page_title = 'Beranda - Kepiting Segar';

// Panggil header
include '_header.php'; 

// --- Ambil Data Spesifik untuk Halaman Beranda ---

// 1. Ambil data statistik
$result_stats = mysqli_query($koneksi, "SELECT * FROM statistik WHERE id = 1");
$stats = mysqli_fetch_assoc($result_stats);

// 2. Ambil data produk unggulan (maksimal 3)
$result_produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE is_unggulan = 1 LIMIT 3");
?>

  <header class="hero">
    <div class="bg"></div>
    <div class="hero-container text-white">
      <h1 class="display-1">Kepiting Segar <br><span class="accent">Berkualitas Premium</span></h1>
      <p class="subtitle-cta">Nikmati kelezatan kepiting segar pilihan terbaik langsung dari tambak berkualitas tinggi. Dijamin segar, berukuran jumbo, dan penuh daging.</p>
      <div class="mt-4 d-flex gap-3">
        <a class="btn btn-yellow" href="gallery.php"><i class="fa-regular fa-images"></i> Lihat Gallery Produk</a>
      </div>
    </div>
  </header>

  <section id="produk" class="produk-unggulan py-5">
    <div class="container text-center">
      <h2 class="fw-bold mb-2">Produk Unggulan Kami</h2>
      <p class="text-muted mb-5">Pilihan kepiting terbaik dengan kualitas premium</p>

      <div class="row justify-content-center g-4">
        
        <?php
        // Loop untuk menampilkan produk unggulan
        if (mysqli_num_rows($result_produk) > 0) {
            while ($produk = mysqli_fetch_assoc($result_produk)) {
                // Tentukan badge berdasarkan kategori
                $badge_class = 'bg-danger'; // Default
                $badge_text = 'Premium';
                if ($produk['kategori'] == 'bimbo') {
                    $badge_class = 'bg-warning text-dark';
                    $badge_text = 'Populer';
                } elseif ($produk['kategori'] == 'capit') {
                    $badge_class = 'bg-success';
                    $badge_text = 'Spesial';
                }
        ?>

        <div class="col-md-4">
          <div class="card product-card shadow-sm">
            <span class="badge <?php echo $badge_class; ?> badge-produk"><?php echo $badge_text; ?></span>
            
            <img src="admin/uploads/<?php echo htmlspecialchars($produk['gambar']); ?>" class="card-img-top p-3" alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>">
            
            <div class="card-body text-start">
              <h5 class="fw-bold"><?php echo htmlspecialchars($produk['nama_produk']); ?></h5>
              <p class="text-muted small"><?php echo htmlspecialchars($produk['deskripsi']); ?></p>
              
              <a href="#" class="btn btn-detail"
                data-title="<?php echo htmlspecialchars($produk['nama_produk']); ?>"
                data-desc="<?php echo htmlspecialchars(str_replace(["\r", "\n"], ' ', $produk['deskripsi'])); ?>"
                data-img="admin/uploads/<?php echo htmlspecialchars($produk['gambar']); ?>">
                <i class="fa-regular fa-eye"></i> Lihat Detail
              </a>
            </div>
          </div>
        </div>
        <?php
            } // Akhir while loop
        } else {
            echo '<p class="text-muted">Belum ada produk unggulan.</p>';
        }
        ?>

      </div>
    </div>
  </section>

  <section class="statistik-section text-white py-5">
    <div class="container text-center">
      <div class="row justify-content-center g-5">

        <div class="col-md-3">
          <div class="stat-box">
            <i class="fa-regular fa-calendar-check icon-stat"></i>
            <h2 class="fw-bold"><?php echo htmlspecialchars($stats['tahun_berpengalaman']); ?></h2>
            <p>Tahun Berpengalaman</p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="stat-box">
            <i class="fa-regular fa-user icon-stat"></i>
            <h2 class="fw-bold"><?php echo htmlspecialchars($stats['pelanggan_puas']); ?></h2>
            <p>Pelanggan Puas</p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="stat-box">
            <i class="fa-solid fa-ship icon-stat"></i>
            <h2 class="fw-bold"><?php echo htmlspecialchars($stats['jenis_daging']); ?></h2>
            <p>Jenis daging Kepiting</p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="stat-box">
            <i class="fa-regular fa-star icon-stat"></i>
            <h2 class="fw-bold"><?php echo htmlspecialchars($stats['rating_kepuasan']); ?></h2>
            <p>Rating Kepuasan</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="cta-gallery text-white py-5 text-center">
    <div class="overlay"></div>
    <div class="container position-relative">
      <h2 class="fw-bold mb-3">Jelajahi Koleksi Kepiting Lengkap Kami</h2>
      <p class="mb-4">Temukan berbagai jenis kepiting segar berkualitas premium dengan harga terbaik. Dari kepiting bakau hingga rajungan, semuanya tersedia untuk Anda.</p>
      <a class="btn btn-yellow" href="gallery.php"><i class="fa-regular fa-images"></i> jelajahi Gallery kepiting</a>
    </div>
  </section>

  <div id="popupModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <div class="modal-body">
        <img id="modalImage" src="" alt="Kepiting">
        <div class="modal-text">
          <h2 id="modalTitle"></h2>
          <p id="modalDesc"></p>
        </div>
      </div>
    </div>
  </div>

<?php 
// Panggil footer
include '_footer.php'; 
?>