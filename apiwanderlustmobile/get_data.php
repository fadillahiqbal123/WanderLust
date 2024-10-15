<?php
include "koneksi.php";

// Ambil id_user dari request POST atau GET
$id_user = $_POST['id_user'];  // atau $_GET['id_user'] jika menggunakan metode GET

// Query SQL untuk mengambil data tanpa memfilter verifikasi_code dan is_verif
$sql = "SELECT id_user, nama_user, email, username, password FROM user WHERE id_user = '" . $id_user . "'";

// Eksekusi query
$query = mysqli_query($db, $sql);

// Periksa apakah query berhasil
if ($query) {
    $data = mysqli_fetch_assoc($query);

    // Cek apakah data ditemukan
    if ($data) {
        // Tampilkan data tanpa verifikasi_code dan is_verif
        echo json_encode($data);
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Data tidak ditemukan'));
    }
} else {
    // Jika ada kesalahan pada query, tampilkan pesan error
    echo json_encode(array('status' => 'error', 'message' => 'Query gagal dijalankan'));
}
