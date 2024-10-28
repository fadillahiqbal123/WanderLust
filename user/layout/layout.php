<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Tambahkan CSS Bootstrap di sini -->
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar_user.php'; ?>

    <!-- Konten Dinamis -->
    <div class="container mt-4">
        <?php
            if(isset($_GET['hal'])){
                switch($_GET['hal']) {
                    case 'home': 
                        include "pages/home.php";
                        break;
                    case 'profile':
                        include "pages/profile.php";
                        break;
                    // Tambahkan halaman lainnya sesuai kebutuhan
                    default:
                        echo "<h1>Halaman Tidak Ditemukan</h1>";
                }
            } else {
                header("location:dashboard.php?hal=home");
            }
        ?>
    </div>   
</body>
</html>
