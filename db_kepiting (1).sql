-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 30 Nov 2025 pada 10.01
-- Versi server: 9.1.0
-- Versi PHP: 7.4.33

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `gambar`, `kategori`, `is_unggulan`) VALUES
(2, 'Daging Bimbo', 'Daging Rajungan Bimbo adalah potongan daging kualitas tertinggi dan paling premium yang kami sediakan. Istilah \"Bimbo\" kami gunakan untuk merujuk pada daging utuh yang berasal dari bagian perut (body meat) dan pangkal kaki rajungan. Ini adalah grade tertinggi dan termahal dari semua daging rajungan karena teksturnya yang paling padat dan utuh. Daging Bimbo menawarkan rasa manis alami yang paling intens dan gurih, menjadikannya pilihan utama para koki profesional. Daging eksklusif ini sangat ideal untuk hidangan mewah yang menonjolkan visual dan rasa premium, seperti seafood cocktail, salad premium, atau isian utama.', '1764403725_admin_WhatsApp Image 2025-11-29 at 15.08.00_c8c76351.jpg', 'bimbo', 1),
(3, 'Daging Capit', 'daging pada capit kepiting yang sudah dikupas', '1764403185_admin_WhatsApp Image 2025-11-29 at 14.59.17_a150060b.jpg', 'capit', 0),
(6, 'Daging Capit', 'flow', '1764402601_admin_WhatsApp Image 2025-11-29 at 14.49.39_9585aaae.jpg', 'capit', 0),
(8, 'Daging Capit', 'kiu', '1764402983_admin_WhatsApp Image 2025-11-29 at 14.55.53_b14a55cc.jpg', 'capit', 0),
(9, 'Daging Capit', 'Daging Rajungan Capit (Claw Meat) diambil eksklusif dari cakar rajungan, ditandai dengan warna gelap kemerahan dan tekstur padat. Daging ini memiliki profil rasa yang sangat kuat, gurih mendalam, dan robust, sehingga ideal untuk masakan berbumbu kaya. Penggunaannya sangat cocok untuk hidangan seperti sup kental, tumisan pedas, atau saus pasta, di mana karakter rasa rajungan yang intens ingin ditonjolkan.', '1764403317_admin_WhatsApp Image 2025-11-29 at 15.01.04_66484f56.jpg', 'capit', 1),
(10, 'Daging Bimbo', 'bimbo', '1764404438_admin_WhatsApp Image 2025-11-29 at 15.19.48_c6bc239e.jpg', 'bimbo', 0),
(11, 'Daging Bimbo', 'DAGING BIMBO', '1764405389_admin_WhatsApp Image 2025-11-29 at 15.36.03_2efdbfe7.jpg', 'bimbo', 0),
(12, 'Daging Bimbo', 'bimbo', '1764405631_admin_WhatsApp Image 2025-11-29 at 15.40.07_a8e6a26b.jpg', 'bimbo', 0),
(13, 'Daging Bimbo', 'bimbo', '1764405724_admin_Gemini_Generated_Image_injvvainjvvainjv.png', 'bimbo', 0),
(14, 'Daging Bimbo', 'kjkj', '1764405844_admin_Gemini_Generated_Image_cpk2rycpk2rycpk2.png', 'bimbo', 0),
(15, 'Daging Capit', 'capit', '1764406156_admin_Gemini_Generated_Image_uhx1lzuhx1lzuhx1.png', 'capit', 0),
(16, 'Daging Capit', 'capit', '1764406237_admin_Gemini_Generated_Image_n83wu8n83wu8n83w.png', 'capit', 0),
(17, 'Daging Flowers', 'Daging Rajungan Flowers (Flake Meat) adalah perpaduan potongan daging yang diekstrak dari berbagai bagian tubuh, utamanya dari area serpihan daging kaki (flake) dan sebagian kecil dari tubuh. Daging ini dikumpulkan dan disusun secara cermat dalam wadah melingkar sehingga menyerupai bentuk bunga yang mekar sempurna.\r\n\r\nMeskipun bukan grade tertinggi seperti Bimbo, Daging Flowers menawarkan tekstur yang lembut dan flaky (berserpih), menjadikannya sangat mudah diintegrasikan ke dalam berbagai resep. Daging ini memiliki rasa rajungan yang manis dan light.\r\n\r\nDaging Flowers sangat serbaguna dan ideal untuk isian sandwich atau roll, campuran salad ringan, omelet, atau sebagai bahan utama dalam sup seafood bening di mana Anda ingin menghadirkan presentasi yang rapi dan menarik. Keindahan penyajiannya dalam bentuk \"bunga\" ini juga membuatnya cocok untuk display hidangan pesta.', '1764491505_admin_WhatsApp Image 2025-11-30 at 15.31.26_864c8439.jpg', 'flower', 0),
(18, 'Daging Flowers', 'FLOWER', '1764408504_admin_WhatsApp Image 2025-11-29 at 16.28.09_8544cfc4.jpg', 'flower', 0),
(19, 'Daging Flowers', 'Daging Rajungan Flowers (Flake Meat) adalah perpaduan potongan daging serpihan yang diambil dari kaki dan sebagian kecil tubuh rajungan, lalu disusun cermat menyerupai bentuk bunga mekar. Meskipun bukan grade tertinggi, daging ini memiliki tekstur lembut dan flaky (berserpih), serta menawarkan rasa rajungan yang manis dan light. Daging ini sangat serbaguna, ideal untuk isian sandwich atau roll, campuran salad ringan, omelet, atau sup seafood bening, dan penyajiannya yang unik juga cocok untuk display hidangan pesta.', '1764408597_admin_WhatsApp Image 2025-11-29 at 16.29.29_b620ebd9.jpg', 'flower', 1);

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
(1, 'CV. pan putra kepri', 'Supplier kepiting rajungan terpercaya dengan kualitas premium.', 'Jl. Pelabuhan Raya No. 45, Muara Baru, Jakarta Utara 14440', '+6281234567890', 'info@kepitingsegar.co.id', 'Senin–Sabtu 08:00–16:00 WIB', 'Bapak Ahmad Suryadi', '1764409977_admin_SharedScreenshot.jpg', '1764427394_admin_WhatsApp Image 2025-11-29 at 21.42.43_16b9fe6c.jpg');

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
(1, 21, 2500, 3, 9.8);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
