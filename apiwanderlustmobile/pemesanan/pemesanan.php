<?php
include "../koneksi.php";

class FormPemesananAPI
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    private function handlePostRequest()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input["action"]) && $input["action"] === "getEmailByIdUser") {
            if (empty($input["id_user"])) {
                $this->response(400, "ID User harus diisi");
                return;
            }

            $this->getEmailByIdUser($input["id_user"]);
            return;
        }

        if (isset($input["id_jadwal"]) && count($input) === 1) {
            $this->getDetailPemesanan($input["id_jadwal"]);
            return;
        }

        if (empty($input["no_kursi"]) || empty($input["status"]) || empty($input["id_jadwal"]) || empty($input["id_user"])) {
            $this->response(400, "Semua field harus diisi");
            return;
        }

        $this->addPemesanan($input);
    }

    private function getDetailPemesanan($id_jadwal)
    {
        $query = "
            SELECT 
                jadwal.*, 
                kendaraan.jenis_mobil AS kendaraan,
                asal.alamat AS keberangkatan,
                destinasi.nama_destinasi AS tujuan
            FROM 
                jadwal
            JOIN kendaraan ON kendaraan.id_mobil = jadwal.id_mobil
            JOIN asal ON jadwal.id_asal = asal.id_asal
            JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
            WHERE 
                jadwal.id_jadwal = ?
        ";

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            $this->response(500, "Kesalahan server: " . $this->db->error);
            return;
        }

        $stmt->bind_param("i", $id_jadwal);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            // Tambahkan status kursi ke data
            $data['kursi_status'] = $this->checkKursiStatus($id_jadwal);
            $this->response(200, "Detail pemesanan ditemukan", $data);
        } else {
            $this->response(404, "Jadwal tidak ditemukan");
        }
    }


    private function addPemesanan($input)
    {
        $this->db->begin_transaction();

        try {
            $checkQuery = "SELECT COUNT(*) as count FROM pesan WHERE id_jadwal = ? AND no_kursi = ?";
            $stmtCheck = $this->db->prepare($checkQuery);
            $stmtCheck->bind_param("ii", $input["id_jadwal"], $input["no_kursi"]);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();
            $rowCheck = $resultCheck->fetch_assoc();

            if ($rowCheck['count'] > 0) {
                $this->db->rollback();
                $this->response(409, "Kursi sudah dipesan");
                return;
            }

            $sqlInsert = "INSERT INTO pesan (no_kursi, status, id_jadwal, id_user) VALUES (?, ?, ?, ?)";
            $stmtInsert = $this->db->prepare($sqlInsert);
            $stmtInsert->bind_param("ssii", $input["no_kursi"], $input["status"], $input["id_jadwal"], $input["id_user"]);

            if (!$stmtInsert->execute()) {
                $this->db->rollback();
                $this->response(500, "Gagal menyimpan data: " . $stmtInsert->error);
                return;
            }

            $this->db->commit();
            $this->response(201, "Pemesanan berhasil dilakukan");
        } catch (Exception $e) {
            $this->db->rollback();
            $this->response(500, "Kesalahan server: " . $e->getMessage());
        }
    }

    private function responseadpemesanan($status_code, $data)
    {
        http_response_code($status_code);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    private function getEmailByIdUser($id_user)
    {

        $query = "SELECT email FROM user WHERE id_user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $this->response(200, "Email ditemukan", $data);
        } else {
            $this->response(404, "User tidak ditemukan");
        }
    }

    private function checkKursiStatus($id_jadwal)
    {
        $status_kursi = array();

        for ($i = 1; $i <= 5; $i++) {
            $sql = "SELECT COUNT(no_kursi) as count FROM pesan WHERE id_jadwal = ? AND no_kursi = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ii", $id_jadwal, $i);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();


            $status_kursi[$i] = ($row['count'] > 0) ? "Terisi" : "Kosong";
        }

        return (object)$status_kursi;
    }
    private function response($statusCode, $message, $data = null)
    {
        http_response_code($statusCode);
        $response = array(
            "status" => $statusCode == 200 || $statusCode == 201 ? "sukses" : "gagal",
            "message" => $message
        );

        if ($data !== null) {
            $response["data"] = $data;
        }

        echo json_encode($response);
    }
}

$api = new FormPemesananAPI($db);
$api->run();
