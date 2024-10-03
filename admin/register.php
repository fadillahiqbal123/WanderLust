<?php 
session_start();
include "koneksi.php";

if(isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
}

if(isset($_POST["register"])){
    $nama_admin = $_POST["nama_admin"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $hash_password = md5($password);

    $sql =  "SELECT * FROM admin WHERE username = '$username' OR email = '$email'";
    $result_check = $db->query($sql);
    
    if($result_check->num_rows > 0) {
        // SweetAlert untuk kegagalan registrasi (username/email sudah terdaftar)
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Daftar Gagal!',
                        text: 'Username atau email sudah terdaftar',
                        showConfirmButton: true
                    });
                });
              </script>";
    } else {
        try {
            $sql = "INSERT INTO admin (nama_admin, username, password, email) VALUES ('$nama_admin', '$username', '$hash_password', '$email')";
            
            if($db->query($sql)) {
                // SweetAlert untuk sukses registrasi
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Daftar Berhasil!',
                                text: 'Anda akan diarahkan ke halaman login.',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function() {
                                window.location.href = 'index.php';
                            });
                        });
                      </script>";
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Daftar Gagal!',
                                text: 'Terjadi kesalahan, silakan coba lagi.',
                                showConfirmButton: true
                            });
                        });
                      </script>";
            }
        } catch (mysqli_sql_exception $e) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Daftar Gagal!',
                            text: '" . $e->getMessage() . "',
                            showConfirmButton: true
                        });
                    });
                  </script>";
        }
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <title>Register Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        .posisitengah {
            margin: 0 auto;
        }
        
        body {
            background-image: url("image/bg_login.png");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mb-5 mt-5">
        <div class="col-md-4 posisitengah">
            <div class="card mt-4">
                <div class="card-body">
                    <form action="register.php" method="POST">
                        <div class="form-group">
                            <label class="form-label">Nama Admin</label>
                            <input type="text" name="nama_admin" class="form-control" placeholder="Masukan Nama" required>
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukan Username" required>
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" name="register" class="btn btn-outline-primary w-100">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
