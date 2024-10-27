<?php  
$id = $_GET['id'];

mysqli_query($db, ("DELETE FROM jadwal WHERE id_jadwal='$id'"));

echo "<script>alert('Data Jadwal Berhasil Dihapus'); window.location = 'dashboard.php?hal=jadwal'</script>";

?>