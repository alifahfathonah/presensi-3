-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 04:08 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_izin` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(6) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `sts` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_pegawai`, `id_izin`, `tanggal`, `jam`, `latitude`, `longitude`, `sts`) VALUES
(2, 2, NULL, '2022-07-19', '23:48', '-3.2841034', '114.5940115', 'Hadir'),
(5, 2, NULL, '2022-07-20', '22:16', '-3.2842356562400257', '114.59429153175869', 'Hadir'),
(18, 2, 2, '2022-07-31', '-', NULL, NULL, 'Izin'),
(19, 2, 2, '2022-08-01', '-', NULL, NULL, 'Izin');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_pengadaan` int(11) NOT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_pengadaan`, `id_ruangan`, `status`) VALUES
(2, 2, 3, '1'),
(3, 3, 4, '1'),
(4, 4, 5, '0'),
(5, 5, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nm_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nm_divisi`) VALUES
(2, 'Jaringan'),
(3, 'Programmer');

-- --------------------------------------------------------

--
-- Table structure for table `izin`
--

CREATE TABLE `izin` (
  `id_izin` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `sts_izin` varchar(10) NOT NULL,
  `ket_izin` text NOT NULL,
  `file_izin` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `izin`
--

INSERT INTO `izin` (`id_izin`, `id_pegawai`, `sts_izin`, `ket_izin`, `file_izin`, `tgl_mulai`, `tgl_selesai`) VALUES
(2, 2, 'Izin', 'Nenek Masuk Rumah Sakit', '10048.pdf', '2022-07-31', '2022-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nm_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nm_jabatan`) VALUES
(1, 'Kadiv Jaringan'),
(3, 'Kadiv Programmer');

-- --------------------------------------------------------

--
-- Table structure for table `jam_masuk`
--

