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
            <!-- link fontawsom -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
            <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
                             color: white;
                }

                    
                    .text-white {
                            color: #000000 !important; /* Ganti warna teks menjadi hitam */
                        }
                    .col-lg-2.position-fixed.vh-100.bg-ligth {
                        border-right: 2px solid #ccc;
                        position : relative;
                        overflow-y: auto;
                        max-height: 100vh; 
                    }
                    .nav-link {
                        color: #adb5bd;
                        text-decoration: none;
                    }

                    /* Warna link aktif */
                    .nav-link.active {
                        color: #ffffff;
                        background-color: #007bff;
                    }

                    /* Hover link */
                    .nav-link:hover {
                        color: #ffffff;
                        background-color: #0056b3;
                    }

            </style>
        </head>

        <body>
        <div class="row">
    <div class="col-lg-12 py-2 bg-secondary fixed-top d-flex justify-content-between align-items-center">
        <!-- Nav Brand -->
        <a href="index.php" class="navbar-brand ms-3 text-white">
            <img src="image/wander_logo.png" height="55" width="90" alt="Brand Logo" class="me-2">
        </a>

        <!-- icon font awsom -->
         <div class="d-flex ms-3">
            <a href="#" class="text-white me-3">
                 <i class="fa-brands fa-square-instagram" style="font-size: 1.em;"></i>
            </a>
            <a href="#" class="text-white me-3">
                 <i class="fa-brands fa-facebook" style="font-size: 1.em;"></i>
            </a>
            <a href="#" class="text-white me-3">
                <i class="fa-brands fa-linkedin" style="font-size: 1.em;"></i>
            </a>
            <a href="#" class="text-white me-3">
               <i class="fa-brands fa-tiktok" style="font-size: 1.em;"></i>
            </a>
         </div>
         
        <!-- User Dropdown -->
        <div class="text-end">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                User
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a class="dropdown-item" role="button" id="userDropdown" data-bs-toggle="dropdown" href="#">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img class="me-3" src="image/user.png" height="50" width="50" alt="Generic placeholder image" style="border-radius: 50%; object-fit: cover;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-0"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Apa'; ?></h5>
                                <small><p class="text-muted"><i class="bi bi-clock-fill"></i> Pkl <?php echo date('H:i:s') ?> WIB</p></small>
                            </div>
                        </div>
                    </a>
                </li>
                <li><a class="dropdown-item" href="dashboard.php?hal=user"><i class="bi bi-gear"></i> Setting</a></li>
                <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar dari aplikasi?')">
                    <img src="image/logout(1).png"> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
            


        
                
            <div class="row mt-5 bg-body" style="padding-top: 25px; font-size: 14px;">
            <div class="col-lg-2 col-md-3 col-sm-12 bg-light sidebar" style="overflow-y: auto; position: sticky; top: 0; height:100vh; border-right:5px;">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'home' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=home"><i class="bi bi-houses-fill"></i> Home</a>
                <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'profile' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=profile"><i class="bi bi-person-bounding-box"></i> Profile</a>
                <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'galeri' or ($_GET['hal'] == 'tambah_galeri')  or ($_GET['hal'] == 'edit_galeri')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=galeri"><i class="bi bi-image-fill"></i> Galeri</a>
                <a class="nav-link <?php echo (((isset($_GET['hal']) && $_GET['hal'] == 'destinasi-wisata' or $_GET['hal'] == 'tambah_wisata') or ($_GET['hal'] == 'edit_wisata')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=destinasi-wisata"><i class="bi bi-image-alt"></i> Destinasi Wisata</a>
                <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'berita' or ($_GET['hal'] == 'tambah_berita')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=berita"><i class="bi bi-router"></i> Berita</a>
                <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'kategori' or ($_GET['hal'] == 'tambah_kategori') or ($_GET['hal'] == 'edit_kategori')) ?  "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=kategori"><i class="bi bi-stack"></i> Kategori</a>
                <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'keluhan' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=keluhan"><i class="bi bi-send-plus-fill"></i> Keluhan Pengguna</a>
                
                            
                <div class="treeview">
            <a href="#" class="nav-link text-white mb-3" data-bs-toggle="collapse" 
            data-bs-target="#pesananTreeview" aria-expanded="false">
                <i class="bi bi-coin"></i> Pesanan <i class="bi bi-chevron-down"></i>
            </a>
    
    
    <div class="collapse" id="pesananTreeview">
        
        <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'pesanan-lunas') ? 'active text-white' : 'text-muted'; ?>" href="dashboard.php?hal=pesanan-lunas">
            <i class="bi bi-stack"></i> Pesanan Lunas
        </a>

       
        <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'konfirmasi-pesan') ? 'active text-white' : 'text-muted'; ?>" href="dashboard.php?hal=konfirmasi-pesan">
            <i class="bi bi-plus-circle"></i> Konfirmasi Pesanan
        </a>

        <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'dalam-proses') ? 'active text-white' : 'text-muted'; ?>" href="dashboard.php?hal=belum-bayar">
            <i class="bi bi-credit-card"></i> Pesanan Belum Bayar
        </a>
    </div>
