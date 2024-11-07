<?php 
session_start(); // Pastikan sesi sudah dimulai
include "koneksi.php"; // Ganti dengan file koneksi database Anda

// Ambil data dari form

$judul_saran = $_POST['judul_saran'];
$detail_saran = $_POST['detail_saran'];

// Ambil username dari sesi
$username = $_SESSION['username']; 

// Query untuk mendapatkan id_user berdasarkan username
$sql_user = "SELECT id_user FROM user WHERE username = '$username'";
$result_user = $db->query($sql_user);

if ($result_user->num_rows > 0) {
    // Jika ada, ambil id_user
    $row_user = $result_user->fetch_assoc();
    $id_user = $row_user['id_user'];

    // SQL untuk menyimpan kritik dan saran
    $sql = "INSERT INTO saran (id_user, judul_saran, detail_saran) VALUES ('$id_user', '$judul_saran', '$detail_saran')";

    if ($db->query($sql) === TRUE) {
        echo "<script>
        alert('Kritik dan saran berhasil dikirim.');
        window.location.href = 'dashboard.php'; // Redirect ke dashboard
      </script>";
exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
} else {
    echo "Pengguna tidak ditemukan.";
}

// Tutup koneksi jika perlu
$db->close();






?>