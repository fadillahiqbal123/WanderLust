<?php 
$id = $_GET['id'];

$sql = mysqli_query($db, "SELECT * FROM galeri WHERE id_galeri='$id'");

if(mysqli_num_rows($sql) > 0){
    mysqli_query($db, "DELETE FROM galeri WHERE id_galeri='$id'");
    echo "<script>alert('Data galeri berhasil dihapus'); window.location = 'dashboard.php?hal=galeri'</script>";
} else {
    echo "<script>alert('Data tidak ditemukan'); window.location = 'dashboard.php?hal=galeri'</script>";
}
?>
