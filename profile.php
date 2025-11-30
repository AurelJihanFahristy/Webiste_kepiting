<?php 
// Set variabel untuk halaman ini
$active_page = 'profile';
$page_title = 'Profile Perusahaan - Kepiting Segar';

// Panggil header
// $profil sudah otomatis diambil dari _header.php
include '_header.php'; 
?>

  <!-- Loading Overlay Simple -->
  <div class="loading-overlay">
    <div class="loading-spinner"></div>
  </div>

  <section class="profile-section py-5 mt-5">
    <div class="container">
      <h2 class="fw-bold text-center mb-2">Profile Perusahaan</h2>
      <p class="text-center text-muted mb-5">Mengenal lebih dekat dengan kami</p>

      <div class="row align-items-center g-4">
        <div class="col-md-6">
          <div class="p-4 bg-danger text-white rounded-4 shadow">
            <h4 class="fw-bold"><?php echo htmlspecialchars($profil['nama_cv']); ?></h4>
            <p>Berdiri sejak tahun 2009, kami telah menjadi supplier kepiting segar terpercaya di Indonesia. Dengan pengalaman lebih dari 15 tahun, kami berkomitmen menyediakan kepiting berkualitas premium langsung dari tambak terbaik di seluruh Nusantara.</p>
          </div>
        </div>

        <div class="col-md-6 text-center">
          <div class="card shadow-sm p-3 rounded-4">
            <img src="admin/uploads/<?php echo htmlspecialchars($profil['foto_fasilitas']); ?>" class="img-fluid rounded-3" alt="Fasilitas">
            <h5 class="fw-bold mt-3">Fasilitas Modern</h5>
            <p class="text-muted">Dilengkapi dengan fasilitas pengolahan dan penyimpanan berstandar internasional untuk menjaga kesegaran produk kami.</p>
          </div>
        </div>

      <div class="row mt-5">
        <div class="col-md-6">
          <ul class="list-unstyled fs-6">
            <li><i class="fa-solid fa-location-dot text-danger me-2"></i><strong>Alamat:</strong> <?php echo htmlspecialchars($profil['alamat']); ?></li>
            <li><i class="fa-brands fa-whatsapp text-success me-2"></i><strong>WhatsApp:</strong> <?php echo htmlspecialchars($profil['whatsapp']); ?></li>
            <li><i class="fa-regular fa-envelope text-danger me-2"></i><strong>Email:</strong> <?php echo htmlspecialchars($profil['email']); ?></li>
            <li><i class="fa-regular fa-clock text-warning me-2"></i><strong>Jam Operasional:</strong> <?php echo htmlspecialchars($profil['jam_operasional']); ?></li>
          </ul>
        </div>

        <div class="col-md-6 text-center">
          <div class="card shadow-sm p-3 rounded-4">
            <img src="admin/uploads/<?php echo htmlspecialchars($profil['foto_ceo']); ?>" class="img-fluid rounded-3" alt="CEO">
            <h6 class="fw-bold mt-3"><?php echo htmlspecialchars($profil['nama_ceo']); ?></h6>
            <p class="text-muted">Founder & CEO <?php echo htmlspecialchars($profil['nama_cv']); ?></p>
          </div>
        </div>
      </div>

      <div class="text-center mt-5">
        <a href="beranda.php" class="btn btn-dark">
          <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
      </div>
    </div>
  </section>

  <!-- CSS untuk Loading Spinner -->
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
      transition: opacity 0.5s ease;
    }

    .loading-overlay.fade-out {
      opacity: 0;
      pointer-events: none;
    }

    .loading-spinner {
      width: 50px;
      height: 50px;
      border: 4px solid #f3f3f3;
      border-top: 4px solid #dc3545;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>

  <!-- JavaScript untuk Loading 3 Detik -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const loadingOverlay = document.querySelector('.loading-overlay');
      
      // Loading selama 3 detik
      setTimeout(() => {
        loadingOverlay.classList.add('fade-out');
        
        // Hapus element setelah animasi selesai
        setTimeout(() => {
          loadingOverlay.remove();
        }, 200);
      }, 400); 
    });
  </script>

<?php 
// Panggil footer
include '_footer.php'; 
?>