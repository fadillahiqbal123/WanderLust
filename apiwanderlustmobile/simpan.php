<?php
include "koneksi.php";

// Generate random ID for user
$id = rand(10, 20);

// Get user input
$nama_user = $_POST['nama_user'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Generate random verification code
$verifikasi_code = rand(100000, 999999); // Angka acak 6 digit
$is_verif = '1'; // Mengatur status verifikasi sebagai terverifikasi (1)

// Hash the password
$hash_password = md5($password);

// Prepare SQL statement
$stmt = $db->prepare("INSERT INTO `user` (`id_user`, `nama_user`, `email`, `username`, `password`, `verifikasi_code`, `is_verif`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssss", $id, $nama_user, $email, $username, $hash_password, $verifikasi_code, $is_verif);

// Execute statement and check for success
if ($stmt->execute()) {
    echo json_encode(array(
        'status' => 'data_tersimpan'
    ));
} else {
    echo json_encode(array(
        'status' => 'gagal'
    ));
}

// Close statement
$stmt->close();
