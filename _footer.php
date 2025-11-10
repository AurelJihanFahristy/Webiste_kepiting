<footer class="footer text-white pt-5 pb-3">
    <div class="container">
      <div class="row gy-4">

        <div class="col-md-4">
          <div class="d-flex align-items-center mb-3">
            <div class="logo-footer bg-danger rounded-circle text-center me-3">
              <i class="fa-solid fa-anchor fa-lg text-white"></i>
            </div>
            <h4 class="fw-bold"><?php echo htmlspecialchars($profil['nama_cv']); ?></h4>
          </div>
          <p class="text-light small">
            <?php echo htmlspecialchars($profil['deskripsi_singkat']); ?>
          </p>

          <div class="social-icons d-flex gap-3 mt-3">
            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/<?php echo htmlspecialchars($profil['whatsapp']); ?>" target="_blank" class="social-link"><i class="fab fa-whatsapp"></i></a>
          </div>
        </div>

         <div class="col-md-4">
          <h5 class="fw-bold mb-3">Quick Links</h5>
          <ul class="list-unstyled footer-links">
            <li><a href="beranda.php">Dashboard</a></li>
            <li><a href="gallery.php">Gallery Produk</a></li>
            <li><a href="profile.php">Profile Perusahaan</a></li>
            </ul>
        </div>

        <div class="col-md-4">
          <h5 class="fw-bold mb-3">Kontak Kami</h5>
          <ul class="list-unstyled footer-contact">
            <li><i class="fa-solid fa-location-dot me-2 text-danger"></i>
                <?php echo nl2br(htmlspecialchars($profil['alamat'])); // nl2br untuk ganti baris baru jika ada ?>
            </li>
            <li class="mt-2"><i class="fa-brands fa-whatsapp me-2 text-success"></i><?php echo htmlspecialchars($profil['whatsapp']); ?></li>
            <li class="mt-2"><i class="fa-regular fa-envelope me-2 text-danger"></i><?php echo htmlspecialchars($profil['email']); ?></li>
          </ul>
        </div>

      </div>

      <hr class="my-4 text-secondary">

      <div class="text-center">
        <p class="small mb-0">© <?php echo date('Y'); ?> <?php echo htmlspecialchars($profil['nama_cv']); ?>. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>