<?php 
$id = $_GET['id'];

mysqli_query($db, "DELETE FROM destinasi WHERE id_destinasi='$id'");

echo "<script>alert('Data Destinasi Wisata Berhasil Dihapus'); window.location = 'dashboard.php?hal=destinasi-wisata'</script>";

?>