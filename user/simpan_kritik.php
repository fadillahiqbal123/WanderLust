<?php 
session_start();
include "koneksi.php"; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi reCAPTCHA
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = '6LfGAXgqAAAAAGMioZecTIZWOeljKP4CiD3rVrV7';
    
    // Verifikasi reCAPTCHA
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {
    
        $judul_saran = $db->real_escape_string($_POST['judul_saran']);
        $detail_saran = $db->real_escape_string($_POST['detail_saran']);

        
        $username = $_SESSION['username'];

    
        $sql_user = "SELECT id_user FROM user WHERE username = ?";
        $stmt_user = $db->prepare($sql_user);
        $stmt_user->bind_param("s", $username);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        if ($result_user->num_rows > 0) {
            $row_user = $result_user->fetch_assoc();
            $id_user = $row_user['id_user'];

            // Simpan kritik dan saran ke dalam database
            $sql = "INSERT INTO saran (id_user, judul_saran, detail_saran) VALUES (?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("iss", $id_user, $judul_saran, $detail_saran);

            if ($stmt->execute()) {
                echo "<script>
                alert('Kritik dan saran berhasil dikirim.');
                window.location.href = 'dashboard.php';
                </script>";
                exit();
            } else {
                echo "Terjadi kesalahan: " . $stmt->error;
            }
        } else {
            echo "Pengguna tidak ditemukan.";
        }
    } else {
        echo "<script>alert('Validasi reCAPTCHA gagal. Apakah Anda robot ?'); window.location = 'dashboard.php'</script>";
    }
} else {
    echo "Metode pengiriman tidak valid.";
}


$db->close();
?>
