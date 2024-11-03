<?php 
session_start();
include "koneksi.php";

// Cek apakah data telah diterima dari hasil_cari.php atau jadwal.php
if (!isset($_GET['id_jadwal'])) {
    die("ID Jadwal tidak ditemukan.");
}

// Mengambil data berdasarkan ID Jadwal yang diterima
$id_jadwal = $_GET['id_jadwal'];
$query = "SELECT * FROM jadwal WHERE id_jadwal = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_jadwal);
$stmt->execute();
$result = $stmt->get_result();
$jadwal = $result->fetch_assoc();

if (!$jadwal) {
    die("Data jadwal tidak ditemukan.");
}
?>

<!doctype html>
<html lang="id">
<head>
    <title>WanderLust - Form Pesan</title>
    <link rel="icon" href="image/logo_wanderlust1.png" type="image/png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <header>
        <?php include "layout/navbar.php"; ?>
    </header>
    <main class="container my-5">
        <h2>Form Pesan</h2>
        <form class="form-control" method="POST" action="">
            <div class="mb-3">
                <label for="nama_user" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_user" name="nama_user" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="no_kursi" class="form-label">Pilih Kursi</label>
                <select class="form-select" id="no_kursi" name="no_kursi" required>
                    <option value="">Pilih Kursi</option>
                    <!-- Menampilkan pilihan kursi yang tersedia -->
                    <?php
                    // Menampilkan kursi yang tersedia
                    $kursiQuery = "SELECT * FROM pesan WHERE id_jadwal = ? AND status = 'tersedia'";
                    $kursiStmt = $koneksi->prepare($kursiQuery);
                    $kursiStmt->bind_param("i", $id_jadwal);
                    $kursiStmt->execute();
                    $kursiResult = $kursiStmt->get_result();

                    while ($kursi = $kursiResult->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($kursi['id_pesan']) . "'>" . htmlspecialchars($kursi['nor_kursi']) . "</option>";
                    }
                    ?>
                </select>
            </div>
           
            <input type="hidden" name="id_jadwal" value="<?php echo htmlspecialchars($id_jadwal); ?>">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari formulir
            $name = htmlspecialchars($_POST['nama_user']);
            $email = htmlspecialchars($_POST['email']);
            $no_kursi = htmlspecialchars($_POST['no_kursi']);
            $id_jadwal = htmlspecialchars($_POST['id_jadwal']);

            // Proses pengiriman pesan ke database
            $insertQuery = "INSERT INTO pesan (id_jadwal, nama_user, email, no_kursi, message) VALUES (?, ?, ?, ?, ?)";
            $insertStmt = $koneksi->prepare($insertQuery);
            $insertStmt->bind_param("isss", $id_jadwal, $name, $email, $no_kursi);
            
            if ($insertStmt->execute()) {
                echo "<div class='alert alert-success mt-3'>Pesan Anda telah terkirim!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Gagal mengirim pesan. Silakan coba lagi.</div>";
            }
        }
        ?>
    </main>

    <footer>
        <?php include "layout/footer.php"; ?>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
