<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaction_id = $_POST['id_transaksi'];
    $payment_method = $_POST['payment_method'];

    // Update status pembayaran
    $query = "UPDATE transaksi SET status_pembayaran = 'completed' WHERE id_transaksi = $transaction_id";
    if (mysqli_query($db, $query)) {
        echo "Pembayaran berhasil dikonfirmasi!";
    } else {
        echo "Gagal mengonfirmasi pembayaran: " . mysqli_error($db);
    }
}
?>
