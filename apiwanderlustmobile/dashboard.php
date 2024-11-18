<?php
include('koneksi.php');

$headers = apache_request_headers();
$token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;

if (!$token) {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak ditemukan."
    ));
    exit();
}

$stmt = $db->prepare("SELECT * FROM user WHERE token = ?");
$stmt->bind_param('s', $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    echo json_encode(array(
        "status" => "berhasil",
        "message" => "Dashboard aktif.",
        "data" => array(
            "id_user" => $user['id_user'],
            "username" => $user['username'],
            "email" => $user['email'],
            "nama_user" => $user['nama_user'],
            "password" => $user['password']
        )
    ));
} else {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak valid."
    ));
}

$stmt->close();
$db->close();
