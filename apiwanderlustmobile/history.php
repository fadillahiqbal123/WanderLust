<?php
include 'koneksi.php';

header('Content-Type: application/json');

$headers = apache_request_headers();
$token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;

if (!$token) {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak ditemukan"
    ));
    exit();
}

$stmt = $db->prepare("SELECT id_user FROM user WHERE token = ?");
$stmt->bind_param('s', $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak valid"
    ));
    exit();
}
$stmt->close();

$sql = "SELECT keterangan_foto, nama_foto FROM galeri";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $galeri_list = array();

    while ($row = $result->fetch_assoc()) {
        $foto_path = 'http://172.22.32.1/wanderlust/admin/img_galeri/' . $row['nama_foto'];

        $galeri_list[] = array(
            "keterangan_foto" => $row['keterangan_foto'],
            "nama_foto" => $foto_path
        );
    }

    echo json_encode(array(
        "status" => "berhasil",
        "message" => "Data galeri berhasil diambil.",
        "data" => $galeri_list
    ));
} else {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Tidak ada galeri tersedia."
    ));
}

$db->close();
