-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 09:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_tugas`
--

CREATE TABLE `daftar_tugas` (
  `id` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `deadline` varchar(100) NOT NULL,
  `jam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_tugas`
--

INSERT INTO `daftar_tugas` (`id`, `matkul_id`, `dosen_id`, `kelas_id`, `judul`, `deskripsi`, `deadline`, `jam`) VALUES
(13, 8, 5, 4, 'Normalisasi Database', 'Jawaban discan dan dikumpulkan dengan format PDF', '2021-06-30', '18:41'),
(14, 8, 5, 4, 'Membuat ERD', 'Jawaban discan dan dikumpulkan dengan format PDF', '2021-06-29', '22:42'),
(16, 7, 5, 4, 'Membuat Menu Ms. Access', 'Capture setiap langkah percobaan dan beri penjelasan', '2021-06-22', '22:44'),
(17, 7, 5, 4, 'Praktikum SQL', 'Capture setiap langkah percobaan dan beri penjelasan', '2021-06-28', '21:46'),
(18, 7, 5, 4, 'Report Ms.Access', 'Capture setiap langkah percobaan dan beri penjelasan', '2021-06-28', '22:46'),
(19, 2, 8, 4, 'CRUD', 'Laporan berisi source code, output, analisa dan dikumpulkan dengan format PDF', '2021-06-29', '15:03'),
(20, 2, 8, 4, 'Login Register', 'Laporan berisi source code, output, analisa dan dikumpulkan dengan format PDF', '2021-06-29', '16:04'),
(21, 2, 8, 4, 'Final Project', 'yhahahaha hayyukkk', '2021-06-22', '17:04'),
(22, 8, 5, 4, 'Usecase Diagram', 'Jawaban discan dan dikumpulkan dengan format PDF', '2021-07-05', '04:01'),
(23, 8, 5, 4, 'coba', 'coba', '2021-06-16', '08:51');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nidn` varchar(100) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nohp` varchar(100) NOT NULL,
  `nama_foto` varchar(100) NOT NULL,
  `tipe_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `nama_depan`, `nama_belakang`, `jenis_kelamin`, `alamat`, `nohp`, `nama_foto`, `tipe_foto`) VALUES
(5, '31121312331', 'Dosen1', 'Bro', 'Laki-laki', 'Surabaya', '08912891231023', 'jn.jpg', 'image/jpeg'),
(6, '31242124212', 'Dosen2', 'Sist', 'Perempuan', 'Surabaya', '08123182231', '', ''),
(7, '31121989122', 'Dosen3', 'Bro', 'Laki-laki', 'Surabaya', '081828743824224', '', ''),
(8, '311213132345', 'Dosen4', 'Sist', 'Perempuan', 'Surabaya', '08912891235234', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `nama_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `deskripsi`, `nama_file`) VALUES
(4, 'yhahaha hayyukkk', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ', '3120600050 (1).pdf'),
(5, 'bsiww peww pipiww', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ', '3120600050 (1).pdf'),
(6, 'Demo Final project', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', '3120600050 (1).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `hari` varchar(100) NOT NULL,
  `jam_mulai` varchar(100) NOT NULL,
  `jam_selesai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `matkul_id`, `dosen_id`, `kelas_id`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(11, 8, 5, 4, 'Senin', '08:50', '10:30'),
(12, 11, 6, 4, 'Senin', '10:30', '13:00'),
(13, 9, 7, 4, 'Senin', '14:00', '16:30'),
(14, 2, 8, 4, 'Selasa', '08:00', '10:30'),
(15, 7, 5, 4, 'Selasa', '14:00', '16:30'),
(16, 11, 6, 4, 'Rabu', '08:00', '12:00'),
(17, 5, 8, 4, 'Kamis', '12:20', '14:00'),
(18, 10, 7, 4, 'Kamis', '14:00', '15:40'),
(19, 12, 6, 4, 'Jumat', '08:00', '10:00'),
(20, 7, 5, 3, 'Selasa', '08:16', '08:20');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `jurusan`) VALUES
(1, 'Teknik Informatika'),
(2, 'Multimedia Broadcasting'),
(3, 'Teknik Elektronika'),
(4, 'Teknik Elektro Industri'),
(5, 'Teknik Mekatronika'),
(7, 'Teknik Komputer'),
(8, 'Teknik Telekomunikasi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`) VALUES
(1, '1 D3 Teknik Informatika A'),
(2, '1 D3 Teknik Informatika B'),
(3, '1 D4 Teknik Informatika A'),
(4, '1 D4 Teknik Informatika B'),
(5, '2 D3 Teknik Informatika A'),
(6, '2 D3 Teknik Informatika B'),
(7, '2 D4 Teknik Informatika A');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nrp` varchar(100) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nama_foto` varchar(100) NOT NULL,
  `tipe_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nrp`, `nama_depan`, `nama_belakang`, `kelas_id`, `gender`, `alamat`, `nama_foto`, `tipe_foto`) VALUES
