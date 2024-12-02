<?php
include "../koneksi.php";

class StatusBayarAPI
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function run()
    {
        // Validasi token
        $headers = apache_request_headers();
        $token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;

        if (!$token) {
            $this->response(401, "Token tidak ditemukan");
            return;
        }

        // Query untuk mendapatkan username dari token
        $query_user = "SELECT username FROM user WHERE token = ?";
        $stmt_user = $this->db->prepare($query_user);
        $stmt_user->bind_param("s", $token);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        if ($result_user->num_rows === 0) {
            $this->response(401, "Token tidak valid");
            return;
        }

        $user_data = $result_user->fetch_assoc();
        $username = $user_data['username'];

        // Query utama untuk mendapatkan data pesanan, urutkan berdasarkan id_pesan terbesar
        $query = "SELECT pesan.id_pesan, user.id_user, asal.alamat, destinasi.nama_destinasi, 
                  jadwal.tgl_berangkat, jadwal.jam_berangkat, jadwal.harga, pesan.status 
                  FROM user 
                  INNER JOIN pesan ON user.id_user = pesan.id_user
                  INNER JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
                  INNER JOIN asal ON jadwal.id_asal = asal.id_asal
                  INNER JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
                  WHERE user.username = ?
                  ORDER BY pesan.id_pesan DESC"; // Mengurutkan berdasarkan id_pesan terbesar (baru)

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            $this->response(500, "Kesalahan server: " . $this->db->error);
            return;
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $pesanan = array();
            while ($row = $result->fetch_assoc()) {
                $pesanan[] = array(
                    'id_pesan' => $row['id_pesan'],
                    'id_user' => $row['id_user'],
                    'rute' => $row['alamat'] . ' - ' . $row['nama_destinasi'],
                    'waktu_berangkat' => $row['tgl_berangkat'] . ' | ' . $row['jam_berangkat'],
                    'harga' => $row['harga'],
                    'status' => $row['status'],
                    'can_cancel' => $row['status'] == "Belum Bayar", // Dapat membatalkan jika status "Belum Bayar"
                    'can_print' => strtolower($row['status']) == "lunas" // Bisa dicetak jika status "lunas"
                );
            }
            $this->response(200, "Data ditemukan", $pesanan);
        } else {
            $this->response(404, "Data tidak ditemukan");
        }
    }

    private function response($statusCode, $message, $data = null)
    {
        http_response_code($statusCode);
        $response = array(
            "status" => $statusCode == 200 ? "sukses" : "gagal",
            "message" => $message
        );

        if ($data !== null) {
            $response["data"] = $data;
        }

        echo json_encode($response);
    }
}

// Inisialisasi API
$api = new StatusBayarAPI($db);
$api->run();
