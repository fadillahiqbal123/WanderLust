<?php
header('Content-Type: application/json');
include "../koneksi.php";

$headers = getallheaders();
$token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;

if (!$token) {
    http_response_code(401);
    echo json_encode([
        "status" => "error",
        "message" => "Token tidak ditemukan"
    ]);
    exit();
}

function validateToken($token, $db)
{
    $query = "SELECT id_user FROM user WHERE token = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

$userData = validateToken($token, $db);
if (!$userData) {
    http_response_code(401);
    echo json_encode([
        "status" => "error",
        "message" => "Token tidak valid"
    ]);
    exit();
}

$id_user = $userData['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT username, nama_user, email, password FROM user WHERE id_user = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    echo json_encode([
        "status" => "success",
        "data" => $userData
    ]);
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateFields = [];
    $types = "";
    $params = [];

    // Cek apakah username dikirim
    if (isset($_POST['username']) && !empty(trim($_POST['username']))) {
        $username = trim($_POST['username']);

        // Cek username yang sudah ada
        $checkUsername = $db->prepare("SELECT id_user FROM user WHERE username = ? AND id_user != ?");
        $checkUsername->bind_param("si", $username, $id_user);
        $checkUsername->execute();
        $result = $checkUsername->get_result();

        if ($result->num_rows > 0) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Username sudah digunakan'
            ]);
            exit();
        }

        $updateFields[] = "username = ?";
        $types .= "s";
        $params[] = $username;
    }

    // Cek apakah nama_user dikirim
    if (isset($_POST['nama_user']) && !empty(trim($_POST['nama_user']))) {
        $nama_user = trim($_POST['nama_user']);
        $updateFields[] = "nama_user = ?";
        $types .= "s";
        $params[] = $nama_user;
    }

    // Jika tidak ada field yang diupdate
    if (empty($updateFields)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Tidak ada data yang diubah'
        ]);
        exit();
    }

    // Tambahkan id_user ke parameter
    $types .= "i";
    $params[] = $id_user;

    // Buat query update
    $updateQuery = "UPDATE user SET " . implode(", ", $updateFields) . " WHERE id_user = ?";
    $stmt = $db->prepare($updateQuery);

    // Konversi array params ke references untuk bind_param
    $bindParams = array($types);
    foreach ($params as $key => $value) {
        $bindParams[] = &$params[$key];
    }
    call_user_func_array(array($stmt, 'bind_param'), $bindParams);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui'
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal memperbarui database'
        ]);
    }
}
