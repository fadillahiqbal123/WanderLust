<!-- selanjutnya adalah tambah gambar dan komponen lain, saya berifir untuk memprioritaskan crud yang simple
namun tetap bekerja dengan baik, Bismillah Semoga Bisa Gusti Allah Menyertai ku -->
<?php
session_start();

$db = new mysqli("localhost", "root", "", "db_wisata");

if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}


$sql = "SELECT judul_berita, tgl_berita, konten_berita, foto_berita FROM berita";
$result = $db->query($sql);
?>

<!doctype html>
<html lang="en">
    <head>
        <title>WanderLust</title>
        <link rel="icon" href="image/lofo_wanderlust1.png" type="image/png">
        <link rel="icon" href="image/LOGO_WONDERLUST-removebg-preview 2.png" type="image/png">
       
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
             rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <!-- googlw font -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
            <!-- sweetalert -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <!-- sweper.js -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <!-- css -->
            <style>
                .custom-bg{
                    background-color: blue;
                }
                .custom-bg:hover{
                    background-color: blue;
                }
                .availability-form{
                    margin-top: -50px;
                    z-index: 2;
                    position: relative;
                }
            </style>
    </head>

    <body class="bg-light">
    <nav id="mainNav" class="navbar navbar-expand-lg navbar-secondary bg-white fixed-top px-lg-3 py-lg-2 shadow-sm styicky-top">
    <div class="container">
        <a class="navbar-brand me-5 fw-bold" href="#">
            <img src="image/lofo_wanderlust1.png" alt="WanderLust" style="height: 50px; width: 75px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#section1">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link require-login" href="#section2">Pesan Tiket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section3">Fasilitas</a>
                </li>
                <li class="mb-3">
                    <button  href="#section4" class="btn btn-dark require-login me-3">Login</button>
                </li>
                 </div>
               </div>
            </ul>
        </div>
        </div>
    </nav>

   
    


 <div clas="container-fluid px-lg-4 mt-4">
 <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <section id="section1" >
  <div class="carousel-inner">
  <div class="carousel-item active">
  <img src="image/hd.jpg" class="d-block w-100">
  <div class="carousel-caption d-none d-md-block">
    <div class="card bg-dark opacity-75">
    </div>
  </div>
</div>
<div class="carousel-item">
  <img src="image/bromo2.jpg" class="d-block w-100">
  <div class="carousel-caption d-none d-md-block">
    <div class="card bg-dark opacity-75">
    </div>
  </div>
</div>
<div class="carousel-item">
  <img src="image/hd2.png" class="d-block w-100">
  <div class="carousel-caption d-none d-md-block">
    <div class="card bg-dark opacity-75">
    </div>
  </div>
</div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  </section>
</div>
 </div>

<!-- layanan cari -->
<div class="container availability-form">
    <div class="row">
        <section id="#section2">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">Cek Jadwal</h5>
           <form>
            <div class="row align-items-end">
                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Cek Jadwal Anda</label>
                    <input type="date" class="form-control shadow-none">
                </div>
                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Tujuan Destinasi</label>
                    <input type="text" class="form-control shadow-none">
                </div>
                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight:500;">paket Wisata</label>
                    <select class="form-select shadow-none">
                    <option selected>-- Pilih Paket --</option>
                    <option value="1">Paket Trip 1</option>
                    <option value="2">Paket Trip 2</option>
                    <option value="3">Paket Trip 3</option>
                    </select>
                </div>
                <div class="col-lg-2 mb-3">
                    <label class="form-label" style="font-weight:500;">paket Kategori Wisata</label>
                    <select class="form-select shadow-none">
                    <option selected>-- Pilih Kategori --</option>
                    <option value="1">Paket Kategori 1</option>
                    <option value="2">Paket Kategori 2</option>
                    <option value="3">Paket Kategori 3</option>
                    </select>
                </div>
                <div class="col-lg-1 mb-lg-3 mt-2">
                    <button type="button" class="btn text-white shadow-none custom-bg">Submit</button>
                </div>
            </div>
            </div>
           </form>
           </section>
        </div>
    </div>

