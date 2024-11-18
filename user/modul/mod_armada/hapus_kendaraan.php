<?php  
$id = $_GET['id'];

mysqli_query($db, "DELETE FROM kendaraan WHERE id_mobil='$id'");

echo "<script>alert('Data Kendaraan Berhasil Dihapus'); window.location = 'dashboard.php?hal=kendaraan'</script>";

?>