<?php 

include "koneksi.php"; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "PHPMailer/PHPMailer/src/Exception.php";
require_once "PHPMailer/PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/PHPMailer/src/SMTP.php";

class ForgotPassword {

    
    private function response($status, $message, $error_detail = null) {
        $response = ['status' => $status, 'message' => $message];
        if ($error_detail) {
            $response['error_detail'] = $error_detail;
        }
        return json_encode($response);
    }

    // Proses permintaan reset password
    public function processRequest($db, $email) {
        if (empty($email)) {
            return $this->response('error', 'Email tidak boleh kosong.');
        }

        // Cek apakah email ada dalam database
        $select = mysqli_query($db, "SELECT email, password FROM user WHERE email='{$email}'");
        if ($select && mysqli_num_rows($select) > 0) {
            $row = mysqli_fetch_assoc($select);
            $pass = md5($row['password']);
            
            // URL reset password ke localhost
            $reset_url = "http://localhost:80/destinasi-wisata/user/reset_pass.php?reset=$pass&key={$email}";

            
            $mail = new PHPMailer(true);
            $body = "Klik link berikut untuk reset password Anda: <a href='$reset_url'>Reset Password</a>";

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'wanderlustjember@gmail.com';
                $mail->Password = 'vkpp xgcf nhum edhq'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('wanderlustjember@gmail.com', 'Wanderlust');
                $mail->addAddress($email, 'User Sistem');

                $mail->isHTML(true);
                $mail->Subject = 'Permintaan Reset Password';
                $mail->msgHTML($body);
                $mail->AltBody = "Klik link berikut untuk reset password Anda: $reset_url";

                // Kirim email
                if ($mail->send()) {
                    return $this->response('success', 'Link reset password telah dikirim ke email Anda.');
                } else {
                    return $this->response('error', 'Gagal mengirim email reset password.', $mail->ErrorInfo);
                }
            } catch (Exception $e) {
                return $this->response('error', 'Terjadi kesalahan saat mengirim email.', $e->getMessage());
            }
        } else {
            return $this->response('error', 'Email tidak ditemukan.');
        }
    }
}

// Inisialisasi dan proses permintaan
$email = $_POST['email'] ?? '';
$forgotPassword = new ForgotPassword();
echo $forgotPassword->processRequest($db, $email);

$db->close();
?>
