-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Okt 2019 pada 09.35
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pamsimas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`, `nama`, `level`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin'),
(3, '9090', '38f629170ac3ab74b9d6d2cc411c2f3c', '', 'user'),
(4, '0909', 'a5a7158118e59ee590424b55bb9aed17', '', 'user'),
(5, '8989', 'b66dc44cd9882859d84670604ae276e6', 'yahdi', 'user'),
(6, '1010', '1e48c4420b7073bc11916c6c1de226bb', 'y', 'user'),
(7, '123', '202cb962ac59075b964b07152d234b70', 'yahdi', 'user'),
(8, '111', '698d51a19d8a121ce581499d7b701668', 'tri', 'user'),
(9, '122', 'a0a080f42e6f13b3a2df133f073095dd', 'titi', 'user'),
(10, '222', 'bcbe3365e6ac95ea2c0343a2395834dd', 'dila', 'user'),
(11, '12345', '827ccb0eea8a706c4c34a16891f84e7b', 'dila', 'user'),
(12, '555', '15de21c670ae7c3f6f3f1f37029303c9', 'pipi', 'user'),
(13, '1010', '1e48c4420b7073bc11916c6c1de226bb', 'dedek', 'user'),
(14, '01112002939747', '7da8398207a496f0f01de28650b34a4f', 'yahdi almukaram', 'user'),
(15, '3944839233300001', '6a4346a715e257fea31abab034249d8f', 'yahdi almukaram', 'user'),
(16, '123', '202cb962ac59075b964b07152d234b70', 'wer', 'user'),
(17, '1234', '81dc9bdb52d04dc20036dbd8313ed055', 'gunawan', 'user'),
(18, '111', '698d51a19d8a121ce581499d7b701668', 'karam', 'user'),
(19, '123', '202cb962ac59075b964b07152d234b70', 'gunawan', 'user'),
(20, '1234', '81dc9bdb52d04dc20036dbd8313ed055', 'rere', 'user'),
(21, '001', 'dc5c7986daef50c1e02ab09b442ee34f', 'lutvi', 'user'),
(22, '111', '698d51a19d8a121ce581499d7b701668', 'karam', 'user'),
(23, '12345', '827ccb0eea8a706c4c34a16891f84e7b', 'gunawan', 'user'),
(24, '222', 'bcbe3365e6ac95ea2c0343a2395834dd', 'gunawan rifki', 'user'),
(25, '002', '93dd4de5cddba2c733c65f233097f05a', 'nadia', 'user'),
(26, '0002722228392800002', 'e0e131fe71d7e8be1992d9e84f16666e', 'tri', 'user'),
(27, '02288888002', '95b164ce8fbc82fcca2c2b9763916e59', 'tri', 'user'),
(28, '001122', '5b0859e0152d5c79c9c464b47889ec14', 'yahdi almukaram', 'user'),
(29, '90', '8613985ec49eb8f757ae6439e879bb2a', 'yahdi almukaram', 'user'),
(30, '80', 'f033ab37c30201f73f142449d037028d', 'nadia', 'user'),
(31, '000001', '04fc711301f3c784d66955d98d399afb', 'didi', 'user'),
(32, '32323', '5f6eb0809f31e88067e51bfd2bb0c50e', 'ee', 'user'),
(33, '00000000001', 'd67f0826d4c0aa7e3ea5861616a822b2', 'tri', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` int(50) NOT NULL,
  `tgl_bayar` varchar(50) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `id_tagihan` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `tgl_bayar`, `bukti_bayar`, `id_tagihan`, `status`) VALUES
(1, '05-10-2019', '/media/thumb_media/04ac91efb8919a775753a4e294c50b2b.jpg', '1', 'Diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_meteran`
--

CREATE TABLE `tb_meteran` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `meteran_awal` varchar(50) NOT NULL,
  `meteran_akhir` varchar(50) NOT NULL,
  `total_bayar` varchar(50) NOT NULL,
  `tgl_tagihan` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tgl_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_meteran`
--

INSERT INTO `tb_meteran` (`id`, `nik`, `meteran_awal`, `meteran_akhir`, `total_bayar`, `tgl_tagihan`, `status`, `tgl_pembayaran`) VALUES
(1, '00000000001', '0', '20', '41000', '01-2019', 'Sudah', '05-10-2019');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `agama` varchar(25) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `meter_awal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id`, `nik`, `nama`, `tgl_lahir`, `jenis_kelamin`, `agama`, `pekerjaan`, `no_hp`, `meter_awal`) VALUES
(1, '00000000001', 'tri', '10/09/2019', 'laki-laki', 'Islam', 'mahasiswa', '081374630332', '20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indeks untuk tabel `tb_meteran`
--
ALTER TABLE `tb_meteran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tb_bayar`
--
ALTER TABLE `tb_bayar`
  MODIFY `id_bayar` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_meteran`
--
ALTER TABLE `tb_meteran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