(3, '3120600050', 'Fidisa', 'Anindya', 4, 'Perempuan', 'Surabaya', 'jn.jpg', 'image/jpeg'),
(7, '32112321123', 'Mahasiswa1', 'Bro', 1, 'Laki-laki', 'Surabaya', '', ''),
(8, '123213231', 'Mahasiswa2', 'Sist', 2, 'Perempuan', 'Surabaya', '', ''),
(10, '129137182128', 'Mahasiswa3', 'Bro', 4, 'Laki-laki', 'Surabaya', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id` int(11) NOT NULL,
  `matkul` varchar(100) NOT NULL,
  `sks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id`, `matkul`, `sks`) VALUES
(2, 'Praktikum Pemrograman Web', '2'),
(5, 'Pemrograman Web', '3'),
(7, 'Praktikum Basis Data', '3'),
(8, 'Basis Data', '2'),
(9, 'Praktikum Sistem Operasi', '3'),
(10, 'Sistem Operasi', '2'),
(11, 'Praktikum Algoritma Struktur Data', '2'),
(12, 'Algoritma Struktur Data', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dtugas_id` int(11) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `tipe_file` varchar(100) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `notes_dosen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `user_id`, `dtugas_id`, `nama_file`, `tipe_file`, `notes`, `nilai`, `notes_dosen`) VALUES
(11, 3, 14, 'ERD.pdf', 'application/pdf', 'Mantapu Jiwa', '90', 'Bsiwww Peww Pipiwww'),
(12, 3, 19, '3120600050.pdf', 'application/pdf', 'ashiyappp', '', ''),
(13, 10, 14, '3120600050.pdf', 'application/pdf', 'Mantapu', '90', 'Mantapu'),
(14, 3, 13, '3120600050 (1) (1).pdf', 'application/pdf', 'test', '90', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_foto` varchar(100) NOT NULL,
  `tipe_foto` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `nama`, `email`, `password`, `nama_foto`, `tipe_foto`, `role`) VALUES
(1, 0, 'Bos Admin', 'admin@gmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', 'jn.jpg', 'image/jpeg', 'admin'),
(7, 3, 'Fidisa Anindya', 'fidisa@gmail.com', '91db9ff1693c83881cdba0e293f087de', 'jn.jpg', 'image/jpeg', 'mahasiswa'),
(12, 7, 'Mahasiswa1 Bro', 'mahasiswa1@gmail.com', '32c12895c389dc97fd5f631a8beb22f9', '', '', 'mahasiswa'),
(13, 8, 'Mahasiswa2 Sist', 'mahasiswa2@gmail.com', '0f84b4666c18d4462d8b68e948724a67', '', '', 'mahasiswa'),
(14, 5, 'Dosen1 Bro', 'dosen1@gmail.com', 'df777ee550410f0ca452400de1a5fb0e', 'jn.jpg', 'image/jpeg', 'dosen'),
(15, 6, 'Dosen2 Sist', 'dosen2@gmail.com', '3a235a86c24dd1cf4ebff33cc03b972f', '', '', 'dosen'),
(16, 7, 'Dosen3 Bro', 'dosen3@gmail.com', '1765951f954137945a801efabb19df63', '', '', 'dosen'),
(17, 8, 'Dosen4 Sist', 'dosen4@gmail.com', 'e8dcdefd9125a3529cb24f96b8e984ae', '', '', 'dosen'),
(20, 10, 'Mahasiswa3 Bro', 'mahasiswa3@gmail.com', '88775a8d6d740f6497ca23ff356ce079', '', '', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_tugas`
--
ALTER TABLE `daftar_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_tugas`
--
ALTER TABLE `daftar_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
