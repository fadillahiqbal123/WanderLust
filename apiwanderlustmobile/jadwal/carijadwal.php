<?php

require_once '../koneksi.php';

class JadwalAPI
{
    private $db;
    private $keberangkatan;
    private $tujuan;
    private $caritgl;

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
        if (!$this->validateInput()) {
            $this->response(400, "Parameter yang dibutuhkan tidak lengkap");
            return;
        }

        $jadwal = $this->cariJadwal();

        if ($jadwal) {
            $this->response(200, "Jadwal ditemukan", $jadwal);
        } else {
            $this->response(404, "Tidak ada jadwal yang ditemukan");
        }
    }
    private function validateToken()
    {
        $headers = apache_request_headers();
        $token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;

        return $token ? true : false;
    }

    private function validateInput()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['keberangkatan']) || !isset($data['tujuan']) || !isset($data['caritgl'])) {
            return false;
        }

        $this->keberangkatan = "%" . $data['keberangkatan'] . "%";
        $this->tujuan = "%" . $data['tujuan'] . "%";
        $this->caritgl = $data['caritgl'];

        return true;
    }
    private function cariJadwal()
    {
        $query = "
            SELECT 
                jadwal.id_jadwal,
                asal.alamat AS keberangkatan,
                destinasi.nama_destinasi AS tujuan,
                jadwal.tgl_berangkat,
                jadwal.jam_berangkat AS jam,
                jadwal.harga,
                (5 - COUNT(pesan.no_kursi)) AS jumlah_kursi_tersedia
            FROM 
                jadwal
            JOIN asal ON jadwal.id_asal = asal.id_asal
            JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
            LEFT JOIN pesan ON jadwal.id_jadwal = pesan.id_jadwal
            WHERE 
                asal.alamat LIKE ? 
                AND destinasi.nama_destinasi LIKE ? 
                AND jadwal.tgl_berangkat = ?
            GROUP BY 
                jadwal.id_jadwal
        ";

        $stmt = $this->db->prepare($query);

        if (!$stmt) {
            $this->response(500, "Gagal mempersiapkan query: " . $this->db->error);
            return null;
        }

        $stmt->bind_param("sss", $this->keberangkatan, $this->tujuan, $this->caritgl);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $jadwal_data = array();

            while ($row = $result->fetch_assoc()) {
                $jadwal_data[] = array(
                    "id_jadwal" => $row['id_jadwal'],
                    "keberangkatan" => $row['keberangkatan'],
                    "tujuan" => $row['tujuan'],
                    "tanggal" => $row['tgl_berangkat'],
                    "jam" => $row['jam'],
                    "harga" => $row['harga'],
                    "jumlah_kursi_tersedia" => $row['jumlah_kursi_tersedia']
                );
            }

            $stmt->close();
            return $jadwal_data;
        }

        $stmt->close();
        return null;
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
$api = new JadwalAPI($db);
$api->run();
