<?php
include "../koneksi.php";

class PembayaranAPI
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
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
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

    private function handlePostRequest()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        error_log("Received data: " . print_r($data, true));
        $requiredFields = ['no_resi', 'tgl_transfer', 'jam_transfer', 'id_pesan', 'status'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                $this->response(400, "$field tidak ditemukan atau kosong");
                return;
            }
        }
        $no_resi = mysqli_real_escape_string($this->db, $data['no_resi']);
        $no_rek = isset($data['no_rek']) ? mysqli_real_escape_string($this->db, $data['no_rek']) : NULL;
        $tgl_transfer = mysqli_real_escape_string($this->db, $data['tgl_transfer']);
        $jam_transfer = mysqli_real_escape_string($this->db, $data['jam_transfer']);
        $id_pesan = intval($data['id_pesan']);
        $status = mysqli_real_escape_string($this->db, $data['status']);
        error_log("Processing with no_resi: " . $no_resi);
        $check_resi = "SELECT COUNT(*) as count FROM transaksi WHERE no_resi = ?";
        $stmt_check = $this->db->prepare($check_resi);
        if (!$stmt_check) {
            $this->response(500, "Kesalahan server saat memeriksa no_resi: " . $this->db->error);
            return;
        }
        $stmt_check->bind_param("s", $no_resi);
        if (!$stmt_check->execute()) {
            $this->response(500, "Kesalahan saat mengeksekusi pengecekan no_resi: " . $stmt_check->error);
            return;
        }
        $result_check = $stmt_check->get_result();
        $row = $result_check->fetch_assoc();

        if ($row['count'] > 0) {
            $this->response(400, "No resi yang Anda masukkan sudah ada");
            return;
        }
        $check_pesan = "SELECT COUNT(*) as count FROM pesan WHERE id_pesan = ?";
        $stmt_pesan = $this->db->prepare($check_pesan);
        if (!$stmt_pesan) {
            $this->response(500, "Kesalahan server saat memeriksa id_pesan: " . $this->db->error);
            return;
        }

        $stmt_pesan->bind_param("i", $id_pesan);
        if (!$stmt_pesan->execute()) {
            $this->response(500, "Kesalahan saat mengeksekusi pengecekan id_pesan: " . $stmt_pesan->error);
            return;
        }

        $result_pesan = $stmt_pesan->get_result();
        $row_pesan = $result_pesan->fetch_assoc();

        if ($row_pesan['count'] == 0) {
            $this->response(404, "ID Pesan yang Anda masukkan tidak ditemukan di database");
            return;
        }
        $sql = "INSERT INTO transaksi (no_resi, no_rek, tgl_transfer, jam_transfer, id_pesan) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $this->db->prepare($sql);
        if (!$stmt_insert) {
            $this->response(500, "Kesalahan server saat menyiapkan insert: " . $this->db->error);
            return;
        }

        $stmt_insert->bind_param("ssssi", $no_resi, $no_rek, $tgl_transfer, $jam_transfer, $id_pesan);

        if (!$stmt_insert->execute()) {
            $this->response(500, "Terjadi kesalahan pada sistem kami saat melakukan insert: " . $stmt_insert->error);
            return;
        }

        $sql1 = "UPDATE pesan SET status = ? WHERE id_pesan = ?";
        $stmt_update = $this->db->prepare($sql1);
        if (!$stmt_update) {
            $this->response(500, "Kesalahan server saat menyiapkan update: " . $this->db->error);
            return;
        }

        $stmt_update->bind_param("si", $status, $id_pesan);

        if (!$stmt_update->execute()) {
            $this->response(500, "Terjadi kesalahan pada update pesan: " . $stmt_update->error);
            return;
        }

        $this->response(200, "Konfirmasi pembayaran berhasil dilakukan, mohon bersabar. Kami akan memprosesnya.");
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

$api = new PembayaranAPI($db);
$api->run();
