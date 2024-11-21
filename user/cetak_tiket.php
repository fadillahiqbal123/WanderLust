<?php

include 'koneksi.php';
require('fpdf/fpdf.php'); 


$id_pesan = isset($_GET['id_pesan']) ? $_GET['id_pesan'] : null;


if ($id_pesan === null) {
    die('ID Pesan tidak ditemukan.');
}


$query = "SELECT pesan.id_pesan, user.username, asal.alamat, destinasi.nama_destinasi, 
            jadwal.tgl_berangkat, jadwal.jam_berangkat, jadwal.harga, pesan.status
          FROM pesan
          JOIN user ON user.id_user = pesan.id_user
          JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
          JOIN asal ON jadwal.id_asal = asal.id_asal
          JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
          WHERE pesan.id_pesan = '$id_pesan'";


$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);


if (!$row) {
    die('Data pemesanan tidak ditemukan.');
}


$pdf = new FPDF();
$pdf->AddPage();

$pageWidth = $pdf->GetPageWidth();
$imageWidth = 40;

$xCenter = ($pageWidth - $imageWidth) / 2;

$pdf->Image('image/logo_wanderlust.png',  $xCenter, 10, $imageWidth);
$pdf->Ln(30); 

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, 'Tiket Pemesanan', 0, 1, 'C');


$pdf->Ln(5); 

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'ID Pesan              : ');
$pdf->Cell(0, 10, $row['id_pesan'], 0, 1);

$pdf->Cell(40, 10, 'Nama Pemesan   :');
$pdf->Cell(0, 10, $row['username'], 0, 1);

$pdf->Cell(40, 10, 'Alamat                  : ');
$pdf->Cell(0, 10, $row['alamat'], 0, 1);

$pdf->Cell(40, 10, 'Destinasi              : ');
$pdf->Cell(0, 10, $row['nama_destinasi'], 0, 1);

$pdf->Cell(40, 10, 'Tanggal Berangkat  : ');
$pdf->Cell(0, 10, $row['tgl_berangkat'], 0, 1);

$pdf->Cell(40, 10, 'Jam Berangkat       : ');
$pdf->Cell(0, 10, $row['jam_berangkat'], 0, 1);

$pdf->Cell(40, 10, 'Harga                     : ');
$pdf->Cell(0, 10, 'Rp. ' . number_format($row['harga'], 0, ',', '.'), 0, 1);

$pdf->Cell(40, 10, 'Status                : ');
$pdf->Cell(0, 10, $row['status'], 0, 1);

// untuk spasi ini
$pdf->Ln(20); 
$pdf->SetFont('Arial', 'I', 10);
$pdf->MultiCell(0, 10, "Terima kasih telah memesan tiket dengan kami.\nKami berharap Anda memiliki perjalanan yang menyenangkan dan aman.\n\nBromo lebih dikit Perjalanan Lebih Nyaman,\nTim WanderLuset", 0, 'C');

// Output PDF
$pdf->Output('I', 'Tiket_' . $row['id_pesan'] . '.pdf');
?>