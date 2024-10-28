<?php

include "koneksi.php";
$_SESSION['id_user'] = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    $user_id = $_SESSION['id_user'];

    // Ambil data tiket dan jumlah tiket dari POST
    $ticket_id = isset($_POST['ticket_id']) ? $_POST['ticket_id'] : null;
    $jumlah = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 0;

    
    if ($jumlah <= 0) {
        die("Jumlah tiket tidak valid.");
    }

    // Ambil harga tiket dari database
    $query = "SELECT ticket_price FROM tickets WHERE ticket_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ticket = $result->fetch_assoc();
    
    // Periksa apakah tiket ditemukan
    if (!$ticket) {
        die("Tiket tidak ditemukan.");
    }

    $ticket_price = $ticket['ticket_price'];
    

    // Hitung total harga
    $total_amount = $ticket_price * $jumlah;

    // Simpan transaksi ke database
    $query = "INSERT INTO transaksi (id_user, ticket_id, tgl_transaksi, status_pembayaran, total_amount)
              VALUES (?, ?, NOW(), 'pending', ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("iii", $user_id, $ticket_id, $total_amount);

    // Jalankan query dan periksa keberhasilannya
    if ($stmt->execute()) {
        echo "Transaksi berhasil dibuat. Silakan lanjutkan ke pembayaran.";
    } else {
        echo "Gagal membuat transaksi: " . $stmt->error;
    }

}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Tiketing.com</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
       

   
        <footer>
    
        </footer>
   
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

