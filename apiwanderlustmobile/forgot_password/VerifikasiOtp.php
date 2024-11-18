<?php
include "../koneksi.php";

class VerifyOTP
{
    private $db;
    private $email;
    private $verifikasi_code;

    public function __construct($db)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->email = $data['email'] ?? null;
        $this->verifikasi_code = $data['verifikasi_code'] ?? null;
        $this->db = $db;
    }

    public function processRequest()
    {
        if (is_null($this->email) || is_null($this->verifikasi_code)) {
            return $this->response('input_tidak_valid', 'Semua kolom harus diisi.');
        }

        $stmt = $this->db->prepare("SELECT verifikasi_code, is_verif FROM user WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return $this->response('gagal', 'Akun tidak ditemukan.');
        }

        $user = $result->fetch_assoc();

        if ($user['is_verif'] == 1) {
            return $this->response('sudah_terverifikasi', 'Akun sudah terverifikasi.');
        }

        if ($user['verifikasi_code'] != $this->verifikasi_code) {
            return $this->response('gagal', 'Kode verifikasi tidak cocok.');
        }

        $stmt_update = $this->db->prepare("UPDATE user SET is_verif = 1 WHERE email = ?");
        $stmt_update->bind_param("s", $this->email);

        if ($stmt_update->execute()) {
            return $this->response('success', 'Verifikasi berhasil.');
        } else {
            return $this->response('error', 'Gagal memperbarui status verifikasi.');
        }
    }

    private function response($status, $message)
    {
        return json_encode(['status' => $status, 'message' => $message]);
    }
}

$verifyOTP = new VerifyOTP($db);
echo $verifyOTP->processRequest();

$db->close();
