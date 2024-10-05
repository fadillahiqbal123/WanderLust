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
    }else{
             // data wisata
            $kategori_destinasi = mysqli_query($db, "SELECT * FROM kategori");
            while($r = mysqli_fetch_array($kategori_destinasi)){
            $nama_kategori[] = $r['nama_kategori'];
            $jml_destinasi = mysqli_query($db, "SELECT COUNT(id_kategori) AS total FROM destinasi WHERE id_kategori = '$r[id_kategori]'");

            $a =  mysqli_fetch_array($jml_destinasi);
            $total_destinasi[] = $a['total'];
            }

            // data galeri
            $wisata = mysqli_query($db, "SELECT * FROM destinasi");
            while($r1 = mysqli_fetch_array($wisata)){
            $nama_destinasi[] = $r1['nama_destinasi'];
            $jml_galeri = mysqli_query($db, "SELECT COUNT(id_destinasi) AS total_galeri FROM galeri WHERE id_destinasi = '$r1[id_destinasi]'");

            $a1 =  mysqli_fetch_array($jml_galeri);
            $total_galeri[] = $a1['total_galeri'];
            }
    
    

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
         <!-- BOOTSTRAP CSS -->
            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
                rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
                crossorigin="anonymous"/>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <script src="//cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
                <!-- DATA TABLES JS -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">

            <!-- GRAFIK JS -->
             <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
            
            <style>
                .nav-link:hover {
                    background-color: #004085; 
                    
            }

            .bg-primary .nav-link.active {
                background-color: #004085 !important;
                color: white !important;
                    }

                    body {
                        margin: 0;
                        padding: 0;
                        overflow-x: hidden;
                        background-color: #ffffff; /* Ganti warna dasar menjadi putih */
                        }
                    .nav-link:hover {
                        background-color: #d1e7dd; /* Sesuaikan hover dengan warna lebih terang */
                        }

                        .col-lg-12.py-3.bg-ligth.text-end.bg-ligth.fixed-top {
                             background-color: #004085; /* Ganti ini dengan warna background yang kamu inginkan */
                             color: white; /* Jika ingin mengubah warna teks juga */
}

                    

                    .text-white {
                            color: #000000 !important; /* Ganti warna teks menjadi hitam */
                        }
                    .col-lg-2.position-fixed.vh-100.bg-ligth {
                        border-right: 2px solid #ccc; /* Garis pemisah dengan warna abu-abu */
                        position : relative;
}

            </style>
        </head>

        <body>
            <div class="row">
                <div class="col-lg-12 py-2 bg-primary text-end fixed-top">
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
            <div class="row mt-5 bg-body" style="padding-top: 25px;">
        <div class="col-lg-2 col-md-3 col-sm-12 position-fixed vh-100 bg-ligth">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'home' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=home"><i class="bi bi-houses-fill"></i> Home</a>
                <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'profile' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=profile"><i class="bi bi-person-bounding-box"></i> Profile</a>
                <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'galeri' or ($_GET['hal'] == 'tambah_galeri')  or ($_GET['hal'] == 'edit_galeri')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=galeri"><i class="bi bi-image-fill"></i> Galeri</a>
                <a class="nav-link <?php echo (((isset($_GET['hal']) && $_GET['hal'] == 'destinasi-wisata' or $_GET['hal'] == 'tambah_wisata') or ($_GET['hal'] == 'edit_wisata')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=destinasi-wisata"><i class="bi bi-image-alt"></i> Destinasi Wisata</a>
                <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'berita' or ($_GET['hal'] == 'tambah_berita')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=berita"><i class="bi bi-router"></i> Berita</a>
                <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'kategori' or ($_GET['hal'] == 'tambah_kategori') or ($_GET['hal'] == 'edit_kategori')) ?  "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=kategori"><i class="bi bi-stack"></i> Kategori</a>
                <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'keluhan' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=keluhan"><i class="bi bi-send-plus-fill"></i> Keluhan Pengguna</a>

            </div>
        </div>
                <div class="col-lg-10 offset-2 col-md-9 md-3 col-sm-12">

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
                        case 'tambah_galeri';
                            include "modul/mod_galeri/tambah_galeri.php";
                            break;
                        case 'edit_galeri';
                            include "modul/mod_galeri/edit_galeri.php";
                            break;
                        case 'hapus_galeri':
                            include "modul/mod_galeri/hapus_galeri.php";
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
                        case 'keluhan':
                            include "modul/mod_keluhan/form_service.php";
                            break;
                        case 'hapus_keluhan':
                            include "modul/mod_keluhan/hapus_keluhan.php";
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
                    }).draw();
                



                    const x = <?php echo json_encode($nama_kategori) ?>;
                    const y = <?php echo json_encode($total_destinasi)  ?>;
                    const warna_bar = [
                    "#007bff",
                    "#ffc107",
                    "#28a745",
                    "#dc3545",
                    "#6c757d",
                    "#17a2b8"
                    ];

                    new Chart("grafikWisata", {
                    type: "doughnut",
                    data: {
                        labels: x,
                        datasets: [{
                        backgroundColor: warna_bar,
                        data: y
                        }]
                    },
                    options: {
                        title: {
                        display: true,
                        text: "Data Jumlah Wisata Berdasar Pada Kategori"
                        }
                    }
                    });
                    
                    
                    
                    const x1 = <?php echo json_encode($nama_destinasi) ?>;
                    const y1 = <?php echo json_encode($total_galeri)  ?>;
                    const warna_bar1 = [
                    "#007bff",
                    "#ffc107",
                    "#28a745",
                    "#dc3545",
                    "#6c757d",
                    "#17a2b8"
                    ];

                    new Chart("grafikGaleri", {
                    type: "doughnut",
                    data: {
                        labels: x1,
                        datasets: [{
                        backgroundColor: warna_bar1,
                        data: y1
                        }]
                    },
                    options: {
                        title: {
                        display: true,
                        text: "Data Jumlah Galeri"
                        }
                    }
                    });
            </script>
        </body>
    </html>
    <?php
    }
    ?>