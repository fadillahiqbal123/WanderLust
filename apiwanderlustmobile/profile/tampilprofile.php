<?php
include '../koneksi.php';

header('Content-Type: application/json');

$headers = apache_request_headers();
$token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;

if (!$token) {
    http_response_code(401);
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak ditemukan"
    ));
    exit();
}
$query = "SELECT nama_user, email, username, password FROM user WHERE token = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    $data['nama_user'] = htmlspecialchars($data['nama_user']);
    $data['email'] = htmlspecialchars($data['email']);
    $data['username'] = htmlspecialchars($data['username']);
    $data['password'] = htmlspecialchars($data['password']);

    echo json_encode(array(
        "status" => "berhasil",
        "message" => "Data user berhasil diambil.",
        "data" => $data
    ));
} else {
    http_response_code(404);
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak valid atau user tidak ditemukan."
    ));
}

$stmt->close();
$db->close();
