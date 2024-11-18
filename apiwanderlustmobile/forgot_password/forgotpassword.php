<?php
include "../koneksi.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../asset/PHPMailer/src/Exception.php";
require "../asset/PHPMailer/src/PHPMailer.php";
require "../asset/PHPMailer/src/SMTP.php";

class ForgotPassword
{
    private $db;
    private $email;

    public function __construct($db, $email)
    {
        $this->db = $db;
        $this->email = trim($email);
    }

    public function processRequest()
    {
        if (empty($this->email)) {
            return $this->response('input tidak valid', 'Semua kolom harus diisi.');
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return $this->response('input tidak valid', 'Format email tidak valid.');
        }

        $stmt = $this->db->prepare("SELECT username FROM user WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return $this->response('gagal', 'Akun tidak tersedia.');
        }

        $user = $result->fetch_assoc();
        $username = $user['username'];
        $verification_code = rand(100000, 999999);

        $stmt = $this->db->prepare("UPDATE user SET verifikasi_code = ?, is_verif = 0 WHERE email = ?");
        $stmt->bind_param("ss", $verification_code, $this->email);

        if ($stmt->execute()) {
            return $this->sendVerificationEmail($username, $verification_code);
        } else {
            return $this->response('error', 'Gagal memperbarui kode verifikasi.');
        }
    }

    private function sendVerificationEmail($username, $verification_code)
    {
        $mail = new PHPMailer(true);
        try {
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
                    'allow_self_signed' => true,
                ],
            ];

            $mail->setFrom('wanderlustjember@gmail.com', 'Wanderlust');
            $mail->addAddress($this->email);

            $mail->isHTML(true);
            $mail->Subject = 'Permintaan Forgot Password';
            $mail->Body = $this->generateEmailBody($username, $verification_code);
            $mail->AltBody = "Halo $username, kode verifikasi baru Anda adalah $verification_code. Gunakan kode ini untuk permintaan reset kode Anda.";

            if ($mail->send()) {
                return $this->response('success', 'Kode verifikasi telah dikirim ke email Anda.');
            } else {
                return $this->response('error', 'Gagal mengirim email verifikasi.', $mail->ErrorInfo);
            }
        } catch (Exception $e) {
            return $this->response('error', 'Terjadi kesalahan saat mengirim email.', $mail->ErrorInfo);
        }
    }

    private function generateEmailBody($username, $verification_code)
    {
        return "
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
                    width: 120px;
                    height: auto;
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
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>
                    <img src='https://i.ibb.co/VVx8CNp/logo-wanderlust.png' alt='Wanderlust Logo'>
                    <h1>Permintaan Mengatur Ulang Kata Sandi</h1>
                </div>
                <div class='email-content'>
                    <h2>Halo! $username</h2>
                    <p>Kami menerima permintaan untuk mengatur ulang kata sandi Anda. Berikut adalah kode verifikasi Anda:</p>
                    <p class='otp'>$verification_code</p>
                    <p>Gunakan kode ini untuk memverifikasi permintaan Anda.</p>
                    <br>
                    <p>Salam,<br>Tim Wanderlust</p>
                </div>
                <div class='email-footer'>
                    &copy; " . date("Y") . " Wanderlust. All rights reserved.<br>
                    " . date('l, j F Y') . "
                </div>
            </div>
        </body>
        </html>";
    }

    private function response($status, $message, $error_detail = null)
    {
        $response = ['status' => $status, 'message' => $message];
        if ($error_detail) {
            $response['error_detail'] = $error_detail;
        }
        return json_encode($response);
    }
}
$email = $_POST['email'] ?? '';
$forgotPassword = new ForgotPassword($db, $email);
echo $forgotPassword->processRequest();

$db->close();
