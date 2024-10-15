<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "db_wisata";

$db = mysqli_connect($server, $user, $password, $nama_database);

if ($db) {
    //echo "koneksi berhasil";
}
if ($db->connect_error) {
    die("Koneksi gagal " . $db->connect_error);
}
