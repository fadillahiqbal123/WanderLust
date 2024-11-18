<?php
include "koneksi.php";
session_start();


if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = ($_POST['password']);

    // Hash password menggunakan MD5
    $hashed_password = mysqli_real_escape_string($db, md5($password));

    $query_username = mysqli_query($db, "SELECT * FROM admin WHERE username='$username' AND password='$hashed_password'");
    $cek_username = mysqli_num_rows($query_username);
    
    // Pastikan hasil query valid
    if ($cek_username > 0) {
        $r = mysqli_fetch_array($query_username);
        
        // Set session setelah login berhasil
        $_SESSION['username'] = $r['username'];
        $_SESSION['password'] = $r['password'];
        $_SESSION['idadmin'] = $r['id_admin'];

        // Jika "Remember Me" dicentang
        if (!empty($_POST["remember"])) {
            // Set cookie hanya untuk username (bukan password)
            setcookie("username", $_POST["username"], time() + (60 * 60 * 24 * 5));
            setcookie("password", $_POST["password"], time() + (60 * 60 * 24 * 5));
        } else {
            // Hapus cookie jika "Remember Me" tidak dicentang
            setcookie("username", "", time() - 3600);
            setcookie("password", "", time() - 3600);
        }

        // Redirect ke dashboard
        
        echo "<script>alert('Selamat Datang Di Dashboard'); window.location = 'dashboard.php?hal=home' </script>";
        exit; // Pastikan untuk keluar setelah redirect
    } else {
        // Jika login gagal
        echo "<script>alert('Username ATau Password Anda Salah. Periksa Kembali'); window.location= 'index.php'</script>";
        exit; // Pastikan untuk keluar setelah redirect
    }
} else {
    // Jika form tidak lengkap
    echo "<script>alert('Username Tidak Ditemukan. Silahkan Periksa Kembali'); window.location= 'index.php'</script>";
    exit; // Pastikan untuk keluar setelah redirect
}
?>
