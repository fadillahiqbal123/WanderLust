<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo json_encode(array("status" => "input_tidak_valid", "message" => "Semua kolom harus diisi."));
        exit();
    }

    $stmt = $db->prepare("SELECT password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $hash_password = $row['password'];

        if (password_verify($password, $hash_password)) {

            echo json_encode(array("status" => "berhasil", "message" => "Login berhasil."));
        } else {
            echo json_encode(array("status" => "gagal", "message" => "Username atau password salah."));
        }
    } else {
        echo json_encode(array("status" => "gagal", "message" => "Username atau password salah."));
    }

    $stmt->close();
}

$db->close();