</div>


                <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'alamat' or ($_GET['hal'] == 'tambah_alamat') or ($_GET['hal'] == 'edit_alamat')) ?  "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=alamat"><i class="fa-solid fa-truck-pickup"></i> Alamat</a>
                <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'kendaraan' or ($_GET['hal'] == 'tambah_kendaraan') or ($_GET['hal'] == 'edit_kendaraan')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=kendaraan"><i class="bi bi-car-front-fill"></i> Atur Armada</a>
                <a class="nav-link <?php echo ((isset($_GET['hal']) && $_GET['hal'] == 'jadwal' or ($_GET['hal'] == 'tambah_jadwal') or ($_GET['hal'] == 'edit_jadwal')) ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=jadwal"><i class="bi bi-car-front-fill"></i> Atur Jadwal</a>
                <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'pendaftar' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=pendaftar"><i class="bi bi-person-fill-check"></i> Lihat User</a>
                <a class="nav-link <?php echo (isset($_GET['hal']) && $_GET['hal'] == 'laporan' ? "active text-white" : "text-white") ?> mb-3" href="dashboard.php?hal=laporan"><i class="bi bi-journal-bookmark-fill"></i> Laporan</a> 
                
             
                
                


            </div>
        </div>
                <div class="col-lg-10 col-md-9 col-sm-12 card bg-white">

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
                        case 'pesanan-lunas':
                            include "modul/mod_transaksi/pemesanan_lunas.php";
                            break;
                        case 'konfirmasi-pesan':
                            include "modul/mod_transaksi/konfirmasi_pesan.php";
                            break;
                        case 'perbarui_pesanan':
                            include "modul/mod_transaksi/perbarui_pesanan.php";
                            break;
                       case 'pendaftar':
                          include "modul/mod_pengunjung/pengunjung.php";
                            break;
                        case 'kendaraan':
                            include "modul/mod_armada/atur_kendaraan.php";
                            break;
                        case 'tambah_kendaraan':
                            include "modul/mod_armada/tambah_kendaraan.php";
                            break;
                        case 'edit_kendaraan':
                            include "modul/mod_armada/edit_kendaraan.php";
                            break;
                        case 'hapus_kendaraan':
                            include "modul/mod_armada/hapus_kendaraan.php";
                            break;
                        case 'jadwal':
                            include "modul/mod_jadwal/atur_jadwal.php";
                            break;
                        case 'tambah_jadwal':
                            include "modul/mod_jadwal/tambah_jadwal.php";
                            break;
                        case 'hapus_jadwal':
                            include "modul/mod_jadwal/hapus_jadwal.php";
                            break;
                        case 'edit_jadwal':
                            include "modul/mod_jadwal/edit_jadwal.php";
                            break;
                        case 'alamat':
                            include "modul/mod_alamat/atur_alamat.php";
                            break;
                        case 'tambah_alamat':
                            include "modul/mod_alamat/tambah_alamat.php";
                            break;
                        case 'edit_alamat':
                            include "modul/mod_alamat/edit_alamat.php";
                            break;
                        case 'hapus_alamat':
                            include "modul/mod_alamat/hapus_alamat.php";
                            break;
                        case 'laporan':
                            include "modul/mod_laporan/laporan.php";
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

        
            <footer>
            </footer>
            <script
                src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous"
            ></script>
   
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- dropdown menu -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownLinks = document.querySelectorAll('[data-bs-toggle="collapse"]');
        dropdownLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                dropdownLinks.forEach(otherLink => {
                    const otherTarget = document.querySelector(otherLink.getAttribute('href'));
                    if (otherTarget !== target) {
                        otherTarget.classList.remove('show'); // Close other dropdowns
                    }
                });
            });
        });
    });
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const treeviewLinks = document.querySelectorAll("[data-bs-toggle='collapse']");

    treeviewLinks.forEach(link => {
        link.addEventListener("click", function() {
            const allSubmenus = document.querySelectorAll(".collapse");
            allSubmenus.forEach(submenu => {
                if (submenu !== document.querySelector(link.dataset.bsTarget)) {
                    submenu.classList.remove("show");
                }
            });
        });
    });
});
</script>


            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
                integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
                crossorigin="anonymous"
            ></scrip>
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
                    order: [[1, 'desc']]
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