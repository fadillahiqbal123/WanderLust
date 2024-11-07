<?php
session_start();
include "koneksi.php"; // Pastikan koneksi database Anda sudah benar

$idj = isset($_GET['i']) ? intval($_GET['i']) : null; // Ambil ID dari URL dan sanitasi

// Query untuk mengambil data dari tabel 'pesan', 'jadwal', dan 'user'
$querya = "SELECT * FROM pesan
            JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
            JOIN user ON pesan.id_user = user.id_user
            WHERE jadwal.id_jadwal = ?"; // Gunakan ? sebagai placeholder

// Persiapkan statement untuk menghindari SQL Injection
$stmt_query = $db->prepare($querya);
$stmt_query->bind_param("i", $idj);
$stmt_query->execute();
$result_query = $stmt_query->get_result();

// Memastikan data POST diterima
global $_POST;

if (empty($_POST["no_kursi"]) || empty($_POST["status"]) || empty($_POST["id_jadwal"]) || empty($_POST["id_user"])) {
    echo "<script>alert('Semua Field Harus Diisi'); window.location='formpesan.php?idp=$idj';</script>";
} else {
    // Query insert untuk menambahkan data ke tabel 'pesan'
    $sql_insert = "INSERT INTO pesan (no_kursi, status, id_jadwal, id_user) VALUES (?, ?, ?, ?)";
    
    // Persiapan statement untuk menghindari SQL Injection
    $stmt_insert = $db->prepare($sql_insert);
    $stmt_insert->bind_param("ssii", $_POST["no_kursi"], $_POST["status"], $_POST["id_jadwal"], $_POST["id_user"]);

    if ($stmt_insert->execute()) {
        // Arahkan ke halaman konfirmasi jika berhasil
        echo "<script>location.href = 'konfirmasipesan.php?i=$idj';</script>";
    } else {
        // Tampilkan pesan kesalahan jika gagal
        echo "<script>alert('Gagal menyimpan data: " . $stmt_insert->error . "');</script>";
    }
}
?>
