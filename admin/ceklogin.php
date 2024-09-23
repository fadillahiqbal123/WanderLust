<?php
include "koneksi.php";
session_start();

$username = mysqli_real_escape_string($db, $_POST['username']);
$password = ($_POST['password']);

// Hash password menggunakan MD5
$hashed_password = mysqli_real_escape_string($db, md5($password));

// Query untuk mencari username dan password yang cocok
$query = mysqli_query($db, "SELECT * FROM admin WHERE username='$username' AND password='$hashed_password'");
$cek = mysqli_num_rows($query);
$r = mysqli_fetch_array($query);

if ($cek > 0) {
    // Set session setelah login berhasil
    $_SESSION['username'] = $r['username'];
    $_SESSION['password'] = $r['password'];
    $_SESSION['idadmin']  = $r['id_admin'];

    // Jika "Remember Me" dicentang
    if (!empty($_POST["remember"])) {
        // Set cookie hanya untuk username (bukan password)
        setcookie("username", $_POST["username"], time() + (60 * 60 * 24 * 5));
        setcookie("password", $_POST["password"], time() + (60 * 60 * 24 * 5));
    } else {
        // Hapus cookie jika "Remember Me" tidak dicentang
        setcookie("username", "");
        setcookie("password", "");
    }

    // Redirect ke dashboard
    header("location:dashboard.php?hal=home");
} else {
    // Jika login gagal
    header("location:gagal_login.php");
}
?>
