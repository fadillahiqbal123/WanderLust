<?php
include "koneksi.php";

// Memeriksa apakah id_user ada dalam data POST
if (!isset($_POST['id_user'])) {
    echo json_encode(array('status' => 'error', 'message' => 'id_user tidak disediakan'));
    exit; // Hentikan eksekusi jika tidak ada id_user
}

$id_user = $_POST['id_user'];
$nama_user = isset($_POST['nama_user']) ? $_POST['nama_user'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? md5($_POST['password']) : null; // Menggunakan md5 untuk password

// Mempersiapkan query untuk memperbarui data
$sql = "UPDATE `user` SET `nama_user` = ?, `email` = ?, `username` = ?, `password` = ? WHERE `id_user` = ?";

// Mempersiapkan statement
$stmt = mysqli_prepare($db, $sql);

if ($stmt) {
    // Mengikat parameter; jika password tidak disediakan, gunakan nilai yang sama
    mysqli_stmt_bind_param($stmt, 'ssssi', $nama_user, $email, $username, $password, $id_user);

    // Menjalankan query
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        echo json_encode(array('status' => 'data_berhasil_diperbarui'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'data gagal diperbarui'));
    }

    // Menutup statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Gagal mempersiapkan statement'));
}

// Menutup koneksi
mysqli_close($db);
