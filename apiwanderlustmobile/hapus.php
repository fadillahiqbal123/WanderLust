<?php
include "koneksi.php";

if (!isset($_POST['id_user'])) {
    echo json_encode(array('status' => 'error', 'message' => 'id_user tidak disediakan'));
    exit;
}

$id_user = $_POST['id_user'];

$sql = "DELETE FROM `user` WHERE `id_user` = ?";

$stmt = mysqli_prepare($db, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $id_user);
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        echo json_encode(array(
            'status' => 'data_berhasil_di_hapus!'
        ));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'data gagal dihapus'));
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Gagal mempersiapkan statement'));
}

mysqli_close($db);
