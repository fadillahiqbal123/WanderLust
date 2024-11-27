<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include $_SERVER['DOCUMENT_ROOT'] . "/destinasi-wisata/admin/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/destinasi-wisata/admin/fpdf/fpdf.php";

$tgl_awal = isset($_GET['awal']) ? $_GET['awal'] : '';
$tgl_akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';

if (empty($tgl_awal) || empty($tgl_akhir)) {
    die("Tanggal awal dan akhir harus diisi.");
}


$query = "
    SELECT 
        transaksi.id_pesan, 
        transaksi.no_resi, 
        transaksi.tgl_transfer, 
        user.username, 
        jadwal.harga, 
        asal.alamat, 
        destinasi.nama_destinasi
    FROM transaksi
    JOIN pesan ON transaksi.id_pesan = pesan.id_pesan
    JOIN user ON pesan.id_user = user.id_user
    JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
    JOIN asal ON jadwal.id_asal = asal.id_asal
    JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
    WHERE pesan.status = 'Lunas' 
    AND transaksi.tgl_transfer BETWEEN '$tgl_awal' AND '$tgl_akhir'
    ORDER BY transaksi.tgl_transfer";


$result = mysqli_query($db, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($db));
}


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetMargins(10, 10, 10);


$pdf->Cell(0, 10, 'Laporan Transaksi Periode ' . $tgl_awal . ' s/d ' . $tgl_akhir, 0, 1, 'C');
$pdf->Ln(5);


$pdf->SetFont('Arial', 'B', 10);
$col_widths = array(20, 60, 30, 40, 30);

$pdf->Cell($col_widths[0], 8, 'ID Pesan', 1, 0, 'C');
$pdf->Cell($col_widths[1], 8, 'Jadwal', 1, 0, 'C');
$pdf->Cell($col_widths[2], 8, 'Tgl Transfer', 1, 0, 'C');
$pdf->Cell($col_widths[3], 8, 'Username', 1, 0, 'C');
$pdf->Cell($col_widths[4], 8, 'Harga', 1, 1, 'C');


$pdf->SetFont('Arial', '', 10);
$subtotal = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $startX = $pdf->GetX(); 
    $startY = $pdf->GetY(); 
    
    $alamat_destinasi = "Alamat: " . $row['alamat'] . "\nDestinasi: " . $row['nama_destinasi'];

    // $pdf->Cell($col_widths[0], 10, $row['id_pesan'], 1, 0, 'C'); 
    $pdf->SetXY($startX + $col_widths[0], $startY);
    $pdf->MultiCell($col_widths[1], 5, $alamat_destinasi, 1, 'L');
    
    $currentY = $pdf->GetY();
    $cellHeight = $currentY - $startY;

   /* $x = $pdf->GetX(); 
    $y = $pdf->GetY();
    $pdf->MultiCell($col_widths[1], 5, $alamat_destinasi, 1, 'L');
    $currentY = $pdf->GetY(); 
    $height = $currentY - $y; 
    $pdf->SetXY($x + $col_widths[1], $y);*/ 
    
    $pdf->SetXY($startX, $startY); 
    $pdf->Cell($col_widths[0], $cellHeight, $row['id_pesan'], 1, 0, 'C'); // ID Pesan
    $pdf->SetXY($startX + $col_widths[0] + $col_widths[1], $startY); // Pindah ke kolom berikutnya
    $pdf->Cell($col_widths[2], $cellHeight, $row['tgl_transfer'], 1, 0, 'C');
    $pdf->Cell($col_widths[3], $cellHeight, $row['username'], 1, 0, 'C');
    $pdf->Cell($col_widths[4], $cellHeight, number_format($row['harga'], 0, ',', '.'), 1, 1, 'R');

    $subtotal += $row['harga'];
}



$pdf->Cell(array_sum($col_widths) - $col_widths[4], 10, 'Grand Total:', 1, 0, 'R');
$pdf->Cell($col_widths[4], 10, number_format($subtotal, 0, ',', '.'), 1, 1, 'R');


$pdf->Output();

?>
