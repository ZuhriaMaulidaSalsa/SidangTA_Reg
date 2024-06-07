-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2023 pada 07.07
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
-- Database: `sidangtappbisnis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `multiuser`
--

CREATE TABLE `multiuser` (
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `hak_akses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `multiuser`
--

INSERT INTO `multiuser` (`nama`, `no_hp`, `nim`, `pass`, `hak_akses`) VALUES
('nabila', '08568726555', '210411100066', 'nabilaa', 'user'),
('Jennatul Macwe', '08568721594', '210411100151', 'jenna', 'user'),
('admin', '08155052335', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `file_pendaftaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `nim`, `file_pendaftaran`) VALUES
(82, '210411100151', 'BPI_Kelompok 3_PPB B (1).pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `revisi`
--

CREATE TABLE `revisi` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `file_revisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `revisi`
--

INSERT INTO `revisi` (`id`, `nim`, `file_revisi`) VALUES
(1, '210411100151', 'BAB I.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL,
  `tema` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tema`
--

INSERT INTO `tema` (`id_tema`, `tema`) VALUES
(1, 'Pengembangan Aplikasi Mobile'),
(2, 'Big Data dan Analisis Data'),
(3, 'Internet of Things (IoT)'),
(4, 'Sistem Cerdas (Artificial Intelligence)'),
(5, 'Cloud Computing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas_akhir`
--

CREATE TABLE `tugas_akhir` (
  `id_tugasakhir` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `judul_tugasakhir` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `abstrak` varchar(1000) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tugas_akhir`
--

INSERT INTO `tugas_akhir` (`id_tugasakhir`, `id_tema`, `judul_tugasakhir`, `tahun`, `abstrak`, `cover`, `penulis`) VALUES
(1, 1, 'APLIKASI MOBILE UNTUK PENGELOLAAN TUGAS DAN PENJADWALAN DENGAN ALGORITMA PENCARIAN OPTIMAL', '2023', 'Tugas akhir ini merancang dan mengembangkan aplikasi mobile yang bertujuan membantu pengguna dalam pengelolaan tugas dan penjadwalan dengan efisiensi maksimal. Aplikasi ini memanfaatkan algoritma pencarian optimal, seperti algoritma greedy, untuk menyusun jadwal yang optimal berdasarkan prioritas dan batas waktu yang ditetapkan oleh pengguna. Pengguna dapat dengan mudah menambahkan tugas, memberikan tingkat prioritas, dan menetapkan batas waktu melalui antarmuka pengguna yang intuitif. Aplikasi secara otomatis menyusun jadwal yang mengoptimalkan alokasi waktu untuk setiap tugas, dengan meminimalkan potensi konflik jadwal. Fitur notifikasi akan memberikan pengingat kepada pengguna sebelum batas waktu tugas, sementara analisis penggunaan waktu memberikan wawasan terkait pola penggunaan waktu sehari-hari. Antarmuka pengguna dirancang agar mudah dipahami dan nyaman digunakan, memberikan pengalaman pengguna yang optimal.', 'cover-1.webp', 'Jennatul Macwe');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `multiuser`
--
ALTER TABLE `multiuser`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indeks untuk tabel `revisi`
--
ALTER TABLE `revisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indeks untuk tabel `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`);

--
-- Indeks untuk tabel `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  ADD PRIMARY KEY (`id_tugasakhir`),
  ADD KEY `id_genre` (`id_tema`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `revisi`
--
ALTER TABLE `revisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  MODIFY `id_tugasakhir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
