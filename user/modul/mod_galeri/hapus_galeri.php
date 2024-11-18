<?php 
$id = $_GET['id'];

$sql = mysqli_query($db, "SELECT * FROM galeri WHERE id_galeri='$id'");

$r = mysqli_fetch_array($sql);

unlink("././img_galeri/".$r['nama_foto']);

mysqli_query($db, "DELETE FROM galeri WHERE id_galeri='$id'");

echo "<script>alert('Data galeri Berhasil dihapus'); window.location = 'dashboard.php?hal=galeri'</script>";

?>