/* ================================
   File: beranda.js
   Versi: 2.1 (dengan Popup Produk)
   ================================ */

// === Smooth Scroll untuk link anchor ===
document.querySelectorAll('a[href^="#"]').forEach(link => {
  link.addEventListener('click', e => {
    const target = document.querySelector(link.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

// === Sticky Navbar + Efek Scroll ===
window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.navbar-custom');
  if (window.scrollY > 30) {
    navbar.classList.add('navbar-scroll', 'shadow-sm');
  } else {
    navbar.classList.remove('navbar-scroll', 'shadow-sm');
  }
});

// === Hover Effect Tombol (class-based, bukan inline) ===
document.querySelectorAll('a.btn, button').forEach(btn => {
  btn.addEventListener('mouseenter', () => btn.classList.add('btn-hover'));
  btn.addEventListener('mouseleave', () => btn.classList.remove('btn-hover'));
});

// === Highlight Navbar Aktif Berdasarkan Scroll ===
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(section => {
    const sectionTop = section.offsetTop - 100;
    if (pageYOffset >= sectionTop) {
      current = section.getAttribute('id');
    }
  });

  navLinks.forEach(link => {
    link.classList.remove('active');
    if (link.getAttribute('href') === `#${current}`) {
      link.classList.add('active');
    }
  });
});

// === Tombol "Back to Top" ===
const backToTop = document.createElement('button');
backToTop.innerHTML = '<i class="fa-solid fa-arrow-up"></i>';
backToTop.className = 'btn-back-top';
document.body.appendChild(backToTop);

window.addEventListener('scroll', () => {
  if (window.scrollY > 400) {
    backToTop.classList.add('show');
  } else {
    backToTop.classList.remove('show');
  }
});

backToTop.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

// === Popup Produk ===
const popup = document.getElementById("popupModal");
const modalImg = document.getElementById("modalImage");
const modalTitle = document.getElementById("modalTitle");
const modalDesc = document.getElementById("modalDesc");
const closeBtn = document.querySelector(".close-btn");

// Data produk
const products = {
  flowers: {
    title: "Flowers",
    img: "bakau.jpg",
    desc: "Kepiting bakau segar dengan daging tebal dan rasa manis alami. Cocok untuk sajian seafood premium dengan kualitas ekspor."
  },
  bimbo: {
    title: "Bimbo",
    img: "bakau.jpg",
    desc: "Rajungan segar dengan tekstur lembut dan cita rasa khas laut. Dagingnya manis, lembut, dan cocok untuk berbagai olahan seafood."
  },
  capit: {
    title: "Capit",
    img: "bakau.jpg",
    desc: "Menawarkan potongan daging tebal, kenyal, dan gurih yang menjadi favorit pecinta seafood sejati. Setiap gigitan menghadirkan kombinasi sempurna antara kelembutan dan rasa manis alami."
  }
};

// Event click untuk tombol detail
document.querySelectorAll('.btn-detail').forEach(btn => {
  btn.addEventListener('click', e => {
    e.preventDefault();
    const key = btn.dataset.produk;
    const p = products[key];
    if (p) {
      modalImg.src = p.img;
      modalTitle.textContent = p.title;
      modalDesc.textContent = p.desc;
      popup.style.display = "flex";
    }
  });
});

// Tutup popup
closeBtn.addEventListener('click', () => popup.style.display = "none");
window.addEventListener('click', e => {
  if (e.target === popup) popup.style.display = "none";
});


// === Fungsi Buka Modal ===
window.showPopup = function (key) {
  const p = products[key];
  modalImg.src = p.img;
  modalTitle.textContent = p.title;
  modalDesc.textContent = p.desc;
  popup.style.display = "flex";
};

// === Tutup Modal ===
closeBtn.addEventListener('click', () => popup.style.display = "none");
window.addEventListener('click', (e) => {
  if (e.target === popup) popup.style.display = "none";
});

// === Log Aktivasi File ===
console.log('%c✅ beranda.js (v2.1) berhasil dimuat dan popup aktif', 'color: green; font-weight: bold;');
