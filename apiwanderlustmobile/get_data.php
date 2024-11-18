<?php
include "koneksi.php";

$id_user = $_POST['id_user'];

$sql = "SELECT id_user, nama_user, email, username, password FROM user WHERE id_user = '" . $id_user . "'";

$query = mysqli_query($db, $sql);

if ($query) {
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Data tidak ditemukan'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Query gagal dijalankan'));
}
