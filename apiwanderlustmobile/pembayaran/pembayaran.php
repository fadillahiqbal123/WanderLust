<?php
include "../koneksi.php";

class CekStatusPembayaranAPI
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function run()
    {
        if (!$this->validateToken()) {
            $this->response(401, "Token tidak ditemukan");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->handleGetRequest();
        } else {
            $this->response(405, "Metode tidak diizinkan");
        }
    }

    private function validateToken()
    {
        $headers = apache_request_headers();
        $token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;

        return $token ? true : false;
    }

    private function handleGetRequest()
    {
        if (!isset($_GET['id_pesan'])) {
            $this->response(400, "ID Pesan tidak ditemukan");
            return;
        }

        $id_pesan = intval($_GET['id_pesan']);
        $this->getDetailPembayaran($id_pesan);
    }

    private function getDetailPembayaran($id_pesan)
    {
        $query = "
            SELECT 
                pesan.id_pesan, 
                jadwal.tgl_berangkat, 
                asal.alamat AS Keberangkatan, 
                destinasi.nama_destinasi AS Tujuan, 
                pesan.status, 
                jadwal.harga 
            FROM 
                pesan 
            JOIN 
                jadwal ON pesan.id_jadwal = jadwal.id_jadwal 
            JOIN 
                asal ON jadwal.id_asal = asal.id_asal 
            JOIN 
                destinasi ON jadwal.id_destinasi = destinasi.id_destinasi 
            WHERE 
                pesan.id_pesan = ?
        ";

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            $this->response(500, "Kesalahan server: " . $this->db->error);
            return;
        }

        $stmt->bind_param("i", $id_pesan);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $this->response(200, "Detail pembayaran ditemukan", $data);
        } else {
            $this->response(404, "Pembayaran tidak ditemukan");
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

$api = new CekStatusPembayaranAPI($db);
$api->run();
