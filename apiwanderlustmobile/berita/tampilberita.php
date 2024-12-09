<?php
include '../koneksi.php';

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

$sql = "SELECT id_berita, judul_berita, tgl_berita, konten_berita, foto_berita FROM berita ORDER BY id_berita DESC";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $berita_list = array();

    while ($row = $result->fetch_assoc()) {
        $foto_path = 'http://172.22.32.1/wanderlust/admin/img_berita/' . $row['foto_berita'];

        $berita_list[] = array(
            "judul_berita" => $row['judul_berita'],
            "tgl_berita" => date('d-m-Y', strtotime($row['tgl_berita'])),
            "konten_berita" => $row['konten_berita'],
            "foto_berita" => $foto_path
        );
    }

    echo json_encode(array(
        "status" => "berhasil",
        "message" => "Data berita berhasil diambil.",
        "data" => $berita_list
    ));
} else {
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Tidak ada berita tersedia."
    ));
}

$db->close();
