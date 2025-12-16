<?php
// Set variabel untuk halaman ini
$active_page = 'profile';
$page_title = 'Profile Perusahaan - Kepiting Segar';

// === TAMBAHKAN KODE INI SEBELUM INCLUDE HEADER ===
// KONEKSI KE DATABASE
include 'admin/koneksi.php'; // Pastikan path ini sesuai dengan struktur folder Anda

// AMBIL DATA PROFIL DARI DATABASE
$query = "SELECT * FROM profil_perusahaan WHERE id = 1";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $profil = mysqli_fetch_assoc($result);
} else {
    // Jika data tidak ditemukan, buat array default
    $profil = [
        'nama_cv' => 'CV. Pan Putra Kepri',
        'deskripsi_singkat' => 'Supplier kepiting rajungan terpercaya dengan kualitas premium.',
        'alamat' => 'Jl. Sungai Ladi RT 001/RW 003, Kel. Kp. Bugis, Kecamatan Tanjungpinang Kota',
        'whatsapp' => '088888888888',
        'email' => 'kepitingsegar@gmail.com',
        'jam_operasional' => 'Senin-Sabtu 08:00-16:00 WIB',
        'deskripsi_sejarah' => 'Berdiri sejak tahun 2009, kami telah menjadi supplier kepiting segar terpercaya di Indonesia...',
        'nama_ceo' => 'Nama CEO',
        'foto_ceo' => 'default_ceo.jpg',
        'foto_fasilitas' => 'default_fasilitas.jpg'
    ];
}
// === AKHIR TAMBAHAN ===

// Panggil header
include '_header.php';
?>

<!-- Loading Overlay -->
<div class="loading-overlay">
  <div class="loading-spinner"></div>
</div>

<section class="profile-section py-5">
  <div class="container">
    <!-- Header Section -->
    <div class="text-center mb-5">
      <h2 class="fw-bold mb-2">Profile Perusahaan</h2>
      <p class="text-muted">Mengenal lebih dekat dengan kami</p>
    </div>

    <!-- SECTION 1: Tentang Perusahaan & Fasilitas -->
    <div class="row g-4 mb-5">
      <!-- Kolom Kiri - Tentang Perusahaan -->
      <div class="col-lg-6">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body p-4" style="background: linear-gradient(135deg, var(--primary), #9b1c1c); color: white; border-radius: 18px;">
            <div class="d-flex align-items-center mb-3">
              <i class="fa-solid fa-building-columns fs-3 me-3"></i>
              <h4 class="fw-bold mb-0"><?php echo htmlspecialchars($profil['nama_cv'] ?? 'CV. Pan Putra Kepri'); ?></h4>
            </div>
            <br>
            <p class="mb-0" style="line-height: 1.8;">
              <?php 
              // Gunakan deskripsi sejarah jika ada, jika tidak gunakan default
              if (!empty($profil['deskripsi_sejarah'])) {
                  echo htmlspecialchars($profil['deskripsi_sejarah']);
              } else {
              
              }
              ?>
            </p>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan - Fasilitas -->
      <div class="col-lg-6">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
          <img
            src="admin/uploads/<?php echo htmlspecialchars($profil['foto_fasilitas'] ?? 'default_fasilitas.jpg'); ?>"
            class="profile-img-facility"
            alt="Fasilitas"
            onerror="this.src='admin/uploads/default_fasilitas.jpg'">
          <div class="card-body text-center p-4">
            <h5 class="fw-bold text-danger mb-2">
              <i class="fa-solid fa-warehouse me-2"></i>Fasilitas Modern
            </h5>
            <p class="text-muted small mb-0">
              Dilengkapi dengan fasilitas pengolahan dan penyimpanan berstandar internasional untuk menjaga kesegaran produk kami.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- SECTION 2: Informasi Kontak & CEO -->
    <div class="row g-4">
      <!-- Kolom Kiri - Informasi Kontak -->
      <div class="col-lg-6">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body p-4">
            <h5 class="fw-bold mb-4 text-danger">
              <i class="fa-solid fa-address-card me-2"></i>Informasi Kontak
            </h5>
            <ul class="contact-list">
              <li>
                <i class="fa-solid fa-location-dot text-danger"></i>
                <div>
                  <strong>Alamat</strong>
                  <span><?php echo htmlspecialchars($profil['alamat'] ?? 'Jl. Sungai Ladi RT 001/RW 003, Kel. Kp. Bugis'); ?></span>
                </div>
              </li>
              <li>
                <i class="fa-brands fa-whatsapp text-success"></i>
                <div>
                  <strong>WhatsApp</strong>
                  <span><?php echo htmlspecialchars($profil['whatsapp'] ?? '088888888888'); ?></span>
                </div>
              </li>
              <li>
                <i class="fa-regular fa-envelope text-danger"></i>
                <div>
                  <strong>Email</strong>
                  <span><?php echo htmlspecialchars($profil['email'] ?? 'kepitingsegar@gmail.com'); ?></span>
                </div>
              </li>
              <li>
                <i class="fa-regular fa-clock text-warning"></i>
                <div>
                  <strong>Jam Operasional</strong>
                  <span><?php echo htmlspecialchars($profil['jam_operasional'] ?? 'Senin-Sabtu 08:00-16:00 WIB'); ?></span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan - CEO -->
      <div class="col-lg-6">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
            <h5 class="fw-bold mb-4 text-danger w-100">
              <i class="fa-solid fa-user-tie me-2"></i>Pimpinan Perusahaan
            </h5>
            <div class="profile-ceo-wrapper mb-3">
              <img
                src="admin/uploads/<?php echo htmlspecialchars($profil['foto_ceo'] ?? 'default_ceo.jpg'); ?>"
                class="profile-img-ceo"
                alt="CEO"
                onerror="this.src='admin/uploads/default_ceo.jpg'">
            </div>
            <h5 class="fw-bold mb-1 text-dark"><?php echo htmlspecialchars($profil['nama_ceo'] ?? 'Nama CEO'); ?></h5>
            <p class="text-muted mb-1 fw-semibold">Founder & CEO</p>
            <p class="text-muted small mb-0"><?php echo htmlspecialchars($profil['nama_cv'] ?? 'CV. Pan Putra Kepri'); ?></p>
          </div>
        </div>
      </div>
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
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>

<!-- JavaScript untuk Loading -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const loadingOverlay = document.querySelector('.loading-overlay');

    setTimeout(() => {
      loadingOverlay.classList.add('fade-out');
      setTimeout(() => {
        loadingOverlay.remove();
      }, 500);
    }, 400);
  });
</script>

<?php
include '_footer.php';
?>