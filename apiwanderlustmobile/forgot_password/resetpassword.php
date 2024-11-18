<?php
include "../koneksi.php";

class ResetPassword
{
    private $db;
    private $email;
    private $password;

    public function __construct($db, $email, $password)
    {
        $this->db = $db;
        $this->email = trim($email);
        $this->password = trim($password);
    }

    public function processRequest()
    {
        if (empty($this->email) || empty($this->password)) {
            return $this->response('input tidak valid', 'Email dan password baru harus diisi.');
        }

        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = ? AND is_verif = 1");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return $this->response('gagal', 'Akun belum diverifikasi.');
        }

        $user = $result->fetch_assoc();
        $current_password = $user['password'];

        if (md5($this->password) === $current_password) {
            return $this->response('gagal', 'Password baru tidak boleh sama dengan password yang lama.');
        }

        $hashed_password = md5($this->password);

        $stmt_update = $this->db->prepare("UPDATE user SET password = ? WHERE email = ?");
        $stmt_update->bind_param("ss", $hashed_password, $this->email);

        if ($stmt_update->execute()) {
            return $this->response('success', 'Password berhasil diperbarui.');
        } else {
            return $this->response('error', 'Gagal memperbarui password.');
        }
    }

    private function response($status, $message)
    {
        return json_encode(['status' => $status, 'message' => $message]);
    }
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$resetPassword = new ResetPassword($db, $email, $password);
echo $resetPassword->processRequest();

$db->close();
