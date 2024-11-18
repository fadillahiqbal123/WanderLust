<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start(); 

include "../../koneksi.php";
require_once('../../pdf/fpdf.php');

$orientation = 'P';
$size = 'A4';


$pdf = new FPDF($orientation, 'mm', 'A4');
$pdf->AddPage();

// Set font untuk judul dan data
$pdf->SetFont('Courier', '', 12);

// Ambil parameter tanggal dari URL dan cek validitasnya
$tgl_awal = isset($_GET['awal']) ? $_GET['awal'] : '';
$tgl_akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';

// Validasi tanggal
if (empty($tgl_awal) || empty($tgl_akhir)) {
    die("Tanggal awal dan akhir harus diisi.");
}

// Query untuk mengambil data
$query = "
    SELECT 
        transaksi.id_pesan, 
        asal.alamat, 
        destinasi.nama_destinasi, 
        jadwal.tgl_berangkat, 
        transaksi.tgl_transfer, 
        user.username, 
        transaksi.no_resi, 
        jadwal.harga
    FROM transaksi
    JOIN pesan ON transaksi.id_pesan = pesan.id_pesan
    JOIN user ON pesan.id_user = user.id_user
    JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
    JOIN asal ON jadwal.id_asal = asal.id_asal
    JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
    WHERE pesan.status = 'Lunas' 
    AND transaksi.tgl_transfer BETWEEN '$tgl_awal' AND '$tgl_akhir'";

$result = mysqli_query($db, $query);

// Cek jika query gagal
if (!$result) {
    die('Query Error: ' . mysqli_error($db));
}

// Tampilkan header laporan
$pdf->Cell(0, 10, 'Laporan Periode ' . $tgl_awal . ' s/d ' . $tgl_akhir, 0, 1, 'C');

// Set font untuk header tabel
$pdf->SetFont('Courier', 'B', 10); 
$pdf->Cell(20, 10, 'ID Pesan', 1);
$pdf->Cell(40, 10, 'Jadwal', 1);
$pdf->Cell(30, 10, 'Tgl Berangkat', 1);
$pdf->Cell(30, 10, 'Tgl Transfer', 1);
$pdf->Cell(25, 10, 'Member', 1);
$pdf->Cell(25, 10, 'No Resi', 1);
$pdf->Cell(20, 10, 'Harga', 1);
$pdf->Ln();

// Set font untuk data
$pdf->SetFont('Courier', '', 10); 
$subtotal = 0;

// Looping untuk menampilkan data transaksi
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(20, 10, $row['id_pesan'], 1);
    $pdf->Cell(40, 10, $row['alamat'] . ' - ' . $row['nama_destinasi'], 1);
    $pdf->Cell(30, 10, $row['tgl_berangkat'], 1);
    $pdf->Cell(30, 10, $row['tgl_transfer'], 1);
    $pdf->Cell(25, 10, $row['username'], 1);
    $pdf->Cell(25, 10, $row['no_resi'], 1);
    $pdf->Cell(20, 10, number_format($row['harga'], 0, ',', '.'), 1);
    $pdf->Ln();
    $subtotal += $row['harga'];
}

// Menampilkan Grand Total
$pdf->Cell(170, 10, 'Grand Total:', 1, 0, 'R');
$pdf->Cell(20, 10, number_format($subtotal, 0, ',', '.'), 1, 1, 'R');

// Output PDF ke browser
$pdf->Output('I', 'Laporan_Periode.pdf');

// Hentikan output buffering
ob_end_flush();
?>
