-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2024 pada 15.05
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `email`) VALUES
(1, 'adam', 'adame', 'e517be426dde9c8e41b281a18d5de9f2', 'adame@gmail.com'),
(3, 'iqbal', 'fadillah iqbal', '8d90d3b4702c9df2567603dfb1c26978', 'fadil@gmail.com'),
(4, 'Lastico', 'Tico', '$2y$10$h0i1vblEfY5xEkYk8rWat.hJ1IDPjGxpZjvw0gwQvvikb7fACwJi6', 'tico@gmail.com'),
(18, 'adi', 'adish', '$2y$10$b.tuLnQzPiJNDAi5CDbwv.4vd9h.mMzXRynx9RfbbaYGoHhJzKDlu', 'adi@gmail.com'),
(20, 'dana', 'danam', '$2y$10$RMzObjLt4iO9ymccV5XwhuaR.DISZChyPCSEmwmDjwIrlhhgePMWe', 'dana@gmail.com'),
(21, 'iqbal', 'iqbalaa', '$2y$10$6.4j0CTqQc1l8B8K/N2NUuDc6zzseuq3EkV7T1GSmCAzMFwk5/vaC', 'iqbal@gmail.com'),
(26, 'eriepras', 'erie', '352afb2aaaf3f5c72399f8433ac5047e', 'erie@gmail.com'),
(27, 'haji', 'haji', 'a151602b76a7bb594fd13cb542b25bd7', 'haji@gmail.com'),
(28, 'valialyaa', 'valia', 'e10adc3949ba59abbe56e057f20f883e', 'valia@gmail.com'),
(29, 'valia', 'valiaa', '827ccb0eea8a706c4c34a16891f84e7b', 'valia@gmail'),
(30, 'jakun', 'jakun', 'b71cadf4aa39a03548521fc373ca9a3f', 'jakun@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `asal`
--

CREATE TABLE `asal` (
  `id_asal` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(150) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tgl_berita` date NOT NULL,
  `konten_berita` text NOT NULL,
  `foto_berita` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `id_admin`, `tgl_berita`, `konten_berita`, `foto_berita`) VALUES
(4, 'Bootstrap', 1, '2024-09-28', '<p>Bootstrap 5 hadir dengan fitur yang lebih menarik</p>\r\n', '327532805_bootstrap.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `destinasi`
--

CREATE TABLE `destinasi` (
  `id_destinasi` int(11) NOT NULL,
  `nama_destinasi` varchar(200) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `lokasi_wisata` varchar(100) NOT NULL,
  `link_peta` varchar(300) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `destinasi`
--

INSERT INTO `destinasi` (`id_destinasi`, `nama_destinasi`, `id_kategori`, `lokasi_wisata`, `link_peta`, `deskripsi`) VALUES
(14, 'gunung gentong', 7, 'Taman Nasional Bromo ', 'https://www.openstreetmap.org/export/embed.html?bbox=112.88465023040773%2C-7.979550250062806%2C112.91718006134035%2C-7.954092063477967&amp;layer=mapnik&amp;marker=-7.9668213546569735%2C112.90091514587402', '<p style=\"text-align:center\"><strong>Gunung Gentong adalah salah satu gunung yang berada di kawasan Taman Nasional Bromo Tengger Semeru. Meskipun Gunung Gentong tidak sepopuler Gunung Bromo atau Gunung Semeru, gunung ini tetap menjadi bagian penting dari ekosistem kawasan yang terkenal karena pemandangan alamnya yang menakjubkan dan merupakan destinasi favorit para pendaki.</strong></p>\r\n'),
(16, 'Gunung Bromo', 7, 'Taman Nasional Bromo', 'https://www.openstreetmap.org/export/embed.html?bbox=112.95196026563646%2C-7.942865945795956%2C112.95399338006975%2C-7.941274713075184&amp;layer=mapnik', '\r\nGunung Bromo adalah salah satu gunung berapi paling terkenal di Indonesia, terletak di Jawa Timur dan merupakan bagian dari Taman Nasional Bromo Tengger Semeru. Gunung ini memiliki ketinggian sekitar 2.329 meter di atas permukaan laut dan dikenal dengan kawahnya yang aktif serta pemandangan alam yang menakjubkan.'),
(17, 'Pura Luhur Poten', 7, 'Bromo Tengger Semeru', 'https://www.openstreetmap.org/export/embed.html?bbox=112.61672973632814%2C-8.22915967942778%2C113.13720703125001%2C-7.821888201898094&amp;layer=mapnik&amp;marker=-8.025574963173673%2C112.87696838378906', '<p>Pura Luhur Poten adalah salah satu pura yang terletak di kawasan Gunung Bromo, Jawa Timur, Indonesia. Pura ini memiliki keunikan tersendiri karena dibangun di tengah-tengah lautan pasir, yang merupakan bagian dari Taman Nasional Bromo Tengger Semeru</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `keterangan_foto` varchar(100) NOT NULL,
  `id_destinasi` int(11) NOT NULL,
  `nama_foto` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `keterangan_foto`, `id_destinasi`, `nama_foto`) VALUES
(8, 'Keindahan Gungung Bromo', 16, 'bromo2.png'),
(9, 'Keindahan Pura Luhur Poten', 17, '665046888_purabromo.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_asal` int(11) NOT NULL,
  `id_destinasi` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `jam_berangkat` time NOT NULL,
  `id_mobil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
(1, 'Wisata Buatan', 'Wisata Buatan adalah'),
(6, 'Wisata Kuliner', 'Wisata Kuliner Adalah...'),
(7, 'Wisata Alam', 'Wisata alam adalah...');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_mobil` int(11) NOT NULL,
  `jenis_mobil` varchar(100) NOT NULL,
  `nomor_polisi` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `harga_paket` bigint(10) NOT NULL,
  `nama_paket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `no_kursi` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id_profile` int(10) NOT NULL,
  `konten_profil` text NOT NULL,
  `foto_profil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_profile`, `konten_profil`, `foto_profil`) VALUES
(1, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n', '815273375_JUNI.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saran`
--

CREATE TABLE `saran` (
  `id_keluhan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul_saran` varchar(255) NOT NULL,
  `detail_saran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `saran`
--

INSERT INTO `saran` (`id_keluhan`, `id_user`, `judul_saran`, `detail_saran`) VALUES
(5, 10, 'Aplikasi Error', 'Aplikasi dari tahap login dan register sudah tidak dapat dibuka'),
(6, 7, 'Aplikasi Bagus', 'Aplikasinya Sudah Lumayan Bagus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_resi` int(11) NOT NULL,
  `no_rek` int(11) NOT NULL,
  `tgl_transfer` date NOT NULL,
  `jam_transfer` time NOT NULL,
  `id_pesan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `username`, `password`) VALUES
(1, 'lastico Ridho', 'lastico@gmail.com', 'lastico', '44040e4f899826df678890e13f074cda'),
(2, 'fajar nugra', 'fajar@gmail.com', 'fajar', '7bedc9fd30769590c992b8f7f23738f7'),
(3, 'lintangascacia', 'lintang@gmail.com', 'ascacia', '$2y$10$RzhJUFTJO/kr3ZgDG53QKuSgDOpknEcMBbUQnHRak9.91QOceX.Te'),
(5, 'iphone', 'iphone@gmail.com', 'ipon', '$2y$10$HgypWPWYeaiXYC.698Or0OSnTUBs4atfLfnKxcuqh/g7WJyrSdT62'),
(6, 'vadel bajideh', 'vadel@gmail.com', 'vadel', '$2y$10$InCg9DhOgAk1EuvxAKKE9.3Dvd3R4v9t9n70lySXC/wV1wXPbsoJu'),
(7, 'coffemore', 'coffemore@gmail.com', 'coffe', '$2y$10$YJeB5iizb0frkXf.RCY20.iBdd79dWxFIFWjx53FN/2ulkR/V4yXy'),
(8, 'sopan', 'sopansantun@gmail.com', 'sopan', '$2y$10$ng50d70ZrXCjaeHHMwHVqORpS.iyUxGqiwOB2SDouJj..d3lGSpnS'),
(9, 'travelmaster', 'travelmaster@gmail.com', 'travelmaster', '$2y$10$51JRmYxwsvgPIh.H0I1CtOD6F6VOXVJGj1/EVOMxr5hck6NbWR4gW'),
(10, 'agus', 'agus@gmail.com', 'agus', '$2y$10$P1AfDCQXjFd32G/4mz2RVetXA.c7wJOtZnFNgcfPsQ3gGvOFR.MoW');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `asal`
--
ALTER TABLE `asal`
  ADD PRIMARY KEY (`id_asal`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `fk_id_admin` (`id_admin`);

--
-- Indeks untuk tabel `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`id_destinasi`),
  ADD KEY `fk_id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`),
  ADD KEY `fk_id_destinasi2` (`id_destinasi`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_id_asal` (`id_asal`),
  ADD KEY `fk_id_destinasi` (`id_destinasi`),
  ADD KEY `fk_id_mobil` (`id_mobil`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `fk_id_jadwal` (`id_jadwal`),
  ADD KEY `fk_id_user2` (`id_user`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indeks untuk tabel `saran`
--
ALTER TABLE `saran`
  ADD PRIMARY KEY (`id_keluhan`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_resi`),
  ADD KEY `fk_id_pesan2` (`id_pesan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `asal`
--
ALTER TABLE `asal`
  MODIFY `id_asal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `destinasi`
--
ALTER TABLE `destinasi`
  MODIFY `id_destinasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profile` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `saran`
--
ALTER TABLE `saran`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `fk_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `destinasi`
--
ALTER TABLE `destinasi`
  ADD CONSTRAINT `fk_id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `fk_id_destinasi2` FOREIGN KEY (`id_destinasi`) REFERENCES `destinasi` (`id_destinasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_id_asal` FOREIGN KEY (`id_asal`) REFERENCES `asal` (`id_asal`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_destinasi` FOREIGN KEY (`id_destinasi`) REFERENCES `destinasi` (`id_destinasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_mobil` FOREIGN KEY (`id_mobil`) REFERENCES `kendaraan` (`id_mobil`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `fk_id_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_user2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `saran`
--
ALTER TABLE `saran`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_id_pesan2` FOREIGN KEY (`id_pesan`) REFERENCES `pesan` (`id_pesan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
