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

  <section class="gallery-section py-4 py-md-5">
    <div class="container">
      <!-- Header -->
      <div class="text-center mb-4 mb-md-5">
        <h2 class="fw-bold mb-2">Gallery Kepiting Premium</h2>
        <p class="text-muted">Koleksi lengkap daging kepiting segar berkualitas tinggi</p>
      </div>

      <!-- Filter Kategori -->
      <div class="text-center mb-4 mb-md-5">
        <div class="btn-group flex-wrap" role="group" aria-label="Filter kategori produk">
          <button class="btn btn-danger active mb-1 mb-md-0" data-filter="all">Semua</button>
          <button class="btn btn-outline-secondary mb-1 mb-md-0" data-filter="bimbo">Bimbo</button>
          <button class="btn btn-outline-secondary mb-1 mb-md-0" data-filter="flower">Flower</button>
          <button class="btn btn-outline-secondary mb-1 mb-md-0" data-filter="capit">Capit</button>
          <button class="btn btn-outline-secondary mb-1 mb-md-0" data-filter="kaki">Kaki</button>
        </div>
      </div>

      <div class="row g-3 g-md-4 justify-content-center" id="product-grid">

        <?php
        // Loop untuk menampilkan SEMUA produk
        if (mysqli_num_rows($result_produk) > 0) {
            while ($produk = mysqli_fetch_assoc($result_produk)) {
        ?>
        
        <div class="col-6 col-md-4 col-lg-3 product-item" data-category="<?php echo htmlspecialchars($produk['kategori']); ?>">
          <div class="card product-card shadow-sm h-100">
            <div class="card-img-wrapper">
              <img src="admin/uploads/<?php echo htmlspecialchars($produk['gambar']); ?>" 
                   class="card-img-top" 
                   alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>"
                   loading="lazy">
            </div>
            <div class="card-body text-center d-flex flex-column">
              <h5 class="fw-bold card-title mb-2"><?php echo htmlspecialchars($produk['nama_produk']); ?></h5>
              <span class="badge bg-secondary mt-auto"><?php echo htmlspecialchars($produk['kategori']); ?></span>
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

    </div>
  </section>

  <!-- CSS untuk Loading, Animasi, dan Responsif -->
  <style>
    /* Loading Styles */
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

    /* Responsive Gallery Styles */
    .btn-group.flex-wrap {
      gap: 0.25rem;
    }
    
    .btn-group .btn {
      font-size: 0.875rem;
      padding: 0.375rem 0.75rem;
    }
    
    @media (max-width: 576px) {
      .btn-group .btn {
        font-size: 0.8rem;
        padding: 0.3rem 0.6rem;
      }
      
      .gallery-section h2 {
        font-size: 1.5rem;
      }
      
      .gallery-section p {
        font-size: 0.9rem;
      }
    }

    /* Product Card Styles */
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

    .product-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
      border-radius: 10px;
      overflow: hidden;
    }
    
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .card-img-wrapper {
      overflow: hidden;
      height: 180px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f8f9fa;
    }
    
    @media (max-width: 768px) {
      .card-img-wrapper {
        height: 150px;
      }
    }
    
    @media (max-width: 576px) {
      .card-img-wrapper {
        height: 120px;
      }
    }
    
    .card-img-top {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    
    .product-card:hover .card-img-top {
      transform: scale(1.05);
    }
    
    .card-body {
      padding: 1rem;
    }
    
    @media (max-width: 576px) {
      .card-body {
        padding: 0.75rem;
      }
      
      .card-title {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
      }
      
      .badge {
        font-size: 0.75rem;
      }
    }
    
    .badge {
      align-self: center;
      padding: 0.35em 0.65em;
    }

    /* Touch-friendly improvements */
    .btn {
      min-height: 38px;
      min-width: 44px; /* Minimum touch target size */
    }
    
    @media (max-width: 576px) {
      .btn {
        min-height: 36px;
      }
    }

    /* Styling natural untuk tombol kembali */
    .mt-5.pt-4 {
      margin-top: 3rem !important;
      padding-top: 1.5rem !important;
      border-top: 1px solid #dee2e6;
    }
    
    /* Improve row spacing on mobile */
    .row.g-3 {
      --bs-gutter-x: 0.75rem;
      --bs-gutter-y: 0.75rem;
    }
    
    /* Card height consistency */
    .h-100 {
      height: 100%;
    }
  </style>

  <!-- JavaScript untuk Loading dan Filter -->
  <script>
document.addEventListener('DOMContentLoaded', function() {
  const loadingOverlay = document.querySelector('.loading-overlay');
  
  // Loading lebih cepat
  setTimeout(() => {
    loadingOverlay.classList.add('fade-out');
    setTimeout(() => loadingOverlay.remove(), 300);
  }, 200);

  // Filter Functionality - DIPERCEPAT
  const filterButtons = document.querySelectorAll('[data-filter]');
  const productItems = document.querySelectorAll('.product-item');

  // Debug: Tampilkan semua kategori yang ada
  console.log('Produk kategori:');
  productItems.forEach(item => {
    console.log('-', item.getAttribute('data-category'));
  });

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
      console.log('Filter aktif:', filterValue); // Debug

      // DIPERCEPAT: Hilangkan requestAnimationFrame untuk response lebih cepat
      const startTime = performance.now();
      
      productItems.forEach((item, index) => {
        const itemCategory = item.getAttribute('data-category');
        const shouldShow = filterValue === 'all' || itemCategory === filterValue;
        
        if (shouldShow) {
          item.classList.remove('hidden');
          // ANIMASI LEBIH CEPAT
          item.style.opacity = '0';
          item.style.transform = 'translateY(10px)';
          setTimeout(() => {
            item.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
          }, index * 50); // Delay lebih pendek: 50ms
        } else {
          item.classList.add('hidden');
          item.style.opacity = '0';
          item.style.transform = 'translateY(10px)';
        }
      });
      
      const endTime = performance.now();
      console.log(`Filter selesai dalam ${(endTime - startTime).toFixed(2)}ms`);
    });
  });

  // Initial animation - DIPERCEPAT
  productItems.forEach((item, index) => {
    setTimeout(() => {
      item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
      item.style.opacity = '1';
      item.style.transform = 'translateY(0)';
    }, index * 70); // Lebih cepat: 70ms per item
  });
  
  // Touch improvements
  document.querySelectorAll('.product-card').forEach(card => {
    card.style.cursor = 'pointer';
    card.addEventListener('touchstart', function() {
      this.style.transform = 'scale(0.98)';
    });
    card.addEventListener('touchend', function() {
      this.style.transform = '';
    });
  });
});
  </script>

<?php 
// Panggil footer
include '_footer.php'; 
?>