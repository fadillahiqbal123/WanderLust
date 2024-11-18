<?php
include "../koneksi.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo json_encode(array("status" => "input_tidak_valid", "message" => "Semua kolom harus diisi."));
        exit();
    }

    $stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash_password = $row['password'];

        if ($hash_password === md5($password)) {
            if ($row['is_verif'] == 1) {

                $token = rand(100000, 999999);

                $updateStmt = $db->prepare("UPDATE user SET token = ? WHERE id_user = ?");
                $updateStmt->bind_param('si', $token, $row['id_user']);
                $updateStmt->execute();

                echo json_encode(array(
                    "status" => "berhasil",
                    "message" => "Login berhasil.",
                    "token" => $token,
                    "id_user" => $row['id_user'],
                    "nama_user" => $row['nama_user'],
                    "email" => $row['email'],
                    "username" => $row['username'],
                    "password" => $row['password']
                ));
            } else {
                echo json_encode(array(
                    "status" => "akun_belum_terverifikasi",
                    "message" => "Akun Anda belum terverifikasi. Silakan periksa email Anda."
                ));
            }
        } else {
            echo json_encode(array(
                "status" => "gagal",
                "message" => "Email atau password salah."
            ));
        }
    } else {
        echo json_encode(array(
            "status" => "gagal",
            "message" => "Email tidak ditemukan."
        ));
    }

    $stmt->close();
}

$db->close();
