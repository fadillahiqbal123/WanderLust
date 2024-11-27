<?php 
$id = $_GET['id'];

mysqli_query($db, "DELETE FROM pesan WHERE id_pesan = '$id'");

echo "<script>alert('Data Pesanan Lunas Berhasil Dihapus'); window.location = 'dashboard.php?hal=pesanan-lunas'</script>";

?>