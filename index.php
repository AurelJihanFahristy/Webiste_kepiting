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

<!-- Loading Overlay Simple -->
<div class="loading-overlay">
  <div class="loading-spinner"></div>
</div>

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

          // Potong deskripsi untuk tampilan card (hanya 100 karakter)
          $deskripsi_pendek = strlen($produk['deskripsi']) > 100
            ? substr($produk['deskripsi'], 0, 100) . '...'
            : $produk['deskripsi'];
      ?>

          <div class="col-md-4">
            <div class="card product-card shadow-sm">
              <span class="badge <?php echo $badge_class; ?> badge-produk"><?php echo $badge_text; ?></span>

              <img src="admin/uploads/<?php echo htmlspecialchars($produk['gambar']); ?>" class="card-img-top p-3" alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>">

              <div class="card-body text-start">
                <h5 class="fw-bold"><?php echo htmlspecialchars($produk['nama_produk']); ?></h5>
                <p class="text-muted small card-desc"><?php echo htmlspecialchars($deskripsi_pendek); ?></p>

                <a href="#" class="btn btn-detail"
                  data-title="<?php echo htmlspecialchars($produk['nama_produk']); ?>"
                  data-desc="<?php echo htmlspecialchars($produk['deskripsi']); ?>"
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

<!-- Modal untuk Detail Produk - DIUBAH -->
<div id="popupModal" class="modal">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <div class="modal-body">
      <div class="modal-image-container">
        <img id="modalImage" src="" alt="Kepiting" class="modal-img">
      </div>
      <div class="modal-text">
        <h2 id="modalTitle" class="modal-title"></h2>
        <div class="modal-desc-container">
          <p id="modalDesc" class="modal-desc"></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CSS untuk Loading Spinner ONLY -->
<style>
  .loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.98);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.2s ease;
  }

  .loading-overlay.fade-out {
    opacity: 0;
    pointer-events: none;
  }

  .loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #dc3545;
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>

<!-- JavaScript untuk Loading dan Modal - DIUBAH -->
<script>
  // Loading functionality
  document.addEventListener('DOMContentLoaded', function() {
    const loadingOverlay = document.querySelector('.loading-overlay');

    // Loading hanya 0.3 detik
    setTimeout(() => {
      loadingOverlay.classList.add('fade-out');

      // Hapus element setelah animasi selesai
      setTimeout(() => {
        loadingOverlay.remove();
      }, 200);
    }, 400);

    // Modal functionality
    const modal = document.getElementById('popupModal');
    const closeBtn = document.querySelector('.close-btn');
    const detailButtons = document.querySelectorAll('.btn-detail');

    // Open modal when detail button is clicked
    detailButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const title = this.getAttribute('data-title');
        const desc = this.getAttribute('data-desc');
        const img = this.getAttribute('data-img');

        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDesc').textContent = desc;
        document.getElementById('modalImage').src = img;
        document.getElementById('modalImage').alt = title;

        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';

        // Reset scroll position di modal
        const descContainer = document.querySelector('.modal-desc-container');
        if (descContainer) {
          descContainer.scrollTop = 0;
        }
      });
    });

    // Close modal when X is clicked
    closeBtn.addEventListener('click', function() {
      modal.style.display = 'none';
      document.body.style.overflow = 'auto';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
      if (e.target === modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
      }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && modal.style.display === 'block') {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
      }
    });
  });
</script>

<?php
// Panggil footer
include '_footer.php';
?>
