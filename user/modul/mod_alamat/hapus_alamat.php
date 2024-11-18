<?php

$id = $_GET['id'];

mysqli_query($db, "DELETE FROM asal WHERE id_asal='$id'");

echo "<script>alert('Data Berhasil Dihapus'); window.location = 'dashboard.php?hal=alamat' </script>";
?>