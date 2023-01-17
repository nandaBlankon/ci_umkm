-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2023 pada 08.25
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db2022_umkm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_order`
--

CREATE TABLE `tb_detail_order` (
  `id_do` int(10) UNSIGNED NOT NULL,
  `id_order` int(10) DEFAULT NULL,
  `id_penjual` char(10) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `warna` varchar(10) DEFAULT NULL,
  `ukuran` varchar(10) DEFAULT NULL,
  `total_harga` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Belum Dikirim, 1=Barang Dikirim,\r\n2=Barang Diterima'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detail_order`
--

INSERT INTO `tb_detail_order` (`id_do`, `id_order`, `id_penjual`, `id_produk`, `qty`, `warna`, `ukuran`, `total_harga`, `status`) VALUES
(12, 7, '0409220001', 8, 1, 'Hitam', 'M', '40000', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_image_produk`
--

CREATE TABLE `tb_image_produk` (
  `id_image` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_image_produk`
--

INSERT INTO `tb_image_produk` (`id_image`, `id_produk`, `image`) VALUES
(3, 6, 'ip-220903-bae7d9d6ba.png'),
(4, 6, 'ip-220903-852bddc094.png'),
(5, 6, 'ip-220903-9fe018c73a.png'),
(6, 7, 'ip-220903-a422c893b1.png'),
(7, 7, 'ip-220903-a73cc2fcdc.png'),
(8, 8, 'ip-220904-b65e5704d6.png'),
(9, 8, 'ip-220904-c9e7c3ca2a.png'),
(10, 9, 'ip-220904-36a8057036.png'),
(11, 9, 'ip-220904-111bb48f0d.png'),
(12, 9, 'ip-220904-b226a145e7.png'),
(13, 9, 'ip-220904-fe25d9893e.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` char(8) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `slug`, `image`) VALUES
('IDK-0001', 'makanan & minuman', 'makanan-minuman', 'kat-220830-26d40d8012.png'),
('IDK-0002', 'pakaian pria', 'pakaian-pria', 'kat-220830-3847e2bc20.png'),
('IDK-0003', 'pakaian wanita', 'pakaian-wanita', 'kat-220830-e37b6df31a.png'),
('IDK-0004', 'fashion muslim', 'fashion-muslim', 'kat-220830-c8e30f6643.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(10) NOT NULL,
  `id_pembeli` char(10) DEFAULT NULL,
  `bukti_pembayaran` varchar(100) DEFAULT NULL,
  `status_order` int(1) DEFAULT 1,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `grand_total` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `id_pembeli`, `bukti_pembayaran`, `status_order`, `tanggal`, `grand_total`) VALUES
(7, '0109220001', 'struk-221012-b5542f34f2.png', 1, '2022-10-12 14:28:11', '40000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_usaha` char(8) DEFAULT NULL,
  `id_kategori` char(8) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` varchar(10) DEFAULT NULL,
  `stok` char(4) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  `berat` varchar(10) DEFAULT NULL,
  `kondisi` varchar(10) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_usaha`, `id_kategori`, `judul`, `deskripsi`, `harga`, `stok`, `satuan`, `berat`, `kondisi`, `slug`) VALUES
(6, 'IDU-0001', 'IDK-0001', 'Dodol khas Aceh/ makanan khas Aceh/oleh-oleh khas Aceh', 'Dodol Aceh merupakan dodol yang diproduksi oleh masyarakat Aceh Besar dengan cara tradisional yang memiliki cita rasa khas dan original. Dodol Aceh ini menjadi oleh-oleh unggulan yang di cari dan di minati oleh masyarakat, wisatawan dan turis.\r\n\r\nBerat Bersih : 230 gr\r\nBerat Kemasan : 20 Gr\r\nHarga : 12.000/Pcs (Kemasan Panjang)\r\nRasa : Original\r\nLokasi Produksi : Aceh Besar, Aceh.\r\nKadaluarsa : 1 bulan dari tanggal pengiriman\r\n*produk yang dikirim merupakan produk yang baru di produksi', '12000', '1000', 'Buah', NULL, NULL, 'dodol-khas-aceh-makanan-khas-aceh-oleh-oleh-khas-aceh'),
(7, 'IDU-0001', 'IDK-0001', 'Bhoi Ikan Khas Aceh Besar / isi talam bolu ikan ukuran besar', 'Kue Bhoi Khas Ikan merupakan kue bolu yang di cetak dalam cetakan berbentuk iklan dengan cita rasa yang berbeda dengan kue bolu lainnya. kue ini memiliki resep yang unik yang di peroleh dari turun menurun.', '21000', '500', 'Paket', NULL, NULL, 'bhoi-ikan-khas-aceh-besar-isi-talam-bolu-ikan-ukuran-besar'),
(8, 'IDU-0002', 'IDK-0002', 'Baju kaos polos leher V', 'Baju kaos polos leher V dengan berbagai warna dan ukuran.', '40000', '599', 'Pcs', NULL, 'Baru', 'baju-kaos-polos-leher-v'),
(9, 'IDU-0002', 'IDK-0002', 'Kemeja Flanel Pria Kotak Kotak Lengan Panjang Bahan Wol Tebal - Motif 5', 'Kemeja Flanel Pria Wanita\r\n\r\n-Bahan Flanel Wol\r\n- Adem nyaman ngga bikin gerah\r\n- Real Pict\r\n- Motif Terbaru dan Kekinian\r\n\r\nUkuran :\r\nM : Lebar Dada 50 cm x Panjang 68 cm\r\nL : Lebar Dada 52 cm x Panjang 70 cm\r\nXL : Lebar Dada 54 cm x Panjang 72 cm\r\n\r\nNote : Apabila Barang cacad sobek salah ukuran, bisa di retur garansi 100%, dengan catatan ada video unboxing barang dan tag belum di cabut\r\n\r\nTerima Kasih ????', '85000', '1200', 'Pcs', '200', 'Baru', 'kemeja-flanel-pria-kotak-kotak-lengan-panjang-bahan-wol-tebal-motif-5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id_profil` int(11) NOT NULL,
  `user_id` char(10) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` char(12) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `desa` varchar(35) DEFAULT NULL,
  `kecamatan` varchar(35) DEFAULT NULL,
  `kabupaten` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_profil`
--

INSERT INTO `tb_profil` (`id_profil`, `user_id`, `alamat`, `no_telp`, `email`, `desa`, `kecamatan`, `kabupaten`) VALUES
(1, '0109220001', 'Dusun Melati', '123456789012', 'khadijah@gmail.com', 'Meunasah Raya', 'Padang Tiji', 'Pidie');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ukuran`
--

CREATE TABLE `tb_ukuran` (
  `id_ukuran` int(11) NOT NULL,
  `ukuran` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ukuran`
--

INSERT INTO `tb_ukuran` (`id_ukuran`, `ukuran`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL'),
(6, '3XL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ukuran_produk`
--

CREATE TABLE `tb_ukuran_produk` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_ukuran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ukuran_produk`
--

INSERT INTO `tb_ukuran_produk` (`id`, `id_produk`, `id_ukuran`) VALUES
(7, 8, 1),
(8, 8, 2),
(9, 8, 3),
(10, 9, 1),
(11, 9, 2),
(12, 9, 3),
(13, 9, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_usaha`
--

CREATE TABLE `tb_usaha` (
  `id_usaha` char(8) NOT NULL,
  `user_id` char(10) DEFAULT NULL,
  `nama_usaha` varchar(50) DEFAULT NULL,
  `alamat_usaha` text DEFAULT NULL,
  `desa` varchar(20) DEFAULT NULL,
  `kecamatan` varchar(20) DEFAULT NULL,
  `kabupaten` varchar(20) DEFAULT NULL,
  `no_hp` char(12) DEFAULT NULL,
  `jenis_usaha` enum('UMKM','Home Industri') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `image_usaha` varchar(100) DEFAULT NULL,
  `bergabung` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_usaha`
--

INSERT INTO `tb_usaha` (`id_usaha`, `user_id`, `nama_usaha`, `alamat_usaha`, `desa`, `kecamatan`, `kabupaten`, `no_hp`, `jenis_usaha`, `keterangan`, `image_usaha`, `bergabung`) VALUES
('IDU-0001', '0109220001', 'khadijah bakery', 'jln. banda aceh - medan', 'grong-grong', 'grong-grong', 'pidie', '082131415161', 'UMKM', 'Khadijah Bakery adalah sebuah Usaha Mikro Kecil dan Menengah yang menjual berbagai aneka kue tradisional Aceh. Seperti: Timphan, Dhoi-Dhoi, wajeb, dll.\r\nKami juga menerima pesanan dalam jumlah yang banyak, silakan hubungi langsung ke nomor wa yang tertera.', NULL, '2022-09-02 08:23:42'),
('IDU-0002', '0409220001', 'ajir fashion store', ' Jl. Prof. A. Majid Ibrahim', 'pante teungoh', 'kota sigli', 'pidie', '082131417771', 'Home Industri', 'AJIR FASHION STORE menjual berbagai baju pria, menerima order baju olahraga untuk SD,SMP,SMA,Organisasi dll.', NULL, '2022-09-04 14:00:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` char(10) NOT NULL,
  `username` varchar(35) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `jekel` varchar(2) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `level` int(1) NOT NULL COMMENT '1=admin,2=penjualan,3=pembeli',
  `image` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `password`, `nama`, `jekel`, `tanggal`, `level`, `image`) VALUES
('2409200002', 'admin@umkm.com', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'Siti Anisah', 'P', '2020-09-28 13:36:44', 1, NULL),
('0109220001', 'khadijah@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Khadijah', 'P', '2022-09-01 15:56:01', 2, 'image-220902-0c9bfb589f.png'),
('0409220001', 'muhajir@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'muhajir', 'L', '2022-09-04 13:52:04', 2, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_warna`
--

CREATE TABLE `tb_warna` (
  `id_warna` int(11) NOT NULL,
  `warna` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_warna`
--

INSERT INTO `tb_warna` (`id_warna`, `warna`) VALUES
(1, 'Hitam'),
(2, 'Putih'),
(3, 'Merah'),
(4, 'Biru'),
(5, 'Kuning'),
(6, 'Hijau'),
(7, 'Abu-Abu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_warna_produk`
--

CREATE TABLE `tb_warna_produk` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_warna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_warna_produk`
--

INSERT INTO `tb_warna_produk` (`id`, `id_produk`, `id_warna`) VALUES
(6, 8, 1),
(7, 8, 2),
(8, 9, 1),
(9, 9, 2),
(10, 9, 3),
(11, 9, 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  ADD PRIMARY KEY (`id_do`);

--
-- Indeks untuk tabel `tb_image_produk`
--
ALTER TABLE `tb_image_produk`
  ADD PRIMARY KEY (`id_image`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indeks untuk tabel `tb_ukuran`
--
ALTER TABLE `tb_ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- Indeks untuk tabel `tb_ukuran_produk`
--
ALTER TABLE `tb_ukuran_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_usaha`
--
ALTER TABLE `tb_usaha`
  ADD PRIMARY KEY (`id_usaha`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tb_warna`
--
ALTER TABLE `tb_warna`
  ADD PRIMARY KEY (`id_warna`);

--
-- Indeks untuk tabel `tb_warna_produk`
--
ALTER TABLE `tb_warna_produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  MODIFY `id_do` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_image_produk`
--
ALTER TABLE `tb_image_produk`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_ukuran`
--
ALTER TABLE `tb_ukuran`
  MODIFY `id_ukuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_ukuran_produk`
--
ALTER TABLE `tb_ukuran_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_warna`
--
ALTER TABLE `tb_warna`
  MODIFY `id_warna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_warna_produk`
--
ALTER TABLE `tb_warna_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
