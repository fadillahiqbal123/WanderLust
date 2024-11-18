<?php
include "../koneksi.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../asset/PHPMailer/src/Exception.php";
require "../asset/PHPMailer/src/PHPMailer.php";
require "../asset/PHPMailer/src/SMTP.php";

$nama_user = trim($_POST['nama_user'] ?? '');
$email = trim($_POST['email'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$nama_user || !$email || !$username || !$password) {
    echo json_encode(['status' => 'input_tidak_valid', 'message' => 'Semua kolom harus diisi.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'input_tidak_valid', 'message' => 'Format email tidak valid.']);
    exit;
}

$stmt = $db->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(['status' => 'gagal', 'error' => 'Username sudah digunakan.']);
    exit;
}

$stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(['status' => 'gagal', 'error' => 'Email sudah digunakan.']);
    exit;
}

$verifikasi_code = rand(100000, 999999);
$is_verif = '0';
$hash_password = md5($password);

$stmt = $db->prepare("INSERT INTO user (nama_user, email, username, password, verifikasi_code, is_verif) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nama_user, $email, $username, $hash_password, $verifikasi_code, $is_verif);

if ($stmt->execute()) {
    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'wanderlustjember@gmail.com';
        $mail->Password = 'vkpp xgcf nhum edhq';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        $mail->setFrom('wanderlustjember@gmail.com', 'Wanderlust');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Registrasi Akun Wanderlust';
        $mail->Body = "
     <html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #4a90e2; 
            text-align: center;
            padding: 20px;
            color: #ffffff;
        }
        .email-header img {
            width: 120px; /* Ukuran logo yang lebih kecil */
            height: auto; /* Menjaga proporsi tinggi */
        }
        .email-content {
            padding: 20px;
            color: #333333;
        }
        .email-content h2 {
            color: #4a90e2;
            font-size: 22px;
            margin-top: 0;
        }
        .otp {
            font-size: 20px;
            font-weight: bold;
            color: #4a90e2;
        }
        .email-footer {
            background-color: #4a90e2;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        /* Responsiveness */
        @media only screen and (max-width: 600px) {
            .email-content {
                padding: 15px;
            }
            .email-content h2 {
                font-size: 20px;
            }
            .otp {
                font-size: 18px;
            }
            .email-footer {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class='email-container'>
        <div class='email-header'>
            <img src='https://i.ibb.co/VVx8CNp/logo-wanderlust.png' alt='Wanderlust Logo'>
            <h1>Selamat Datang di Wanderlust Mobile!</h1>
        </div>
        <div class='email-content'>
            <h2>Halo, $nama_user!</h2>
            <p>Akun Wanderlust Mobile Anda telah berhasil dibuat. Nikmati perjalanan dengan Wanderlust!</p>
            <p>Kode OTP Anda adalah: <span class='otp'>$verifikasi_code</span></p>
            <p>Silakan gunakan kode ini untuk verifikasi akun Anda.</p>
            <p>Akun ini dapat digunakan pada platform Mobile dan Web Wanderlust.</p>
            <br>
            <p>Salam,<br>Tim Wanderlust</p>
        </div>
        <div class='email-footer'>
            &copy; " . date("Y") . " Wanderlust. All rights reserved.<br>
            " . date('l, j F Y') . "
        </div>
    </div>
</body>
</html> ";

        $mail->AltBody = "Selamat datang $nama_user di Wanderlust! Akun Wanderlust Mobile Anda berhasil dibuat. Kode OTP: $verifikasi_code. Gunakan kode ini untuk verifikasi akun Anda.";

        if ($mail->send()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Registrasi berhasil dan email verifikasi telah dikirim'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Registrasi berhasil tetapi gagal mengirim email verifikasi'
            ]);
        }
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        echo json_encode([
            'status' => 'error',
            'message' => 'Registrasi berhasil tetapi gagal mengirim email verifikasi',
            'error_detail' => $mail->ErrorInfo
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal melakukan registrasi'
    ]);
}

$stmt->close();
$db->close();
