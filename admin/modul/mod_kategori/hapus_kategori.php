<?php

$id = $_GET['id'];
mysqli_query($db, "DELETE FROM kategori WHERE id_kategori='$id'");

echo "<script>alert('Data Berhasil Dihapus'); window.location = 'dashboard.php?hal=kategori' </script>";
?>