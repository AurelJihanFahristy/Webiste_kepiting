/* ================================
   File: beranda.js
   Versi: 2.0 (diperbarui)
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

// === Log Aktivasi File ===
console.log('%c✅ beranda.js berhasil dimuat dan berjalan lancar', 'color: green; font-weight: bold;');
