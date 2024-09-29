<?php
session_start();
require_once "koneksi.php";
date_default_timezone_set('Asia/Jakarta');

if(empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo'
    <br><br><br><br><br><br><br><br>
    <center>
    <b>Maaf, silahkan login kembali</b><br>
    <b>Anda sudah keluar dari sistem</b><br>
    <b>atau anda belum melakukan login</b><br>

    <a href="index.php" title="Klik Gambar ini untuk kembali ke Halaman Login"><img src="image/key1.png" height="100" width="100"></img></a>

    </center> 
    ';
}else
{
    

?>


<!doctype html>
<html lang="en">
    <head>
        <title>.:Dashboard - <?php echo ucwords(str_replace('_','_',$_GET['hal']))  ?></title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="//cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
        <style>
            .nav-link:hover {
                 background-color: #004085; 
                 
           }

           .bg-primary .nav-link.active {
             background-color: #004085 !important;
             color: white !important;
}
        </style>
    </head>

    <body>
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 py-3 bg-dark text-end fixed-top">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    User
                </button>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                 <li><a class="dropdown-item" href="#">
                 <div class="d-flex align-items-center">
          
            <div class="flex-shrink-0">
                <img class="mr-3" src="image/user.png" height="50" width="50" alt="Generic placeholder image" style="border-radius: 50%; object-fit: cover;">
            </div>
        
            <div class="flex-grow-1 ms-3">
                <h5 class="mb-0"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Apa'; ?></h5>
                <small><p class="text-muted"><i class="bi bi-clock-fill"></i>Pkl <?php echo date('H:i:s')  ?>WIB</l></small>
            </div>
        </div>
                    </a></li>

                    <li><a class="dropdown-item" href="dashboard.php?hal=user"><i class="bi bi-gear"></i>Setting</a></li>
                    <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar dari aplikasi?')">
                        <img src="image/logout(1).png">Logout</a></li>
                </ul>
       </div>

            </div>
        </div>
        <div class="row mt-5" style="padding-top: 20px;">
    <div class="col-lg-2 position-fixed vh-100 bg-primary">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'home' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=home"><i class="bi bi-houses-fill"></i> Home</a>
            <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'profile' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=profile"><i class="bi bi-person-bounding-box"></i> Profile</a>
            <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'galeri' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=galeri"><i class="bi bi-image-fill"></i> Galeri</a>
            <a class="nav-link <?php echo (((isset($_GET['hal']) && $_GET['hal'] == 'destinasi-wisata' or $_GET['hal'] == 'tambah_wisata') or ($_GET['hal'] == 'edit_wisata')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=destinasi-wisata"><i class="bi bi-image-alt"></i> Destinasi Wisata</a>
            <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'berita' or ($_GET['hal'] == 'tambah_berita')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=berita"><i class="bi bi-router"></i> Berita</a>
            <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'kategori' or ($_GET['hal'] == 'tambah_kategori') or ($_GET['hal'] == 'edit_kategori')) ?  "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=kategori"><i class="bi bi-stack"></i> Kategori</a>
            <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'keluhan' ? "active text-white" : "text-white") ?> mb-3" href="form_service.php?hal=keluhan"><i class="bi bi-send-plus-fill"></i> Keluhan Pengguna</a>

        </div>
    </div>
            <div class="col-lg-10 offset-2">

             <?php
              
              if(isset($_GET['hal'])){

                switch($_GET['hal']) {
                    case 'home'; 
                    include "modul/mod_home/home.php";
                    break;
                    case 'profile':
                        include "modul/mod_profile/profile.php";
                    break;
                    case 'galeri':
                        include "modul/mod_galeri/galeri.php";
                        break;
                    case 'tambah_galeri':
                        include "modul/mod_galeri/tambah_galeri.php";
                        break;
                    case 'destinasi-wisata':
                        include "modul/mod_wisata/wisata.php";
                        break;
                    case 'tambah_wisata':
                        include "modul/mod_wisata/tambah_wisata.php";
                        break;
                    case 'edit_wisata':
                        include "modul/mod_wisata/edit_wisata.php";
                        break;
                    case 'hapus_wisata':
                        include "modul/mod_wisata/hapus_wisata.php";
                        break;
                    case 'kategori':
                        include "modul/mod_kategori/kategori.php";
                        break;
                    case 'tambah_kategori':
                        include "modul/mod_kategori/tambah_kategori.php";
                        break;
                    case 'berita':
                        include "modul/mod_berita/berita.php";
                        break;
                    case 'tambah_berita':
                        include "modul/mod_berita/tambah_berita.php";
                        break;
                    case 'edit_kategori':
                        include "modul/mod_kategori/edit_kategori.php";
                        break;
                    case 'hapus_kategori':
                        include "modul/mod_kategori/hapus_kategori.php";
                        break;
                    case 'hapus_berita':
                        include "modul/mod_berita/hapus_berita.php";
                        break;
                    case 'user':
                        include "modul/mod_user/user.php";
                        break;
                        default:
                        echo "<h1>Halaman Tidak Ditemukan</h1>";
                
                }
              }else{
                header("location:dashboard.php?hal=home");
              }
             


             ?>
            </div>   
        </div>

        </div>
      </div>
        <footer>
        </footer>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
        <script>
         const table = new DataTable('#example', {
                columnDefs: [
              {
                  searchable: false,
                  orderable: false,
                  targets: 0
             }
                ],
                order: [[1, 'asc']]
            });
            
            table
                 .on('order.dt search.dt', function () {
                    let i = 1;
            
                table
                      .cells(null, 0, { search: 'applied', order: 'applied' })
                      .every(function (cell) {
                            this.data(i++);
                        });
                })
                .draw();
        </script>
    </body>
</html>
<?php
}
?>