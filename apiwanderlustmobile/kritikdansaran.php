<?php
include "koneksi.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

error_log("Received POST data: " . file_get_contents("php://input"));

$headers = apache_request_headers();
$token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;

if (!$token) {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak ditemukan."
    ));
    exit();
}

$sql_user = "SELECT id_user, username FROM user WHERE token = ?";
$stmt_user = $db->prepare($sql_user);
$stmt_user->bind_param("s", $token);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows === 0) {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak valid."
    ));
    exit();
}

$row_user = $result_user->fetch_assoc();
$id_user = $row_user['id_user'];
$username = $row_user['username'];

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if (strpos($contentType, 'application/json') !== false) {
    $data = json_decode(file_get_contents("php://input"), true);
} else {
    $data = array(
        'judul_saran' => isset($_POST['judul_saran']) ? $_POST['judul_saran'] : '',
        'detail_saran' => isset($_POST['detail_saran']) ? $_POST['detail_saran'] : ''
    );
}

error_log("Processed data: " . print_r($data, true));

$judul_saran = $db->real_escape_string($data['judul_saran']);
$detail_saran = $db->real_escape_string($data['detail_saran']);

$sql = "INSERT INTO saran (id_user, judul_saran, detail_saran) VALUES (?, ?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("iss", $id_user, $judul_saran, $detail_saran);

if ($stmt->execute()) {
    echo json_encode(array(
        "status" => "berhasil",
        "message" => "Kritik dan saran berhasil dikirim."
    ));
} else {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Terjadi kesalahan: " . $stmt->error
    ));
}

$stmt->close();
$db->close();
