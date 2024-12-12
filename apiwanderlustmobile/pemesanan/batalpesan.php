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

    $data = json_decode(file_get_contents('php://input'), true);
    $id_pesan = isset($data['id_pesan']) ? $data['id_pesan'] : null;

    if (!$id_pesan) {
        echo json_encode(array(
            "status" => "gagal",
            "message" => "ID Pesan tidak ditemukan."
        ));
        exit();
    }

    $stmt = $db->prepare("DELETE FROM pesan WHERE id_pesan = ?");
    $stmt->bind_param('s', $id_pesan);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(array(
            "status" => "berhasil",
            "message" => "Pemesanan berhasil dibatalkan."
        ));
    } else {
        echo json_encode(array(
            "status" => "gagal",
            "message" => "ID Pesan tidak valid atau pemesanan sudah dihapus."
        ));
    }
} else {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak valid."
    ));
}

$stmt->close();
$db->close();
