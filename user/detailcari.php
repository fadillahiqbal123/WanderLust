<?php

session_start();

if (!isset($_GET['var1'])) {
    die("ID jadwal tidak valid.");
}

include 'koneksi.php'; 

$id_jadwal = $_GET['var1'];


$query = "
    SELECT jadwal.*, kendaraan.jenis_mobil, kendaraan.warna_mobil, kendaraan.nomor_polisi, 
           asal.alamat AS asal_alamat, destinasi.nama_destinasi 
    FROM jadwal 
    JOIN kendaraan ON jadwal.id_mobil = kendaraan.id_mobil
    JOIN asal ON jadwal.id_asal = asal.id_asal
    JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
    WHERE jadwal.id_jadwal = '$id_jadwal'
";

$result = mysqli_query($db, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Jadwal tidak ditemukan.");
}

$jadwal = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pemesanan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
         <h3 class="mt-2 mb-3 text-center fw-bold h-font">DETAIL PEMESANAN</h3>
        </div>
        <div class="card-body">
            <h5 class="mb-4 text-center fw-bold h-font">Informasi Perjalanan</h5>
            <p><strong>Jurusan:</strong> <?php echo $jadwal['asal_alamat'] . ' - ' . $jadwal['nama_destinasi']; ?></p>
            <p><strong>Tanggal/Jam Berangkat:</strong> <?php echo date('d-m-Y H:i', strtotime($jadwal['tgl_berangkat'])); ?></p>
            <p ><strong>Harga:</strong> Rp. <?php echo number_format($jadwal['harga'], 0, ',', '.'); ?> IDR</p>

            <h5 class="mb-3 h-font">INFORMASI KENDARAAN</h5>
            <p><strong>Jenis Mobil:</strong> <?php echo $jadwal['jenis_mobil']; ?></p>
            <p><strong>Warna Mobil:</strong> <?php echo $jadwal['warna_mobil']; ?></p>
            <p><strong>Nomor Polisi:</strong> <?php echo $jadwal['nomor_polisi']; ?></p>

            <h5>Kursi Tersedia</h5>
            <p>
                <?php
                $queryKursi = "SELECT COUNT(no_kursi) AS terisi FROM pesan WHERE id_jadwal = '$id_jadwal'";
                $resultKursi = mysqli_query($db, $queryKursi);
                $dataKursi = mysqli_fetch_assoc($resultKursi);
                $kursiTersedia = 5 - $dataKursi['terisi'][0];
                
                echo $kursiTersedia;
                ?>
            </p>

            <?php if ($kursiTersedia > 0): ?>
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="formpesan.php?hal=pemesanan&idp=<?php echo $id_jadwal; ?>" class="btn btn-success">Pesan Sekarang</a>
                    <a href="dashboard.php" class="btn btn-danger">Batal</a>
                <?php else: ?>
                    <a href="index.php" class="btn btn-primary">Login untuk Memesan</a>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    Maaf, kursi untuk jadwal ini sudah penuh.
                </div>
            <?php endif; ?>
            <a href="jadwal.php" class="btn btn-danger">Batal</a>
        </div>
    </div>
</div>

</body>
</html>
