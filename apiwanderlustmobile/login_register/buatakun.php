<?php
include "../koneksi.php";

$nama_user = trim($_POST['nama_user'] ?? '');
$email = trim($_POST['email'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

// Log untuk debugging
error_log("Nama User: $nama_user, Email: $email, Username: $username, Password: $password");

// Validasi input
if (!$nama_user || !$email || !$username || !$password) {
    echo json_encode(['status' => 'input_tidak_valid', 'message' => 'Semua kolom harus diisi.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'input_tidak_valid', 'message' => 'Format email tidak valid.']);
    exit;
}

// Cek apakah username sudah ada
$stmt = $db->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(['status' => 'username_sudah_ada', 'message' => 'Username sudah digunakan.']);
    exit;
}

// Cek apakah email sudah ada
$stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(['status' => 'email_sudah_ada', 'message' => 'Email sudah digunakan.']);
    exit;
}

// Insert ke database
$verifikasi_code = rand(100000, 999999);
$is_verif = '1';
$hash_password = password_hash($password, PASSWORD_BCRYPT);
$stmt = $db->prepare("INSERT INTO user (nama_user, email, username, password, verifikasi_code, is_verif) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nama_user, $email, $username, $hash_password, $verifikasi_code, $is_verif);

if ($stmt->execute()) {
    echo json_encode(['status' => 'data_tersimpan']);
} else {
    echo json_encode(['status' => 'gagal', 'error' => 'Terjadi kesalahan saat menyimpan data.']);
}
$stmt->close();
$db->close();
