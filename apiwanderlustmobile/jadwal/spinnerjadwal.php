<?php
require_once '../koneksi.php';
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
$queryKeberangkatan = "SELECT id_asal, alamat FROM asal";
$resultKeberangkatan = $db->query($queryKeberangkatan);

$keberangkatan = array();
if ($resultKeberangkatan->num_rows > 0) {
    while ($row = $resultKeberangkatan->fetch_assoc()) {
        $keberangkatan[] = array(
            "id_asal" => $row['id_asal'],
            "alamat" => $row['alamat']
        );
    }
}
$queryTujuan = "SELECT id_destinasi, nama_destinasi FROM destinasi";
$resultTujuan = $db->query($queryTujuan);
$tujuan = array();
if ($resultTujuan->num_rows > 0) {
    while ($row = $resultTujuan->fetch_assoc()) {
        $tujuan[] = array(
            "id_destinasi" => $row['id_destinasi'],
            "nama_destinasi" => $row['nama_destinasi']
        );
    }
}
if (!empty($keberangkatan) || !empty($tujuan)) {
    http_response_code(200);
    echo json_encode(array(
        "status" => "sukses",
        "message" => "Data berhasil diambil.",
        "keberangkatan" => $keberangkatan,
        "tujuan" => $tujuan
    ));
} else {
    http_response_code(404);
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Data keberangkatan atau tujuan tidak ditemukan."
    ));
}
$db->close();
