
<link src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></link>

<?php
session_start();
include "koneksi.php";

$db = new mysqli("localhost", "root", "", "db_wisata");

if (isset($_SESSION['id_user'])) {
    header("Location: dashboard.php");
    exit();
}



if (isset($_POST['register']) || isset($_POST['login'])) {
    // Proses Registrasi
    if (isset($_POST['register'])) {
        $nama = $_POST['nama_user'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST["password"];
        $hash_password = md5($password); // Menggunakan MD5 untuk hashing

        $stmt = $db->prepare("SELECT * FROM user WHERE nama_user=? OR email=?");
        $stmt->bind_param("ss", $nama, $email);
        $stmt->execute();
        $result_check = $stmt->get_result();

        if ($result_check->num_rows > 0) {
            echo "<script>
                alert('Daftar Gagal! Username atau email sudah terdaftar');
                window.location = 'index.php';
            </script>";
        } else {
            $stmt = $db->prepare("INSERT INTO user (nama_user, email, username, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nama, $email, $username, $hash_password);
            if ($stmt->execute()) {
                echo "<script>
                    alert('Daftar Berhasil! Anda akan diarahkan ke halaman login.');
                    window.location = 'index.php';
                </script>";
            } else {
                echo "<script>
                    alert('Daftar Gagal! Terjadi kesalahan, silakan coba lagi.');
                    window.location = 'index.php';
                </script>";
            }
        }
    }

    // Proses Login
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']); // Menggunakan MD5 untuk verifikasi

        $stmt = $db->prepare("SELECT * FROM user WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($password === $user['password']) { 
                $_SESSION['id_user'] = $user['id_user']; 
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['password'];

                if (!empty($_POST["remember"])) {
                    setcookie("email", $_POST["email"], time() + (60 * 60 * 24 * 5), "/");
                    setcookie("password", $_POST["password"], time() + (60 * 60 * 24 * 5), "/");
                } else {
                    setcookie("email", "", time() - 3600, "/");
                    setcookie("password", "", time() - 3600, "/");
                }

                echo "<script>
                    alert('Login Berhasil!');
                    window.location = 'dashboard.php';
                </script>";
                exit();
            } else {
                echo "<script>
                    alert('Login Gagal! Password salah. Silakan coba lagi.');
                    window.location = 'index.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('Login Gagal! Email tidak ditemukan. Silakan coba lagi.');
            </script>";
            header("Location: gagal_login.php");
            exit();
        }
    }
}
?>