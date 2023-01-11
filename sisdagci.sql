-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 Feb 2022 pada 16.24
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisdagci`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `gambar_admin` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`username`, `password`, `nama_lengkap`, `gambar_admin`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator', 'admin.jpeg'),
('dyki', '203a084707f0f18402eab4ef524218ac', 'Dyki Meika Setyawan', 'dyki.jpg'),
('ilyas', '3ea4a8e4d7a95ace878f907ab8b72d1b', 'drh.Ilyas Fathoni', 'pakar.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_basispengetahuan`
--

CREATE TABLE `tbl_basispengetahuan` (
  `kd_pengetahuan` int(11) NOT NULL,
  `kd_penyakit` int(11) NOT NULL,
  `kd_gejala` int(11) NOT NULL,
  `mb` double(11,1) NOT NULL,
  `md` double(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_basispengetahuan`
--

INSERT INTO `tbl_basispengetahuan` (`kd_pengetahuan`, `kd_penyakit`, `kd_gejala`, `mb`, `md`) VALUES
(1, 1, 1, 0.6, 0.2),
(2, 1, 2, 0.8, 0.2),
(3, 1, 3, 0.6, 0.2),
(4, 1, 4, 0.6, 0.4),
(5, 1, 5, 0.8, 0.2),
(6, 2, 3, 0.6, 0.2),
(7, 2, 6, 0.8, 0.2),
(8, 2, 7, 0.6, 0.2),
(9, 2, 8, 0.6, 0.2),
(10, 3, 5, 0.6, 0.4),
(11, 3, 9, 0.6, 0.4),
(12, 3, 10, 0.8, 0.2),
(13, 3, 11, 0.6, 0.4),
(14, 3, 12, 0.6, 0.4),
(15, 3, 13, 0.6, 0.4),
(16, 3, 21, 0.6, 0.2),
(17, 4, 5, 0.6, 0.2),
(18, 4, 14, 0.8, 0.6),
(19, 4, 15, 0.6, 0.4),
(20, 4, 16, 0.8, 0.2),
(21, 4, 17, 0.6, 0.4),
(22, 4, 21, 0.6, 0.2),
(23, 5, 1, 0.6, 0.4),
(24, 5, 5, 0.6, 0.2),
(25, 5, 18, 0.6, 0.4),
(26, 5, 19, 0.8, 0.2),
(27, 5, 20, 0.6, 0.4),
(28, 5, 21, 0.6, 0.4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gejala`
--

CREATE TABLE `tbl_gejala` (
  `kd_gejala` int(11) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL,
  `detail_gejala` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_gejala`
--

INSERT INTO `tbl_gejala` (`kd_gejala`, `nama_gejala`, `detail_gejala`) VALUES
(1, 'Anorexia (Hilangnya nafsu makan/menolak makan)', 'Kelinci menolak untuk makan, dilihat dari jika diberikan makanan kelinnci sama sekali tidak makan seperti biasanya.'),
(2, 'Pasase feses berkurang', 'Kelinci tidak mengeluarkan kotoran seperti biasanya, atau kotoran kelinci hanya sedikit.'),
(3, 'Penurunan berat badan', 'Bobot kelinci turun drastis, bobot tidak sesuai dengan usianya, dan terlihat kurus.'),
(4, 'Minum berkurang', 'Kelinci terlihat jarang minum tidak seperti biasanya, jika terdapat wadah minum untuk kelinci bisa dilihat untuk takaran airnya.'),
(5, 'Lemas', 'Kelinci terilihat lesu, tidak aktif banyak gerak atau melompat kesana kemari seperti biasanya.'),
(6, 'Diare berdarah', 'kelinci dikatakan diare berdarah apabila kotoran atau tinja kelinci encer atau berair disertai darah pada fases.'),
(7, 'Nafsu makan turun', 'Kelinci yang nafsu makanya turun biasaya jika disetiap pemberian makanan kelinci hanya mengendus ngendus makananya lalu pergi atau terkadang mau makan tetapi hanya sedikit seolah-olah hanya menyincipi saja.'),
(8, 'Manajemen pemeliharaan yg buruk', 'Manajemen pemeliharaan yang buruk salah satunya dilihat dari faktor kebersihan lingkungan atau kandang, karena kelinci rawan terserang penyakit disebabkan oleh lingkungan atau kandang yang kotor atau tidak dijaga kebersihanya.'),
(9, 'Polidipsi(Banyak Minum)', 'Haus yang berlebihan pada kelinci, biasanya kelinci minum terus menerus atau banyak minum tidak seperti biasanya.'),
(10, 'Diare cair berwarna kecoklatan', 'Kelinci dikatakan diare cair kecoklatan apabila kotoran atau tinja kelinci encer atau berair dan terlihat berwarna kecoklatan.'),
(11, 'Tooth grinding (Menggesekan gigi secara berlebih)', 'Kelinci sering menggesekan gigi secara berlebih.'),
(12, 'Cyanosis mukosa(Perubahan tidak normal pada warna kulit dan selaput lendir)', 'Normalnya warna kulit dan selaput lendir(membaran mukosa seperti gusi, bagian dalam bibir, kelopak mata) pada kelinci berwarna pink rose. Namum terdapat perubahan warna yang tidak normal pada selaput lendir.'),
(13, 'Penurunan suhu tubuh ', 'Penurunan suhu tubuh kelinci, suhu tubuh kelinci yang normal antara 37-40 derajat celcius.'),
(14, 'Diare', 'Kelinci dikatakan diare apabila kotoran atau tinja kelinci encer atau berair.'),
(15, 'Dehidrasi', 'Mata terlihat murung, cekung, dan kusam. Kelinci bernapas terengah-engah sangat cepat dengan mulut terbuka. Perhatikan kelinci tidak minum air. '),
(16, 'Menyerang kelinci usia sapih(6 - 12 mgg)', 'Apakah kelinci anda berada diusia sapih? Pada umumnya usia sapih diantara rentang waktu 6 sampai dengan 12 minggu.'),
(17, 'Kelinci dipelihra pada kepadatan populasi tinggi', 'Kelinci dipelihara pada satu tempat yang memiliki kepadatan jumlah kelinci. Atau overload kapasitas kandang.'),
(18, 'Ambruk tiba-tiba', 'Yang biasanya kelinci mempunyai gerakan dan kelincahan bergerak tetapi kelinci mendadak kehilangan kelincahan hingga tidak kuat untuk berjalan.'),
(19, 'Sakit pada area perut(Kelinci sering memegang perut)', 'Biasanya kelinci akan terlihat kesakitan terkadang kelinci mengusap ngusap atau memegangi perut.'),
(20, 'Kembung ', 'Dinding rongga perut mulai membuncit dan keras ketika dipegang.'),
(21, 'Perubahan tiba-tiba(pakan, tempat)', 'Perubahan tiba-tiba yang dimaksut adalah jika kelinci terlalu sering dipindahkan atau terlalu sering gonta ganti makananya.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `kd_hasil` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelinci` varchar(100) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `penyakit` text NOT NULL,
  `gejala` text NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `hasil_nilai` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hasil`
--

INSERT INTO `tbl_hasil` (`kd_hasil`, `nama`, `jenis_kelinci`, `tanggal`, `penyakit`, `gejala`, `hasil_id`, `hasil_nilai`) VALUES
(1, 'Riyan Adi', 'Rex', '2021-10-27 21:59:07', 'a:5:{i:2;s:6:\"0.8594\";i:1;s:6:\"0.6464\";i:4;s:6:\"0.3200\";i:5;s:6:\"0.3200\";i:3;s:6:\"0.1600\";}', 'a:5:{i:3;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"1\";i:7;s:1:\"2\";i:8;s:1:\"3\";}', 2, '0.8594'),
(2, 'Fajar Setyo', 'New Zeland', '2021-10-27 22:03:13', 'a:4:{i:4;s:6:\"0.8629\";i:5;s:6:\"0.6097\";i:1;s:6:\"0.6000\";i:3;s:6:\"0.4560\";}', 'a:6:{i:5;s:1:\"1\";i:14;s:1:\"2\";i:16;s:1:\"1\";i:18;s:1:\"3\";i:20;s:1:\"3\";i:21;s:1:\"2\";}', 4, '0.8629'),
(3, 'Yusuf', 'New Zeland', '2021-10-27 22:06:42', 'a:5:{i:1;s:6:\"0.9253\";i:5;s:6:\"0.4288\";i:2;s:6:\"0.4000\";i:4;s:6:\"0.3200\";i:3;s:6:\"0.1600\";}', 'a:5:{i:1;s:1:\"2\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"3\";i:5;s:1:\"2\";}', 1, '0.9253'),
(4, 'Yovie', 'New Zeland', '2021-10-27 22:09:49', 'a:4:{i:3;s:6:\"0.8748\";i:4;s:6:\"0.5920\";i:1;s:6:\"0.4800\";i:5;s:6:\"0.4560\";}', 'a:6:{i:5;s:1:\"2\";i:10;s:1:\"1\";i:11;s:1:\"3\";i:12;s:1:\"2\";i:13;s:1:\"2\";i:21;s:1:\"1\";}', 3, '0.8748'),
(5, 'Anggi', 'Rex', '2021-10-27 22:11:51', 'a:4:{i:5;s:6:\"0.8239\";i:1;s:6:\"0.7280\";i:4;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:5:{i:1;s:1:\"2\";i:5;s:1:\"1\";i:18;s:1:\"1\";i:19;s:1:\"2\";i:20;s:1:\"2\";}', 5, '0.8239'),
(6, 'Ari', 'Flamish Giant', '2021-10-28 09:33:41', 'a:4:{i:1;s:6:\"0.6000\";i:4;s:6:\"0.5968\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:3:{i:5;s:1:\"1\";i:14;s:1:\"1\";i:17;s:1:\"2\";}', 1, '0.6000'),
(7, 'Iyan', 'Rex', '2021-10-28 09:36:23', 'a:4:{i:4;s:6:\"0.6283\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:4:{i:5;s:1:\"1\";i:14;s:1:\"3\";i:15;s:1:\"1\";i:17;s:1:\"3\";}', 4, '0.6283'),
(8, 'Yudhi', 'Himalayan', '2021-10-28 09:38:00', 'a:2:{i:2;s:6:\"0.8150\";i:1;s:6:\"0.3200\";}', 'a:3:{i:3;s:1:\"2\";i:6;s:1:\"1\";i:7;s:1:\"2\";}', 2, '0.8150'),
(9, 'Yunni', 'Rex', '2021-10-28 09:39:55', 'a:4:{i:3;s:6:\"0.8172\";i:1;s:6:\"0.6000\";i:4;s:6:\"0.5920\";i:5;s:6:\"0.4960\";}', 'a:4:{i:5;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"2\";i:21;s:1:\"2\";}', 3, '0.8172'),
(10, 'Usman', 'Rex', '2021-10-28 09:41:45', 'a:2:{i:2;s:6:\"0.8560\";i:1;s:6:\"0.4000\";}', 'a:3:{i:3;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}', 2, '0.8560'),
(11, 'Dipa', 'Anggora', '2021-10-28 09:42:55', 'a:1:{i:2;s:6:\"0.7600\";}', 'a:2:{i:6;s:1:\"1\";i:7;s:1:\"1\";}', 2, '0.7600'),
(12, 'Nui', 'Rex', '2021-10-28 09:44:11', 'a:5:{i:2;s:6:\"0.6000\";i:1;s:6:\"0.4800\";i:4;s:6:\"0.3200\";i:5;s:6:\"0.3200\";i:3;s:6:\"0.1600\";}', 'a:2:{i:5;s:1:\"2\";i:6;s:1:\"1\";}', 2, '0.6000'),
(13, 'Yannuar', 'Flamish Giant', '2021-10-28 09:46:31', 'a:5:{i:1;s:6:\"0.6000\";i:4;s:6:\"0.5200\";i:5;s:6:\"0.4960\";i:2;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:4:{i:5;s:1:\"1\";i:7;s:1:\"1\";i:14;s:1:\"1\";i:18;s:1:\"2\";}', 1, '0.6000'),
(14, 'Andre', 'Flamish Giant', '2021-10-28 09:48:46', 'a:4:{i:3;s:6:\"0.7742\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.4000\";i:4;s:6:\"0.4000\";}', 'a:4:{i:5;s:1:\"1\";i:9;s:1:\"2\";i:10;s:1:\"1\";i:11;s:1:\"2\";}', 3, '0.7742'),
(15, 'Agil', 'New Zeland', '2021-10-28 09:50:13', 'a:4:{i:4;s:6:\"0.7504\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:3:{i:5;s:1:\"1\";i:14;s:1:\"1\";i:16;s:1:\"2\";}', 4, '0.7504'),
(16, 'DYKI', 'Rex', '2021-12-25 05:30:27', 'a:2:{i:1;s:6:\"0.4000\";i:5;s:6:\"0.2000\";}', 'a:1:{i:1;s:1:\"1\";}', 1, '0.4000'),
(17, 'DYKI', 'Rex', '2021-12-25 05:35:44', 'a:2:{i:1;s:6:\"0.4000\";i:5;s:6:\"0.2000\";}', 'a:1:{i:1;s:1:\"1\";}', 1, '0.4000'),
(18, 'DYKI', 'Rex', '2021-12-25 05:37:37', 'a:2:{i:1;s:6:\"0.7600\";i:5;s:6:\"0.2000\";}', 'a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}', 1, '0.7600'),
(19, 'DYKI', 'Rex', '2021-12-25 05:38:48', 'a:3:{i:1;s:6:\"0.8560\";i:2;s:6:\"0.4000\";i:5;s:6:\"0.2000\";}', 'a:3:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";}', 1, '0.8560'),
(20, 'DYKI', 'Rex', '2021-12-25 05:40:00', 'a:3:{i:1;s:6:\"0.8848\";i:2;s:6:\"0.4000\";i:5;s:6:\"0.2000\";}', 'a:4:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";}', 1, '0.8848'),
(21, 'DYKI', 'Rex', '2021-12-25 05:41:07', 'a:5:{i:1;s:6:\"0.9539\";i:5;s:6:\"0.5200\";i:4;s:6:\"0.4000\";i:2;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}', 1, '0.9539'),
(22, 'DYKI', 'Lop', '2021-12-25 05:42:39', 'a:2:{i:2;s:6:\"0.4000\";i:1;s:6:\"0.4000\";}', 'a:1:{i:3;s:1:\"1\";}', 2, '0.4000'),
(23, 'DYKI', 'Lop', '2021-12-25 05:44:09', 'a:2:{i:2;s:6:\"0.7600\";i:1;s:6:\"0.4000\";}', 'a:2:{i:3;s:1:\"1\";i:6;s:1:\"1\";}', 2, '0.7600'),
(24, 'DYKI', 'Lop', '2021-12-25 05:45:21', 'a:2:{i:2;s:6:\"0.8560\";i:1;s:6:\"0.4000\";}', 'a:3:{i:3;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}', 2, '0.8560'),
(25, 'DYKI', 'New Zeland', '2021-12-25 05:46:21', 'a:4:{i:1;s:6:\"0.6000\";i:4;s:6:\"0.4000\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:1:{i:5;s:1:\"1\";}', 1, '0.6000'),
(26, 'DYKI', 'New Zeland', '2021-12-25 05:47:27', 'a:4:{i:1;s:6:\"0.6000\";i:4;s:6:\"0.4000\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.3600\";}', 'a:2:{i:5;s:1:\"1\";i:9;s:1:\"1\";}', 1, '0.6000'),
(27, 'DYKI', 'New Zeland', '2021-12-25 05:48:52', 'a:4:{i:3;s:6:\"0.7952\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.4000\";i:4;s:6:\"0.4000\";}', 'a:4:{i:5;s:1:\"1\";i:9;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"1\";}', 3, '0.7952'),
(28, 'DYKI', 'New Zeland', '2021-12-25 05:50:27', 'a:4:{i:3;s:6:\"0.8362\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.4000\";i:4;s:6:\"0.4000\";}', 'a:5:{i:5;s:1:\"1\";i:9;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"1\";i:12;s:1:\"1\";}', 3, '0.8362'),
(29, 'DYKI', 'New Zeland', '2021-12-25 05:51:50', 'a:4:{i:3;s:6:\"0.8689\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.4000\";i:4;s:6:\"0.4000\";}', 'a:6:{i:5;s:1:\"1\";i:9;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"1\";i:12;s:1:\"1\";i:13;s:1:\"1\";}', 3, '0.8689'),
(30, 'DYKI', 'New Zeland', '2021-12-25 05:53:28', 'a:4:{i:3;s:6:\"0.9214\";i:4;s:6:\"0.6400\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.5200\";}', 'a:7:{i:5;s:1:\"1\";i:9;s:1:\"1\";i:10;s:1:\"1\";i:11;s:1:\"1\";i:12;s:1:\"1\";i:13;s:1:\"1\";i:21;s:1:\"1\";}', 3, '0.9214'),
(31, 'DYKI', 'Flamish Giant', '2021-12-25 06:00:22', 'a:4:{i:1;s:6:\"0.6000\";i:4;s:6:\"0.4000\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:1:{i:5;s:1:\"1\";}', 1, '0.6000'),
(32, 'DYKI', 'Flamish Giant', '2021-12-25 06:01:36', 'a:4:{i:1;s:6:\"0.6000\";i:4;s:6:\"0.5200\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:2:{i:5;s:1:\"1\";i:14;s:1:\"1\";}', 1, '0.6000'),
(33, 'DYKI', 'Flamish Giant', '2021-12-25 06:02:57', 'a:4:{i:4;s:6:\"0.6160\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:3:{i:5;s:1:\"1\";i:14;s:1:\"1\";i:15;s:1:\"1\";}', 4, '0.6160'),
(34, 'DYKI', 'Flamish Giant', '2021-12-25 06:04:26', 'a:4:{i:4;s:6:\"0.8464\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:4:{i:5;s:1:\"1\";i:14;s:1:\"1\";i:15;s:1:\"1\";i:16;s:1:\"1\";}', 4, '0.8464'),
(35, 'DYKI', 'Flamish Giant', '2021-12-25 06:06:19', 'a:4:{i:4;s:6:\"0.8771\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:5:{i:5;s:1:\"1\";i:14;s:1:\"1\";i:15;s:1:\"1\";i:16;s:1:\"1\";i:17;s:1:\"1\";}', 4, '0.8771'),
(36, 'DYKI', 'Flamish Giant', '2021-12-25 06:07:52', 'a:4:{i:4;s:6:\"0.9263\";i:1;s:6:\"0.6000\";i:5;s:6:\"0.5200\";i:3;s:6:\"0.5200\";}', 'a:6:{i:5;s:1:\"1\";i:14;s:1:\"1\";i:15;s:1:\"1\";i:16;s:1:\"1\";i:17;s:1:\"1\";i:21;s:1:\"1\";}', 4, '0.9263'),
(37, 'DYKI', 'Flamish Giant', '2021-12-25 06:09:01', 'a:2:{i:1;s:6:\"0.4000\";i:5;s:6:\"0.2000\";}', 'a:1:{i:1;s:1:\"1\";}', 1, '0.4000'),
(38, 'DYKI', 'Flamish Giant', '2021-12-25 06:10:28', 'a:4:{i:1;s:6:\"0.7600\";i:5;s:6:\"0.5200\";i:4;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:2:{i:1;s:1:\"1\";i:5;s:1:\"1\";}', 1, '0.7600'),
(39, 'DYKI', 'Flamish Giant', '2021-12-25 06:12:02', 'a:4:{i:1;s:6:\"0.7600\";i:5;s:6:\"0.6160\";i:4;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:3:{i:1;s:1:\"1\";i:5;s:1:\"1\";i:18;s:1:\"1\";}', 1, '0.7600'),
(40, 'DYKI', 'Flamish Giant', '2021-12-25 06:13:19', 'a:4:{i:5;s:6:\"0.8464\";i:1;s:6:\"0.7600\";i:4;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:4:{i:1;s:1:\"1\";i:5;s:1:\"1\";i:18;s:1:\"1\";i:19;s:1:\"1\";}', 5, '0.8464'),
(41, 'DYKI', 'Flamish Giant', '2021-12-25 06:14:28', 'a:4:{i:5;s:6:\"0.8771\";i:1;s:6:\"0.7600\";i:4;s:6:\"0.4000\";i:3;s:6:\"0.2000\";}', 'a:5:{i:1;s:1:\"1\";i:5;s:1:\"1\";i:18;s:1:\"1\";i:19;s:1:\"1\";i:20;s:1:\"1\";}', 5, '0.8771'),
(42, 'DYKI', 'Flamish Giant', '2021-12-25 06:16:06', 'a:4:{i:5;s:6:\"0.9017\";i:1;s:6:\"0.7600\";i:4;s:6:\"0.6400\";i:3;s:6:\"0.5200\";}', 'a:6:{i:1;s:1:\"1\";i:5;s:1:\"1\";i:18;s:1:\"1\";i:19;s:1:\"1\";i:20;s:1:\"1\";i:21;s:1:\"1\";}', 5, '0.9017'),
(43, 'DYKI', 'Lop', '2021-12-26 05:00:50', 'a:2:{i:2;s:6:\"0.9136\";i:1;s:6:\"0.4000\";}', 'a:4:{i:3;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}', 2, '0.9136'),
(44, 'DIK DIK', 'Flamish Giant', '2022-02-07 21:38:29', 'a:5:{i:2;s:6:\"0.8594\";i:1;s:6:\"0.6464\";i:4;s:6:\"0.3200\";i:5;s:6:\"0.3200\";i:3;s:6:\"0.1600\";}', 'a:5:{i:3;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"1\";i:7;s:1:\"2\";i:8;s:1:\"3\";}', 2, '0.8594');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_info`
--

CREATE TABLE `tbl_info` (
  `kd_info` int(11) NOT NULL,
  `nama_info` varchar(100) NOT NULL,
  `detail_info` varchar(15000) NOT NULL,
  `solusi_info` varchar(15000) NOT NULL,
  `gambar_info` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_info`
--

INSERT INTO `tbl_info` (`kd_info`, `nama_info`, `detail_info`, `solusi_info`, `gambar_info`) VALUES
(1, 'Gastrointestinal Hipomotolity', '<p>Gastrointestinal Hipomotolity merupakan salah satu penyakit pencernaan yang pemicu umum adalah setres mengakibatkan makan,minum dan pergerakan,pencernaan berkurang mengakibatkan fasesnya melambat mengakibatkan penumpukan makanan yang menjadi keras di dalam lambung kelinci.</p>\r\n\r\n<p>Jika sudah parah kemungkinan kelinci tidak bisa mengeluarkan fases, dilambung terasa penuh, jika suda parah kelinci bisa langsung ambuk dan tidak nafsu makan.</p>\r\n', '<p><strong>Solusi Penanganan:</strong></p>\r\n\r\n<ol>\r\n	<li>Cari faktor yang menyebabkan kelinci setres, bisa mencoba memindahkan tempat yang baru yg mempunyai cahaya yang&nbsp;bagus, hindari dekat suara yang mengganggu kelinci,</li>\r\n	<li>Coba untuk memberikan minum dengan&nbsp;menyuapin kelinci,</li>\r\n	<li>Jika sudah parah gumpalan makanan sudah mengeras butuh penanganan dokter</li>\r\n</ol>\r\n', 'Gastrointestinal.jpg'),
(2, 'Koksidiosis', '<p>Koksidiosis merupakan penyakit pada saluran pencernaan yang disebabkan oleh protozoa yang secara umum disebut koksidia. Parasit ini digolongkan dalam Filum Apicomplexa, Kelas Sporozoa, Subkelas Coccidia, Ordo Eucoocidia, Subordo Eimerina, Genus Eimeria, biasanya terjadi di pertenakan komersial dengan kandan yang padat dan kondisi lingkungan kotor.</p>\r\n', '<p><strong>Solusi Penanganan:</strong></p>\r\n\r\n<ol>\r\n	<li>Pisahkan dg yg lain,</li>\r\n	<li>Letakan ditempat khusus perawatan(bersih &amp; nyaman),</li>\r\n	<li>Memberikan pakan dan minum selalu baru,</li>\r\n	<li>Manajemen yg baik selalu jaga kebersihan dubur kelinci,</li>\r\n	<li>Selalu memanejemen pemeliharaan yang baik</li>\r\n</ol>\r\n', 'Koksidiosis.jpg'),
(3, 'Clostridiosis', '<p>Merupakan kelompok penyakit yang disebabkan oleh bakteri genus Clostridia, bakteri ini bersifat anaerob dan membentuk sepora. Habitat alaminya saprofit dalam tanah dan sebagai flora normal pada pencernaan hewan.</p>\r\n', '<p><strong>Solusi Penanganan:</strong></p>\r\n\r\n<ol>\r\n	<li>Manajemen pemeliharaan yang baik seperti selalu cek kebersihan kandang,</li>\r\n	<li>jaga jagan sering ada perubahan misalkan gonta ganti makanan/ pelet</li>\r\n	<li>menjaga kelinci biar tidak setres jauhkan dari tempat yang bising</li>\r\n</ol>\r\n', 'Clostridiosis.jpg'),
(4, 'Tyzzer Disease', '<p>Penyakit ini disebabkan oleh <em>Bacillus piliformis</em>, penakit ini hampir sama dengan <em>koksidiosis</em> karena mempunyai gejala yang hampir sama. kematian yang cepat, biasanya dalam 24&ndash;48 jam</p>\r\n', '<p><strong>Solusi Penanganan:</strong></p>\r\n\r\n<ol>\r\n	<li>mengaja kondisi lingkunan dan makanan, 2.untuk megatasi dihedrasi bisa dicoba untuk memberikan minum dengan cara menyuapin</li>\r\n	<li>jika sudah diherasi parah biasanya matanya cekung kedalam harus dengan penangan dokter hewan</li>\r\n</ol>\r\n', 'Tyzzer.jpg'),
(5, 'Obstruksi Usus', '<p>Penyebab obstruksi usus karena adanya benda asing di dalam usus. Benda asing yang ditemukan di da- lam usus biasanya terjadi penyumbatan oleh gumpalan rambut yang diakibatkan oleh kelinci memakan bulunya sendiri, sebenarnya kondisi ini wajar karena kelinci bisa mengeluarkan melalui fases, terkadang gumpalan tersebut tidak bisa keluar karena suatu kondisi tertentu sehingga bulu tidak bisa keluar dan menjadi gumpalan diusus.</p>\r\n', '<p><strong>Solusi Penanganan:</strong></p>\r\n\r\n<ul>\r\n	<li>Karena kelinci selalu makan terus menerus diharapkan pemilik menjaga kebersihan kelinci, bersihkan bulu bulu yang rontok seitar kandang.</li>\r\n	<li>Jika kelinci sudah ambruk dan lemas maka sebaiknya harus membutuhkan penanganan dokter untuk mengeluarkan permasalahan diusus</li>\r\n</ul>\r\n', 'Obstruksi.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kondisi`
--

CREATE TABLE `tbl_kondisi` (
  `id` int(11) NOT NULL,
  `kondisi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kondisi`
--

INSERT INTO `tbl_kondisi` (`id`, `kondisi`) VALUES
(1, 'Sangat Yakin'),
(2, 'Yakin'),
(3, 'Cukup Yakin'),
(4, 'Kurang Yakin'),
(5, 'Tidak Yakin'),
(6, 'Tidak Tahu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penyakit`
--

CREATE TABLE `tbl_penyakit` (
  `kd_penyakit` int(11) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL,
  `detail_penyakit` varchar(500) NOT NULL,
  `solusi_penyakit` varchar(500) NOT NULL,
  `gambar_penyakit` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penyakit`
--

INSERT INTO `tbl_penyakit` (`kd_penyakit`, `nama_penyakit`, `detail_penyakit`, `solusi_penyakit`, `gambar_penyakit`) VALUES
(1, ' Gastrointestinal Hipomotolity', 'Pemicu umum adalah setres mengakibatkan makan,inum dan pergerakan,pencernaan berkurang mengakibatkan fasesnya melambat mengakibatkan penumpukan makanan yang menjadi keras di dalam lambung kelinci, jika sudah parah kemungkinan kelinci tidak bisa mengeluarkan fases, dilambung terasa penuh, jika suda parah kelinci bisa langsung ambuk dan tidak nafsu makan. ', '1.Cari faktor yang menyebabkan kelinci setres, bisa mencoba memindahkan tempat yang baru yg mempunyai cahaya yg bagus, hindari dekat suara yang mengganggu kelinci<br> \r\n2. coba untuk memberikan minum dg menyuapin kelinci<br>  \r\n3.Jika sudah parah gumpalan makanan sudah mengeras butuh penanganan dokter<br> ', 'Gastrointestinal.jpg'),
(2, 'Koksidiosis', 'Koksidiosis merupakan penyakit pada saluran pencernaan yang disebabkan oleh protozoa yang secara umum disebut koksidia. Parasit ini digolongkan dalam Filum Apicomplexa, Kelas Sporozoa, Subkelas Coccidia, Ordo Eucoocidia, Subordo Eimerina, Genus Eimeria, biasanya terjadi di pertenakan komersial dengan kandan yang padat dan kondisi lingkungan kotor. ', '1.Pisahkan dg yg lain<br>\r\n2.Letakan ditempat khusus perawatan(bersih & nyaman)<br>\r\n3. Memberikan pakan dan minum selalu baru<br>\r\n4.Manajemen yg baik selalu jaga kebersihan dubur kelinci<br>\r\n5.selalu jaga manajemen pemeliharaan<br>\r\n6.Obat yang bisa diberikan berupa antibiotik seperti sulfaquinoxaline dan nitrofurans, pola pemberian 3-2-3(3 hari diberi obat, 2 hari istirahat dan dilanjutkan 3 hari lagi). Nitrofurans bisa diberikan selama 14 hari sedangkan yang lain cukp 7 hari.', 'Koksidiosis.jpg'),
(3, 'Clostridiosis', 'Merupakan kelompok penyakit yang disebabkan oleh bakteri genus Clostridia, bakteri ini bersifat anaerob dan membentuk sepora. Habitat alaminya saprofit dalam tanah dan sebagai flora normal pada pencernaan hewan.', '1.Manajemen pemeliharaan yang baik seperti selalu cek kebersihan kandang<br> \r\n2.jaga jagan sering ada perubahan misalkan gonta ganti makanan/ pelet<br>  \r\n3.menjaga kelinci biar tidak setres jauhkan dari tempat yang bising<br> ', 'Clostridiosis.jpg'),
(4, 'Tyzzer Disease', 'Penyakit ini disebabkan oleh Bacillus piliformis, penakit ini hampir sama dengan koksidiosis karena mempunyai gejala yang hampir sama. kematian yang cepat, biasanya dalam 24-48 jam', '1.mengaja kondisi lingkunan dan makanan<br> \r\n2.untuk megatasi dihedrasi bisa dicoba untuk memberikan minum dengan cara menyuapin<br>  \r\n3.jika sudah diherasi parah biasanya matanya cekung kedalam harus dengan penangan dokter hewan<br> ', 'Tyzzer.jpg'),
(5, 'Obstruksi Usus', 'Penyebab obstruksi usus karena adanya benda asing di dalam usus. Benda asing yang ditemukan di dalam usus biasanya terjadi penyumbatan oleh gumpalan rambut yang diakibatkan oleh kelinci memakan bulunya sendiri, sebenarnya kondisi ini wajar karena kelinci bisa mengeluarkan melalui fases, terkadang gumpalan tersebut tidak bisa keluar karena suatu kondisi tertentu sehingga bulu tidak bisa keluar dan menjadi gumpalan diusus.', '1.Karena kelinci selalu makan terus menerus diharapkan pemilik menjaga kebersihan kelinci, bersihkan bulu bulu yang rontok seitar kandang<br>\r\n2.jika kelinci sudah ambruk dan lemas maka sebaiknya harus penanganan dokter untuk mengeluarkan permasalahan diusus<br> ', 'Obstruksi.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tbl_basispengetahuan`
--
ALTER TABLE `tbl_basispengetahuan`
  ADD PRIMARY KEY (`kd_pengetahuan`);

--
-- Indexes for table `tbl_gejala`
--
ALTER TABLE `tbl_gejala`
  ADD PRIMARY KEY (`kd_gejala`);

--
-- Indexes for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`kd_hasil`);

--
-- Indexes for table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD PRIMARY KEY (`kd_info`);

--
-- Indexes for table `tbl_kondisi`
--
ALTER TABLE `tbl_kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_penyakit`
--
ALTER TABLE `tbl_penyakit`
  ADD PRIMARY KEY (`kd_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_basispengetahuan`
--
ALTER TABLE `tbl_basispengetahuan`
  MODIFY `kd_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_gejala`
--
ALTER TABLE `tbl_gejala`
  MODIFY `kd_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `kd_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_info`
--
ALTER TABLE `tbl_info`
  MODIFY `kd_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_kondisi`
--
ALTER TABLE `tbl_kondisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_penyakit`
--
ALTER TABLE `tbl_penyakit`
  MODIFY `kd_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
