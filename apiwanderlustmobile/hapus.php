<?php
include "koneksi.php";

// Memeriksa apakah id_user ada dalam data POST
if (!isset($_POST['id_user'])) {
    echo json_encode(array('status' => 'error', 'message' => 'id_user tidak disediakan'));
    exit; // Hentikan eksekusi jika tidak ada id_user
}

// Mengambil id_user dari data POST
$id_user = $_POST['id_user'];

// Mempersiapkan query untuk menghapus data
$sql = "DELETE FROM `user` WHERE `id_user` = ?";

// Mempersiapkan statement
$stmt = mysqli_prepare($db, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $id_user); // 'i' untuk integer
    // Menjalankan query
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        echo json_encode(array(
            'status' => 'data_berhasil_di_hapus!'
        ));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'data gagal dihapus'));
    }

    // Menutup statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Gagal mempersiapkan statement'));
}

// Menutup koneksi
mysqli_close($db);
