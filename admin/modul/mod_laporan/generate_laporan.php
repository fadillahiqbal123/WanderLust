<?php
require_once('./fpdf/fpdf.php');

// Menangkap data filter tanggal dan data transaksi dari URL
$tgl_awal = isset($_GET['awal']) ? $_GET['awal'] : '';
$tgl_akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';
$data_transaksi = isset($_GET['data']) ? json_decode($_GET['data'], true) : [];

if (empty($tgl_awal) || empty($tgl_akhir)) {
    die("Tanggal awal dan akhir harus diisi.");
}

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Laporan Periode Lunas ' . $tgl_awal . ' s/d ' . $tgl_akhir, 0, 1, 'C');

// Header tabel
$pdf->SetFont('Courier', 'B', 10);
$pdf->Cell(20, 10, 'ID Pesan', 1);
$pdf->Cell(40, 10, 'Jadwal', 1);
$pdf->Cell(30, 10, 'Tgl Berangkat', 1);
$pdf->Cell(30, 10, 'Tgl Transfer', 1);
$pdf->Cell(25, 10, 'Member', 1);
$pdf->Cell(25, 10, 'No Resi', 1);
$pdf->Cell(20, 10, 'Harga', 1);
$pdf->Ln();

// Menampilkan data transaksi
$pdf->SetFont('Courier', '', 10);
$subtotal = 0;

foreach ($data_transaksi as $row) {
    $pdf->Cell(20, 10, $row[0], 1);
    $pdf->Cell(40, 10, $row[1], 1);
    $pdf->Cell(30, 10, $row[2], 1);
    $pdf->Cell(30, 10, $row[3], 1);
    $pdf->Cell(25, 10, $row[4], 1);
    $pdf->Cell(25, 10, $row[5], 1);
    $pdf->Cell(20, 10, number_format($row[6], 0, ',', '.'), 1);
    $pdf->Ln();
    $subtotal += $row[6];
}

// Menampilkan total
$pdf->Cell(170, 10, 'Grand Total:', 1, 0, 'R');
$pdf->Cell(20, 10, number_format($subtotal, 0, ',', '.'), 1, 1, 'R');

// Output file PDF
$pdf->Output('I', 'Laporan_Periode.pdf');
?>
