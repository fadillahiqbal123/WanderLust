<?php
session_start();
include "koneksi.php"; 

$idj = isset($_GET['i']) ? intval($_GET['i']) : null;

global $_POST;


if (empty($_POST["no_kursi"]) || empty($_POST["status"]) || empty($_POST["id_jadwal"]) || empty($_POST["id_user"])) {
    echo "<script>alert('Semua Field Harus Diisi'); window.location='formpesan.php?idp=$idj';</script>";
    exit;
}


$db->begin_transaction();

try {
    $no_kursi = $_POST["no_kursi"];
    $status = $_POST["status"];
    $id_jadwal = intval($_POST["id_jadwal"]);
    $id_user = intval($_POST["id_user"]);

    
    $sql_cek = "SELECT COUNT(*) AS jumlah_terisi FROM pesan WHERE id_jadwal = ? AND no_kursi = ?";
    $stmt_cek = $db->prepare($sql_cek);
    $stmt_cek->bind_param("ii", $id_jadwal, $no_kursi);
    $stmt_cek->execute();
    $result_cek = $stmt_cek->get_result();
    $data_cek = $result_cek->fetch_assoc();

    if ($data_cek['jumlah_terisi'] > 0) {
      
        $db->rollback();
        echo "<script>alert('Kursi telah terisi, silakan pilih kursi lain!'); window.location='formpesan.php?idp=$idj';</script>";
        exit;
    }

    
    $sql_insert = "INSERT INTO pesan (no_kursi, status, id_jadwal, id_user) VALUES (?, ?, ?, ?)";
    $stmt_insert = $db->prepare($sql_insert);
    $stmt_insert->bind_param("ssii", $no_kursi, $status, $id_jadwal, $id_user);

    if ($stmt_insert->execute()) {
        
        $db->commit();
        echo "<script>location.href = 'konfirmasipesan.php?i=$idj';</script>";
    } else {
        throw new Exception("Gagal menyimpan data: " . $stmt_insert->error);
    }
} catch (Exception $e) {
   
    $db->rollback();
    echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "'); window.location='formpesan.php?idp=$idj';</script>";
}
?>