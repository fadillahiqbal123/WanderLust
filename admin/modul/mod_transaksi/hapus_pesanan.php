<?php 
$id = $_GET['id'];


$stmt = $db->prepare("DELETE FROM transaksi WHERE no_resi = ?");


$stmt->bind_param("i", $id); 


if ($stmt->execute()) {
    echo "<script>alert('Data Pesanan Berhasil Dihapus'); window.location = 'dashboard.php?hal=konfirmasi-pesan'</script>";
} else {
    echo "<script>alert('Gagal menghapus data.'); window.location = 'dashboard.php?hal=konfirmasi-pesan'</script>";
}


$stmt->close();
?>
