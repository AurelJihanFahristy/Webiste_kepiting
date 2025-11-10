<?php 
// Set variabel untuk halaman ini
$active_page = 'profile';
$page_title = 'Profile Perusahaan - Kepiting Segar';

// Panggil header
// $profil sudah otomatis diambil dari _header.php
include '_header.php'; 
?>

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

<?php 
// Panggil footer
include '_footer.php'; 
?>