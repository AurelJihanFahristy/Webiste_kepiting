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

  <!-- Loading Overlay -->
  <div class="loading-overlay">
    <div class="loading-spinner"></div>
  </div>

  <section class="gallery-section py-5">
    <div class="container">
      <!-- Header -->
      <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Gallery Kepiting Premium</h2>
        <p class="text-muted">Koleksi lengkap daging kepiting segar berkualitas tinggi</p>
      </div>

      <!-- Filter Kategori -->
      <div class="text-center mb-5">
        <div class="btn-group" role="group" aria-label="Filter kategori produk">
          <button class="btn btn-danger active" data-filter="all">Semua Produk</button>
          <button class="btn btn-outline-secondary" data-filter="bimbo">Bimbo</button>
          <button class="btn btn-outline-secondary" data-filter="flower">Flower</button>
          <button class="btn btn-outline-secondary" data-filter="capit">Capit</button>
        </div>
      </div>

      <div class="row g-4 justify-content-center" id="product-grid">

        <?php
        // Loop untuk menampilkan SEMUA produk
        if (mysqli_num_rows($result_produk) > 0) {
            while ($produk = mysqli_fetch_assoc($result_produk)) {
        ?>
        
        <div class="col-md-4 col-sm-6 product-item" data-category="<?php echo htmlspecialchars($produk['kategori']); ?>">
          <div class="card product-card shadow-sm">
            <img src="admin/uploads/<?php echo htmlspecialchars($produk['gambar']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>">
            <div class="card-body text-center">
              <h5 class="fw-bold"><?php echo htmlspecialchars($produk['nama_produk']); ?></h5>
              <span class="badge bg-secondary"><?php echo htmlspecialchars($produk['kategori']); ?></span>
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

      <!-- Tombol Kembali di Bawah - Natural -->
      <div class="text-center mt-5 pt-4">
        <a href="beranda.php" class="btn btn-outline-dark px-4">
          <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Dashboard
        </a>
      </div>
    </div>
  </section>

  <!-- CSS untuk Loading dan Animasi -->
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
      transition: opacity 0.3s ease;
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
      animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Animasi muncul normal */
    .product-item {
      opacity: 0;
      animation: fadeIn 0.5s ease forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }

    .product-item.hidden {
      display: none;
    }

    /* Styling natural untuk tombol kembali */
    .mt-5.pt-4 {
      margin-top: 3rem !important;
      padding-top: 1.5rem !important;
      border-top: 1px solid #dee2e6;
    }
  </style>

  <!-- JavaScript untuk Loading dan Filter -->
  <script>
    // Ganti bagian JavaScript filter dengan ini:
document.addEventListener('DOMContentLoaded', function() {
  const loadingOverlay = document.querySelector('.loading-overlay');
  
  // Loading lebih cepat
  setTimeout(() => {
    loadingOverlay.classList.add('fade-out');
    setTimeout(() => loadingOverlay.remove(), 300);
  }, 200); // Kurangi dari 300ms ke 200ms

  // Filter Functionality - Optimized
  const filterButtons = document.querySelectorAll('[data-filter]');
  const productItems = document.querySelectorAll('.product-item');

  filterButtons.forEach(button => {
    button.addEventListener('click', function() {
      // Update button states
      filterButtons.forEach(btn => {
        btn.classList.remove('active', 'btn-danger');
        btn.classList.add('btn-outline-secondary');
      });

      this.classList.remove('btn-outline-secondary');
      this.classList.add('active', 'btn-danger');

      const filterValue = this.getAttribute('data-filter');

      // Optimized filtering - batch operation
      requestAnimationFrame(() => {
        productItems.forEach((item, index) => {
          const shouldShow = filterValue === 'all' || item.getAttribute('data-category') === filterValue;
          
          if (shouldShow) {
            item.classList.remove('hidden');
            // Reset animation dengan delay minimal
            item.style.animation = 'none';
            setTimeout(() => {
              item.style.animation = `fadeIn 0.3s ease forwards ${index * 0.1}s`;
            }, 10);
          } else {
            item.classList.add('hidden');
          }
        });
      });
    });
  });

  // Initial animation - lebih cepat
  productItems.forEach((item, index) => {
    item.style.animationDelay = (index * 0.1) + 's'; // Kurangi delay
  });
});
  </script>

<?php 
// Panggil footer
include '_footer.php'; 
?>