<!-- layanan paket -->
<div class="container mt-5">
 <div class="row">
  <div class="col-lg-4 col-md-6 my-3 rounded">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="image/paket1.png" class="d-block w-100">
          <div class="card-body">
            <h5 class="card-title mb-4"><strong>PAKET 1</strong></h5>
            <h6>Start From Rp. 1.000.000</h6>
            <div class="fasilitas mb-3">
               <h6 class="mb-1">Fasilitasi</h6>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    1 Mobil HiAce (Berisi 6 orang)
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    Wisata Pura Luhur Poten dan Bromo 
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    kenyamanan Perjalanan
               </span>
               
            </div>
            <div clas="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2 mt-3">
                <a type="button" class="btn btn-outline-primary btn-sm rounded-5">PESAN SEKARANG</a>
                <a type="button" class="btn btn-outline-dark btn-sm rounded-5">MORE DETAIL</a>
            </div>
            </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-3 rounded">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="image/paket2.png" class="d-block w-100">
          <div class="card-body">
            <h5 class="card-title mb-4"><strong>PAKET 2</strong></h5>
            <h6>Start From Rp. 1.000.000</h6>
            <div class="fasilitas mb-3">
               <h6 class="mb-1">Fasilitasi</h6>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    1 Mobil HiAce (Berisi 6 orang)
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    Wisata Pura Luhur Poten dan Bromo 
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    kenyamanan Perjalanan
               </span>
               
            </div>
            <div clas="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2 mt-3">
                <a type="button" class="btn btn-outline-primary btn-sm rounded-5">PESAN SEKARANG</a>
                <a type="button" class="btn btn-outline-dark btn-sm rounded-5">MORE DETAIL</a>
            </div>
            </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-3 rounded">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="image/paket3.png" class="d-block w-100">
          <div class="card-body">
            <h5 class="card-title mb-4"><strong>PAKET 3</strong></h5>
            <h6>Start From Rp. 1.000.000</h6>
            <div class="fasilitas mb-3">
               <h6 class="mb-1">Fasilitasi</h6>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    1 Mobil HiAce (Berisi 6 orang)
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    Wisata Pura Luhur Poten dan Bromo 
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    kenyamanan Perjalanan
               </span>
               
            </div>
            <div clas="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2 mt-3">
                <a type="button" class="btn btn-outline-primary btn-sm rounded-5">PESAN SEKARANG</a>
                <a type="button" class="btn btn-outline-dark btn-sm rounded-5">MORE DETAIL</a>
            </div>
            </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-3 rounded">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="image/paket3.png" class="d-block w-100">
          <div class="card-body">
            <h5 class="card-title mb-4"><strong>PAKET 1</strong></h5>
            <h6>Start From Rp. 1.000.000</h6>
            <div class="fasilitas mb-3">
               <h6 class="mb-1">Fasilitasi</h6>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    1 Mobil HiAce (Berisi 6 orang)
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    Wisata Pura Luhur Poten dan Bromo 
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    kenyamanan Perjalanan
               </span>
               
            </div>
            <div clas="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2 mt-3">
                <a type="button" class="btn btn-outline-primary btn-sm rounded-5">PESAN SEKARANG</a>
                <a type="button" class="btn btn-outline-dark btn-sm rounded-5">MORE DETAIL</a>
            </div>
            </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-3 rounded">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="image/paket3.png" class="d-block w-100">
          <div class="card-body">
            <h5 class="card-title mb-4"><strong>PAKET 2</strong></h5>
            <h6>Start From Rp. 1.000.000</h6>
            <div class="fasilitas mb-3">
               <h6 class="mb-1">Fasilitasi</h6>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    1 Mobil HiAce (Berisi 6 orang)
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    Wisata Pura Luhur Poten dan Bromo 
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    kenyamanan Perjalanan
               </span>
               
            </div>
            <div clas="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2 mt-3">
                <a type="button" class="btn btn-outline-primary btn-sm rounded-5">PESAN SEKARANG</a>
                <a type="button" class="btn btn-outline-dark btn-sm rounded-5">MORE DETAIL</a>
            </div>
            </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-3 rounded">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="image/paket3.png" class="d-block w-100">
          <div class="card-body">
            <h5 class="card-title mb-4"><strong>PAKET 3</strong></h5>
            <h6>Start From Rp. 1.000.000</h6>
            <div class="fasilitas mb-3">
               <h6 class="mb-1">Fasilitasi</h6>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    1 Mobil HiAce (Berisi 6 orang)
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    Wisata Pura Luhur Poten dan Bromo 
               </span>
               <span class="badge rounded-pillbg-light text-dark text-wrap">
                    kenyamanan Perjalanan
               </span>
               
            </div>
            <div clas="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2 mt-3">
                <a type="button" class="btn btn-outline-primary btn-sm rounded-5">PESAN SEKARANG</a>
                <a type="button" class="btn btn-outline-dark btn-sm rounded-5">MORE DETAIL</a>
            </div>
            </div>
        </div>
      </div>
   </div>
 </div>


 <!-- berita terkini -->
 <h5 class="mt-5 pt-5 mb-5 text-center fw-bold h-font">BERITA BROMO</h5>

 <?php
$sql = "SELECT judul_berita, tgl_berita, konten_berita, foto_berita FROM berita";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="container mt-4">';
    while($row = $result->fetch_assoc()) {
        // Path gambar
        $foto_path = '../Admin/img_berita/' . $row['foto_berita'];
?>
        <div class="row mb-4 rounded shadow">
            <div class="col-md-4">
                <img src="<?php echo $foto_path; ?>" class="img-fluid rounded" alt="Berita Terkini">
            </div>
            <div class="col-md-8">
                <h3><?php echo $row['judul_berita']; ?></h3>
                <p><small class="text-muted"><?php echo date('d-m-Y', strtotime($row['tgl_berita'])); ?></small></p>
                <p><?php echo $row['konten_berita']; ?></p>
            </div>
        </div>
<?php
    }
    echo '</div>';
} else {
    echo "<p>Tidak ada berita tersedia.</p>";
}
?>

<section id="section3">
    
<h2 class="mt-5 pt-5 text-center fw-bold h-font">Fasilitas WanderLust</h2>
<div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/point.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/picture.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/keamanan.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/kenyamanan.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/driver.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>   
    </div>
    </div>
    </section>

    
 
<br><br><br><br>
<br><br><br><br>







   



        <footer>
            <?php 
                include "layout/footer.php"
            ?>
        </footer>

    
       



        <script>
            const isLoggedIn = <?php echo isset($_SESSION['id_user']) ? 'true' : 'false'; ?>;

    // Dapatkan semua elemen yang membutuhkan login
            const loginRequiredLinks = document.querySelectorAll('.require-login');

            loginRequiredLinks.forEach(link => {
            link.addEventListener('click', function(event) {
            // Cek apakah user sudah login
            if (!isLoggedIn) {
                event.preventDefault(); // Mencegah link bekerja
                alert('Silakan login terlebih dahulu untuk mengakses bagian ini.');
                window.location.href = 'index.php'; // Arahkan ke halaman login
                 }
            });
        });
    </script>

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
    </body>
</html>