CREATE TABLE `jam_masuk` (
  `id` int(11) NOT NULL,
  `jam` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam_masuk`
--

INSERT INTO `jam_masuk` (`id`, `jam`) VALUES
(1, '08:00');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int(11) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_ruangan_old` int(11) NOT NULL,
  `tgl_mutasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutasi`
--

INSERT INTO `mutasi` (`id_mutasi`, `no_surat`, `id_barang`, `id_ruangan`, `id_ruangan_old`, `tgl_mutasi`) VALUES
(5, '6789', 4, 5, 5, '2022-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nm_pegawai` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `tmt` date NOT NULL,
  `scan_ijazah` varchar(100) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(20) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(20) NOT NULL,
  `is_active` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nm_pegawai`, `nip`, `id_divisi`, `id_jabatan`, `status`, `tmt`, `scan_ijazah`, `tmpt_lahir`, `tgl_lahir`, `jk`, `agama`, `alamat`, `hp`, `is_active`) VALUES
(2, 'Kaiden S.Kom', '121212', 2, 1, 'ASN', '2019-07-08', '25569.pdf', 'Banjarmasin', '1995-07-11', 'Laki - laki', 'Islam', 'Banjarmasin', '081391701913', '1'),
(3, 'Curt Cobain S.Kom', '123456', 3, 3, 'ASN', '2019-07-07', '56175.pdf', 'London', '1990-07-22', 'Laki - laki', 'Islam', 'Banjarmasin', '084589585899', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` int(11) NOT NULL,
  `kd_pengadaan` varchar(20) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `tgl_pengadaan` date NOT NULL,
  `sumber_dana` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`id_pengadaan`, `kd_pengadaan`, `nm_barang`, `satuan`, `tgl_pengadaan`, `sumber_dana`) VALUES
(2, 'IVB000001', 'Sierra IBM, 94.6 FLOPS', 'Unit', '2020-02-14', 'Anggaran 2020'),
(3, 'IVB000002', 'Monitor LG 20 inc', 'Unit', '2021-07-11', 'Anggaran 2021'),
(4, 'IVB000003', 'Netgear XS748T 48 Port 10 ', 'Unit', '2021-07-16', 'Anggaran 2021'),
(5, 'IVB000004', 'Kabel LAN 2 M', 'Set', '2022-07-20', 'Anggaran 2022');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nm_ruangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nm_ruangan`) VALUES
(1, 'Server'),
(3, 'Telekomunikasi'),
(4, 'Informatika'),
(5, 'Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `rusak`
--

CREATE TABLE `rusak` (
  `id_rusak` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `ket` text NOT NULL,
  `tgl_rusak` date NOT NULL,
  `status_perbaikan` char(1) NOT NULL,
  `biaya_perbaikan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rusak`
--

INSERT INTO `rusak` (`id_rusak`, `id_barang`, `ket`, `tgl_rusak`, `status_perbaikan`, `biaya_perbaikan`) VALUES
(2, 3, 'Layar Pecah', '2022-02-13', '1', 'Rp. 1.000.000'),
(3, 4, 'Device Sering Restart, Chip Bermasalah', '2022-07-12', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `sub_tugas`
--

CREATE TABLE `sub_tugas` (
  `id_sub_tugas` int(11) NOT NULL,
  `id_tugas` varchar(20) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_tugas`
--

INSERT INTO `sub_tugas` (`id_sub_tugas`, `id_tugas`, `id_pegawai`) VALUES
(8, '62d573f20bb05', 3),
(9, '62d80c2f5a80d', 3),
(10, '62d80c2f5a80d', 2);

-- --------------------------------------------------------

--
-- Table structure for table `telat`
--

CREATE TABLE `telat` (
  `id_telat` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` varchar(20) NOT NULL,
  `no_surat` varchar(30) NOT NULL,
  `perihal` text NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(6) NOT NULL,
  `tempat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `no_surat`, `perihal`, `tanggal`, `jam`, `tempat`) VALUES
('62d573f20bb05', '01/ST/VII/2022', 'Perjalanan Dinas', '2022-07-20', '10:00', 'Diskominfotik Banjarbaru'),
('62d80c2f5a80d', '02/ST/VII/2022', 'Perjalanan Dinas', '2022-07-21', '09:00', 'Dinas Kesehatan Tanah Laut');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `nm_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_pegawai`, `nm_user`, `username`, `password`, `level`) VALUES
(1, NULL, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1'),
(2, NULL, 'Kepala DISKOMINFOTIK Banjarmasin', 'kadiskominfotik', '6261acf33d849e66b9cdaf0ed8032e0d', '2'),
(3, 2, 'Kaiden S.Kom', '121212', 'e10adc3949ba59abbe56e057f20f883e', '3'),
(4, 3, 'Curt Cobain S.Kom', '123456', 'e10adc3949ba59abbe56e057f20f883e', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_izin` (`id_izin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_pengadaan` (`id_pengadaan`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jam_masuk`
--
ALTER TABLE `jam_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `rusak`
--
ALTER TABLE `rusak`
  ADD PRIMARY KEY (`id_rusak`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `sub_tugas`
--
ALTER TABLE `sub_tugas`
  ADD PRIMARY KEY (`id_sub_tugas`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `sub_tugas_ibfk_2` (`id_tugas`);

--
-- Indexes for table `telat`
--
ALTER TABLE `telat`
  ADD PRIMARY KEY (`id_telat`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jam_masuk`
--
ALTER TABLE `jam_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rusak`
--
ALTER TABLE `rusak`
  MODIFY `id_rusak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sub_tugas`
--
ALTER TABLE `sub_tugas`
  MODIFY `id_sub_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `telat`
--
ALTER TABLE `telat`
  MODIFY `id_telat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`id_izin`) REFERENCES `izin` (`id_izin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_pengadaan`) REFERENCES `pengadaan` (`id_pengadaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `izin`
--
ALTER TABLE `izin`
  ADD CONSTRAINT `izin_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rusak`
--
ALTER TABLE `rusak`
  ADD CONSTRAINT `rusak_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_tugas`
--
ALTER TABLE `sub_tugas`
  ADD CONSTRAINT `sub_tugas_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `telat`
--
ALTER TABLE `telat`
  ADD CONSTRAINT `telat_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
