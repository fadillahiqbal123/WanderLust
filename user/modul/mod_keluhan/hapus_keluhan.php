<?php 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = mysqli_query($db, "DELETE FROM saran WHERE id_keluhan='$id'");

  
    if ($sql) {
        echo "<script>alert('Data keluhan Berhasil Dihapus'); window.location = 'dashboard.php?hal=keluhan' </script>";
    } else {
        die("Gagal menghapus data: " . mysqli_error($db)); // Menampilkan pesan error dari MySQL
    }
} else {
    echo "<script>alert('ID tidak ditemukan'); window.location = 'dashboard.php?hal=keluhan' </script>";
}
?>