-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Apr 2024 pada 17.17
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kesehatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar`
--

CREATE TABLE `tb_gambar` (
  `id` int(11) NOT NULL,
  `gambar` varchar(500) NOT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_gambar`
--

INSERT INTO `tb_gambar` (`id`, `gambar`, `nama_kegiatan`, `tanggal`) VALUES
(20, 'WhatsApp Image 2024-04-03 at 1.06.23 PM.jpeg', 'Outbound 2023', '2023-12-21'),
(21, 'WhatsApp Image 2024-04-03 at 1.06.23 PM (1).jpeg', 'Outbound 2024', '2024-04-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pekerja`
--

CREATE TABLE `tb_pekerja` (
  `nipp` varchar(10) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `jabatan` varchar(500) NOT NULL,
  `kedudukan` varchar(500) NOT NULL,
  `tempat_lhr` varchar(500) NOT NULL,
  `pend` varchar(500) NOT NULL,
  `profesi` varchar(500) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pekerja`
--

INSERT INTO `tb_pekerja` (`nipp`, `nama`, `jabatan`, `kedudukan`, `tempat_lhr`, `pend`, `profesi`, `gambar`) VALUES
('44470', 'Wakhyo Komantri', 'Manager Kesehatan', 'Kantor Unit Kesehatan', 'Pasuruan 29 September 1973', 'S1', 'Hukum', 'team-5.jpg'),
('44566', 'Supardi', 'Assistant Manager Kesehatan Kerja', 'Kantor Unit Kesehatan', 'Klaten 02 Juli 1993', 'S1', 'Kesehatan Masyarakat', 'team-5.jpg'),
('45381', 'Fendi Nurcahyo', 'Assistant Manager Pelayanan & Kepesertaan', 'Kantor Unit Kesehatan', 'Nganjuk 29 Mei 1975', 'SLTA', 'Kesehatan', 'team-3.jpg'),
('72110', 'Diediek Hendarko', 'Pelaksana Kesehatan Kerja', 'Kantor Unit Kesehatan', 'Magetan 26 Februari 1991', 'SLTA', 'IPS', 'team-1.jpg'),
('72555', 'Kun Chyntia Mega Ningrum', 'Dokter Fungsional 3', 'Klinik Mediska Madiun', 'Madiun 16 Juni 1993', 'S1', 'Dokter Umum', 'IMG-20230316-WA0031.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pekerja`
--
ALTER TABLE `tb_pekerja`
  ADD PRIMARY KEY (`nipp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
