-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 07:27 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `form_administrasi`
--

CREATE TABLE `form_administrasi` (
  `id` int(11) NOT NULL,
  `form_e` varchar(255) DEFAULT NULL,
  `form_f` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form_administrasi`
--

INSERT INTO `form_administrasi` (`id`, `form_e`, `form_f`, `nim`) VALUES
(9, 'KARTU (1).pdf', 'KARTU (1).pdf', '210411100180'),
(11, '11433-11448 (1).pdf', '2815-Article Text-8071-1-10-20210220 (1).pdf', '210411100151');

-- --------------------------------------------------------

--
-- Table structure for table `multiuser`
--

CREATE TABLE `multiuser` (
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status_form_pengajuan_sidangTA` varchar(255) NOT NULL,
  `status_form_administrasi` varchar(255) NOT NULL,
  `nilai_sidang` varchar(255) NOT NULL,
  `jadwal_sidang` varchar(255) NOT NULL,
  `hak_akses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `multiuser`
--

INSERT INTO `multiuser` (`nama`, `no_hp`, `nim`, `pass`, `status_form_pengajuan_sidangTA`, `status_form_administrasi`, `nilai_sidang`, `jadwal_sidang`, `hak_akses`) VALUES
('123', '123456', '123456', '123', '', '', '0', '', 'user'),
('whinta', '0845946466', '2104', '123', 'SEDANG DITINJAU', 'Belum Meng-Upload file Administrasi', '0', '', 'user'),
('nabila', '08568726555', '210411100066', 'nabilaa', '', '', '0', '', 'user'),
('Firdatul ', '081335765765', '210411100144', 'firda', 'LULUS', 'Belum Meng-Upload file Administrasi', '0', 'Rabu, 29 November 2023 (09.30 WIB / F304)', 'user'),
('Jennatul Macwe', '08568721594', '210411100151', 'jenna', 'LULUS', 'DISETUJUI', 'LEMBAR-PENILAIAN-UJIAN-SIDANG-SKRIPSI.pdf', 'Rabu, 29 November 2023 (09.30 WIB / F304)', 'user'),
('salsa', '08594658444', '210411100180', 'salsyuw', 'DISETUJUI', 'SEDANG DITINJAU', '0', '', 'user'),
('admin', '085469787555', 'admin', 'admin', '', '', '0', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `file_pendaftaran` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL,
  `total_sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `nim`, `file_pendaftaran`, `semester`, `total_sks`) VALUES
(95, '210411100151', 'KARTU (1).pdf', 7, 144),
(96, '210411100180', 'KARTU (1).pdf', 8, 144),
(97, '474747', 'KARTU (1).pdf', 8, 144),
(98, '2104', '2815-Article Text-8071-1-10-20210220 (1).pdf', 8, 144),
(99, '210411100144', 'LEMBAR-PENILAIAN-UJIAN-SIDANG-SKRIPSI.pdf', 8, 144);

-- --------------------------------------------------------

--
-- Table structure for table `revisi`
--

CREATE TABLE `revisi` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `file_revisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `revisi`
--

INSERT INTO `revisi` (`id`, `nim`, `file_revisi`) VALUES
(1, '210411100151', 'BAB I.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL,
  `tema` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`id_tema`, `tema`) VALUES
(1, 'Pengembangan Aplikasi Mobile'),
(2, 'Big Data dan Analisis Data'),
(3, 'Internet of Things (IoT)'),
(4, 'Sistem Cerdas (Artificial Intelligence)'),
(5, 'Cloud Computing');

-- --------------------------------------------------------

--
-- Table structure for table `tugas_akhir`
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
-- Dumping data for table `tugas_akhir`
--

INSERT INTO `tugas_akhir` (`id_tugasakhir`, `id_tema`, `judul_tugasakhir`, `tahun`, `abstrak`, `cover`, `penulis`) VALUES
(1, 1, 'APLIKASI MOBILE UNTUK PENGELOLAAN TUGAS DAN PENJADWALAN DENGAN ALGORITMA PENCARIAN OPTIMAL', '2023', 'Tugas akhir ini merancang dan mengembangkan aplikasi mobile yang bertujuan membantu pengguna dalam pengelolaan tugas dan penjadwalan dengan efisiensi maksimal. Aplikasi ini memanfaatkan algoritma pencarian optimal, seperti algoritma greedy, untuk menyusun jadwal yang optimal berdasarkan prioritas dan batas waktu yang ditetapkan oleh pengguna. Pengguna dapat dengan mudah menambahkan tugas, memberikan tingkat prioritas, dan menetapkan batas waktu melalui antarmuka pengguna yang intuitif. Aplikasi secara otomatis menyusun jadwal yang mengoptimalkan alokasi waktu untuk setiap tugas, dengan meminimalkan potensi konflik jadwal. Fitur notifikasi akan memberikan pengingat kepada pengguna sebelum batas waktu tugas, sementara analisis penggunaan waktu memberikan wawasan terkait pola penggunaan waktu sehari-hari. Antarmuka pengguna dirancang agar mudah dipahami dan nyaman digunakan, memberikan pengalaman pengguna yang optimal.', 'cover-1.webp', 'Jennatul Macwe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_administrasi`
--
ALTER TABLE `form_administrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `multiuser`
--
ALTER TABLE `multiuser`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `revisi`
--
ALTER TABLE `revisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`);

--
-- Indexes for table `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  ADD PRIMARY KEY (`id_tugasakhir`),
  ADD KEY `id_genre` (`id_tema`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_administrasi`
--
ALTER TABLE `form_administrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `revisi`
--
ALTER TABLE `revisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  MODIFY `id_tugasakhir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
