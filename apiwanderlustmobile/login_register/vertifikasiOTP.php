<?php
include "../koneksi.php";

$email = trim($_POST['email'] ?? '');
$otp = trim($_POST['otp'] ?? '');

if (!$email || !$otp) {
    echo json_encode(['status' => 'input_tidak_valid', 'message' => 'Email dan OTP harus diisi.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'input_tidak_valid', 'message' => 'Format email tidak valid.']);
    exit;
}

$stmt = $db->prepare("SELECT is_verif FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($user['is_verif'] == '1') {
        echo json_encode([
            'status' => 'gagal',
            'message' => 'Akun sudah terverifikasi. Silakan login langsung.'
        ]);
        exit;
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Email tidak ditemukan.'
    ]);
    exit;
}

$stmt = $db->prepare("SELECT * FROM user WHERE email = ? AND verifikasi_code = ? AND is_verif = 0");
$stmt->bind_param("ss", $email, $otp);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $stmt = $db->prepare("UPDATE user SET is_verif = 1 WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Verifikasi berhasil. Anda sekarang bisa login.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal memperbarui status verifikasi.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'OTP tidak valid atau akun sudah terverifikasi.'
    ]);
}

$stmt->close();
$db->close();
