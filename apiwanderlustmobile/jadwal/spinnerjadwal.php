<?php
require_once '../koneksi.php';
// Ambil token dari header
$headers = apache_request_headers();
$token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;
// Periksa apakah token ada
if (!$token) {
    http_response_code(401);
    echo json_encode(array(
        "status" => "gagal",
        "message" => "Token tidak ditemukan"
    ));
    exit();
}

// Query untuk mendapatkan data keberangkatan (tabel asal)
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
// Query untuk mendapatkan data tujuan (tabel destinasi)
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
// Menggabungkan data keberangkatan dan tujuan ke dalam satu respons JSON
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
// Tutup koneksi database
$db->close();
