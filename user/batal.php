<?php 
session_start();
include "koneksi.php";

$id_pesan = $_GET['i'];

$sql =  "DELETE FROM pesan WHERE id_pesan='$id_pesan'";
  mysqli_query($db, $sql) or die(mysqli_error($db));

  if($sql){
    echo "<script>alert('Pembatalan Pesanan Berhasil Dilakukan'); window.location = 'cekstatus.php'</script>";
  }else{
    echo "<script>alert('Terjadi Masalah Pada Sistem Kami, Mohon Bersabar dan Coba lagi beberapa saat'); window.location = 'cekstatus.php' </script>";
  }

?>