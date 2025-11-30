-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 10 Nov 2025 pada 17.41
-- Versi server: 9.1.0
-- Versi PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kepiting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$X/X7L59Mya2JflP3NSZqxOa9t1r3DKDA6CtplBtKwZieTAD.Dzbxy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kategori` enum('flower','bimbo','capit') NOT NULL,
  `is_unggulan` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `gambar`, `kategori`, `is_unggulan`) VALUES
(2, 'fresh rajungan', 'rajungan fresh yang baru saja ditangkap oleh para nelayan atau masyarakat', '1762790906_admin_kepiting2.jpeg', 'bimbo', 1),
(3, 'crab clow meat', 'daging pada capit kepiting yang sudah dikupas', '1762791061_admin_kepiting3.jpeg', 'capit', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_perusahaan`
--

DROP TABLE IF EXISTS `profil_perusahaan`;
CREATE TABLE IF NOT EXISTS `profil_perusahaan` (
  `id` int NOT NULL DEFAULT '1',
  `nama_cv` varchar(255) NOT NULL,
  `deskripsi_singkat` text NOT NULL,
  `alamat` text NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jam_operasional` varchar(100) NOT NULL,
  `nama_ceo` varchar(150) NOT NULL,
  `foto_ceo` varchar(255) NOT NULL,
  `foto_fasilitas` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `profil_perusahaan`
--

INSERT INTO `profil_perusahaan` (`id`, `nama_cv`, `deskripsi_singkat`, `alamat`, `whatsapp`, `email`, `jam_operasional`, `nama_ceo`, `foto_ceo`, `foto_fasilitas`) VALUES
(1, 'CV. Kepiting Segar Nusantara', 'Supplier kepiting segar terpercaya dengan kualitas premium.', 'Jl. Pelabuhan Raya No. 45, Muara Baru, Jakarta Utara 14440', '+6281234567890', 'info@kepitingsegar.co.id', 'Senin–Sabtu 06:00–18:00 WIB', 'Bapak Ahmad Suryadi', '1762791725_admin_ceo kepiting.jpg', 'cv.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `statistik`
--

DROP TABLE IF EXISTS `statistik`;
CREATE TABLE IF NOT EXISTS `statistik` (
  `id` int NOT NULL DEFAULT '1',
  `tahun_berpengalaman` int NOT NULL,
  `pelanggan_puas` int NOT NULL,
  `jenis_daging` int NOT NULL,
  `rating_kepuasan` decimal(3,1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `statistik`
--

INSERT INTO `statistik` (`id`, `tahun_berpengalaman`, `pelanggan_puas`, `jenis_daging`, `rating_kepuasan`) VALUES
(1, 21, 2500, 4, 9.8);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
