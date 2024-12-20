<!-- selanjutnya adalah tambah gambar dan komponen lain, saya berifir untuk memprioritaskan crud yang simple
namun tetap bekerja dengan baik, Bismillah Semoga Bisa Gusti Allah Menyertai ku -->
<?php
  session_start();
  date_default_timezone_set('Asia/Jakarta');

  
    $db = new mysqli("localhost", "root", "", "db_wisata");

    if ($db->connect_error) {
        die("Koneksi gagal: " . $db->connect_error);
    }

    // Mengambil data berita
    $sql = "SELECT judul_berita, tgl_berita, konten_berita, foto_berita FROM berita";
    $result = $db->query($sql);

    // Mulai HTML
    ?>



<!doctype html>
<html lang="en">
    <head>
    <title>WanderLust</title>
    <link rel="icon" href="image/lofo_wanderlust1.png" type="image/png">
       
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
             rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <!-- sweetalert -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
            <!-- font awsome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <!-- google font -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
              <!-- css -->
          <style>
            *{
              font-family: "Poppins", sans-serif;
            }
            .row{
              padding-left: 15px;
              padding-right: 15px;
             
            }
            .tour-package-card {
              border-radius: 5px;
              border: 1px;
              box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
              transition: transform 0.3s ease;
              margin: 0 15px;
            }

            .tour-package-card:hover {
              transform: scale(1.1);
              border: 1px;
              box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        .availability-form{
          margin-top: -50px;
          z-index: 2;
          position: relative;
        }  
          </style>    
    </head>

    <body>
      <header>
        <nav class="navbar navbar-expand-lg navbar-ligth bg-white align-items-center fixed-top px-lg-3 py-lg-2 shadow-sm styicky-top">
           <div class="container">
          <a class="navbar-brand" href="page-top"><img src="image/lofo_wanderlust1.png" height="60px;" style="vertical-align: middle;"></a>
          <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active me-2 js-scroll-trigger text-dark" aria-current="page" href="#section1"><strong>Home</strong></a>
              </li>

              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              <li class="nav-item">
                <a class="nav-link me-2 js-scroll-trigger text-dark" href="#section2"><strong> Pesan Tiket</strong></a>
              </li>

              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              <li class="nav-item">
                <a class="nav-link me-2 js-scroll-trigger text-dark" href="#"><strong>Fasilitas</strong></a>
               </li>

               <span class="text-dark mx-2 d-flex align-items-center">|</span>
               <li class="nav-item">
                <a class="nav-link me-2 js-scroll-trigger text-dark" href="#berita"><strong> Berita</strong></a>
              </li>

              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              <li class="nav-item">
                <a class="nav-link me-2 active js-scroll-trigger text-dark" href="#hubungi_kami"><strong>Hubungi Kami</strong></a>
              </li>
              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              <a class="nav-link me-2 active js-scroll-trigger text-dark" href="#about"><strong>About</strong></a>
              </li>
              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              
              <li class="nav-item dropdown">
    <button class="nav-link dropdown-toggle bg-primary text-light rounded" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <strong>User</strong>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
        <li>
            <a class="dropdown-item" role="button" href="#">
                <i class="fa-solid fa-user"></i>
                <span class="username"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Apa'; ?></span>
            </a>
        </li>
        <li>
            <small>
                <p class="dropdown-item text-center">
                    <i class="bi bi-clock-fill"></i> Pkl <?php echo date('H:i:s')?> WIB
                </p>
            </small>
        </li>
        <li><a class="dropdown-item" href="dashboard.php?hal=setting"><i class="bi bi-gear-fill"></i> Setting</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
    </ul>
</li>


        
              </ul>
            </div>
          </div>
        </nav>
        </header>

        <!-- <div class="container-fluid" style="background-image: url('image/pemandangan2.png'); background-size: cover; height:750px; text-align: center; margin-top: -120px;">
    <div class="p-5 mb-4 bg-ligth rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold text-white" style="margin-top: 200px;">Explore Bromo<br><span class="font-weight-bold">With WanderLust</span></h1>
            <hr class="my-4" style="border-color: blue; width: 100px; border-width:3px; margin: 0 auto;">
            <p class="col-md-12 fs-2 text-white lead">Bromo Lebih Dekat, Perjalanan Lebih Nyaman</p>
            <button class="btn btn-primary btn-lg my-4" type="button">MORE DETAIL</button>
        </div>
    </div>
</div> -->




  <main>
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <section id="section1" >
  <div class="carousel-inner">
  <div class="carousel-item active">
  <img src="image/pemandangan16.jpg" class="d-block w-100">
  <div class="carousel-caption d-none d-md-block">
    <div class="card bg-dark opacity-75">
      <div class="card-body">
        <h1 class="display-5 fw-bold text-white" style="margin-top: 20px;">Pura Luhur Poten</h1>
        <p class="col-md-12 fs-4 text-white">Keindahan Budaya dan Agama Akan Nampak Disini</p>
        <button class="btn btn-primary btn-lg my-4 rounded-5" type="button">MORE DETAIL</button>
      </div>
    </div>
  </div>
</div>
<div class="carousel-item">
  <img src="image/pemandangan14.png" class="d-block w-100">
  <div class="carousel-caption d-none d-md-block">
    <div class="card bg-dark opacity-75">
      <div class="card-body">
        <h1 class="display-5 fw-bold text-white" style="margin-top: 20px;">Gunung Bromo</h1>
        <p class="col-md-12 fs-4 text-white">Keindahan Gunung Bromo</p>
        <button class="btn btn-primary btn-lg my-4 rounded-5" type="button">MORE DETAIL</button>
      </div>
    </div>
  </div>
</div>
<div class="carousel-item">
  <img src="image/pemandangan15.jpg" class="d-block w-100">
  <div class="carousel-caption d-none d-md-block">
    <div class="card bg-dark opacity-75">
      <div class="card-body">
        <h1 class="display-5 fw-bold text-white" style="margin-top: 20px;">Gunung Bromo</h1>
        <p class="col-md-12 fs-4 text-white">Keindahan Gunung Bromo</p>
        <button class="btn btn-primary btn-lg my-4 rounded-5" type="button">MORE DETAIL</button>
      </div>
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


<!-- paket -->
 
<div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">Cek Jadwal</h5>
           
            <form action="hasil_cari.php" method="POST">
                <div class="row align-items-end">
                 
                    <div class="col-lg-5 mb-3">
                        <label class="form-label" style="font-weight:500;">Keberangkatan</label>
                        <select name="id_asal" class="form-select shadow-none">
                            <option selected>-- Pilih Keberangkatan --</option>
                            <?php
                          
                            global $db;
                            $queryAsal = "SELECT id_asal, alamat FROM asal";
                            $resultAsal = mysqli_query($db, $queryAsal) or die(mysqli_error($db));
                            
                      
                            while ($rowAsal = mysqli_fetch_assoc($resultAsal)) {
                                echo "<option value='" . $rowAsal['id_asal'] . "'>" . $rowAsal['alamat'] . "</option>";
                            }
                          
                            ?>
                        </select>
                    </div>

                    <!-- Dropdown Destinasi Wisata -->
                    <div class="col-lg-5 mb-3">
                        <label class="form-label" style="font-weight:500;">Destinasi Wisata</label>
                        <select name="id_destinasi" class="form-select shadow-none">
                            <option selected>-- Pilih Destinasi --</option>
                            <?php
                            // Query untuk mendapatkan data dari tabel `destinasi`
                            $queryDestinasi = "SELECT id_destinasi, nama_destinasi FROM destinasi";
                            $resultDestinasi = mysqli_query($db, $queryDestinasi) or die(mysqli_error($db));
                            
                            // Tampilkan hasil dalam opsi dropdown
                            while ($rowDestinasi = mysqli_fetch_assoc($resultDestinasi)) {
                                echo "<option value='" . $rowDestinasi['id_destinasi'] . "'>" . $rowDestinasi['nama_destinasi'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Button Submit -->
                    <div class="col-lg-2 mb-lg-3 mt-2">
                        <input type="submit" class="btn btn-primary" value="Cari Jadwal" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- layanan paket -->
<?php
// Koneksi database
function sql_select() {
  global $db; // Menggunakan koneksi database yang sudah dibuat

  // Query untuk mengambil data dari tabel jadwal dengan join tabel lain
          $sql = "SELECT 
          jadwal.*, 
          kendaraan.jenis_mobil, 
          kendaraan.warna_mobil, 
          asal.alamat, 
          destinasi.nama_destinasi,
          pesan.no_kursi  
        FROM 
          jadwal 
        JOIN 
          kendaraan ON jadwal.id_mobil = kendaraan.id_mobil 
        JOIN 
          asal ON jadwal.id_asal = asal.id_asal 
        JOIN 
          destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
        JOIN 
          pesan ON jadwal.id_jadwal = pesan.id_jadwal";
  
  $result = mysqli_query($db, $sql); 
  if (!$result) {
   
      die('Query Error: ' . mysqli_error($db));
  }
  return $result; 
}
?>


<div class="container mt-5">
    <div class="row">
        <?php
        $hasil = sql_select(); // Fungsi untuk mengambil data dari database
        while ($baris = mysqli_fetch_array($hasil)) {
            ?>
            <div class="col-lg-4 col-md-6 my-3"> <!-- Hapus rounded di sini -->
                <div class="card tour-package-card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <!-- Gambar jadwal, bisa diganti sesuai dengan data dari database -->
                    <img src="image/paket1.png" class="d-block w-100" alt="Jadwal Image">
                    <div class="card-body">
                        <!-- Menampilkan kota asal dan tujuan -->
                        <h5 class="card-title mb-4"><strong><?php echo $baris['alamat']; ?> - <?php echo $baris['nama_destinasi']; ?></strong></h5>
                        <!-- Harga jadwal -->
                        <h6>Start From Rp. <?php echo number_format($baris['harga'], 0, ',', '.'); ?></h6>
                        <!-- Detail fasilitas -->
                        <div class="fasilitas mb-3">
                            <h6 class="mb-1">Fasilitas</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <?php echo $baris['jenis_mobil']; ?> (<?php echo $baris['warna_mobil']; ?>)
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Kursi Tersedia: <?php echo (5 - $baris['no_kursi']); ?> dari 5
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Perjalanan nyaman dan aman
                            </span>
                        </div>
                        <!-- Rating bintang -->
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i> <!-- Bisa dinamis berdasarkan data rating -->
                            </span>
                        </div>
                        <!-- Tombol aksi -->
                        <div class="d-flex justify-content-evenly mb-2 mt-3">
                            <?php if ($baris['no_kursi'] < 5) { ?>
                                <a href="hasil_cari.php?menu=8&id=<?php echo $baris['id_jadwal']; ?>" class="btn btn-outline-primary btn-sm rounded-5">PESAN SEKARANG</a>
                            <?php } else { ?>
                                <button class="btn btn-outline-secondary btn-sm rounded-5 disabled">KURSI PENUH</button>
                            <?php } ?>
                            <a href="detail_jadwal.php?id=<?php echo $baris['id_jadwal']; ?>" class="btn btn-outline-dark btn-sm rounded-5">MORE DETAIL</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>




      <div class="col-lg-4 col-md-6 my-3 rounded">
        <div class="card tour-package-card border-0 shadow" style="max-width: 350px; margin: auto;">
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








<div class="container">
<section id="section2" class="pt-5 mt-5">
  <div class="col-md-12 rounded">
    <div class="row g-4">
          <div class="col-sm-6 col-md-4 col-lg-3 card-group">
           <div class="card tour-package-card" style="width: 18rem;">
          <img src="image/jeep1.png" class="d-block w-100">
          <div class="card-header">Layanan Pemesanan Travel</div>
          <div class="card-body">
      <h2 class="card-title">HiAce Merah</h2>
      <p class="card-text">Start From Rp. 1.000.000</p>
      <button type="button" class="btn btn-primary btn-lg my-4 rounded-5" data-bs-toggle="modal" data-bs-target="#kritikSaranModal">
        MORE DETAIL
      </button>
    </div>
  </div>
</div>

<!-- Modal Kritik dan Saran -->
<div class="modal fade" id="kritikSaranModal" tabindex="-1" aria-labelledby="kritikSaranModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kritikSaranModalLabel">Isi Data Pemesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
          </div>

          <div class="mb-3">
          <label for="inputState" class="form-label">Asal Kabupaten</label>
            <select id="inputState" class="form-select">
              <option selected>--Pilih Asal--</option>
              <option>-- --</option>
          </div>

          <div class="mb-3">
          <label for="inputState" class="form-label">Asal Kabupaten</label>
            <select id="inputState" class="form-select">
              <option selected>--Pilih Asal--</option>
              <option>-- --</option>
          </div>
          <button type="submit" class="btn btn-primary">Pesan</button>
        </form>
      </div>
    </div>
  </div>
</div>

    


    <div class="col-sm-6 col-md-4 col-lg-3 card-group">
        <div class="card tour-package-card" style="width: 18rem;">
          <img src="image/pemandangan9.jpg" class="d-block w-100">
          <div class="card-header">Layanan Pemesanan Travel</div>
           <div class="card-body">
            <h2 class="card-title mt-2">HiAce<br>Biru</h2>
               <p class="card-text">Start From Rp. 2.000.000</p>
               <button class="btn btn-primary btn-lg my-4 rounded-5" type="button">MORE DETAIL</button>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 card-group">
        <div class="card tour-package-card" style="width: 18rem;">
          <img src="image/pemandangan10.jpg" class="d-block w-100">
          <div class="card-header">Layanan Pemesanan Travel</div>
           <div class="card-body">
            <h2 class="card-title">Hiace Hitam</h2>
               <p class="card-text">Start From Rp. 2.500.000</p>
               <button class="btn btn-primary btn-lg my-4 rounded-5" type="button">MORE DETAIL</button>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 card-group">
        <div class="card tour-package-card" style="width: 18rem;">
          <img src="image/pemandangan11.jpg" class="d-block w-100">
          <div class="card-header">Layanan Pemesanan Travel</div>
           <div class="card-body">
            <h2 class="card-title">HiAce<br>Hijau</h2>
               <p class="card-text">Start From Rp.4.000.000</p>
             <button class="btn btn-primary btn-lg my-4 rounded-5" type="button">MORE DETAIL</button>
            </div>
        </div>
    </div>
       </div>
       </div>
       </section>
    </div>


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


<h2 class="mt-5 pt-5 text-center fw-bold h-font">Fasilitas WanderLust</h2>
<div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/HiAce.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/HiAce.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/HiAce.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/HiAce.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/HiAce.jpg" width="100px;">
            <h5 class="mt-3">HiAce</h5>
        </div>   
    </div>
</div>




<!-- maps -->
  <div class="container mt-5 pt-5">
  <div class="row">
    <section id="section3" class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5><strong>Denah Wilayah Taman Nasional Bromo</strong></h5>
        </div>
        <div class="card-body">
          <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=112.67372131347658%2C-8.24207140288243%2C113.19419860839845%2C-7.834812882712155&amp;layer=mapnik"
            class="w-100" style="height: 200px; border: none;"></iframe>
          <p class="mt-3 text-center">
            <a href="https://www.openstreetmap.org/#map=11/-8.0385/112.9340">View Larger Map</a>
          </p>
        </div>
      </div>
    </section>

    <!-- Form Kritik dan Saran di sebelah peta -->
    <div class="col-md-6 mb-3">
      <div class="card">
        <div class="card-header">
          <h5><strong>Form Kritik dan Saran</strong></h5>
        </div>
        <div class="card-body">
          <form>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Masukkan Email">
            </div>
            <div class="mb-3">
              <label for="kritikSaran" class="form-label">Kritik dan Saran</label>
              <textarea class="form-control" id="kritikSaran" rows="3" placeholder="Masukkan Kritik dan Saran Anda"></textarea>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Kirim</button>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kritikSaranModal">
              View
              </button>

              <div class="modal fade" id="kritikSaranModal" tabindex="-1" aria-labelledby="kritikSaranModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
          <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kritikSaranModalLabel">Form Kritik dan Saran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form Kritik dan Saran -->
        <form>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Masukkan Email">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Kritik dan Saran</label>
            <textarea class="form-control" id="kritikSaran" rows="3" placeholder="Masukkan Kritik dan Saran Anda"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

  </main>

  <footer class="bg-dark text-white mt-5 pt-5 pb-2 py-2">
  <div class="container text-center">
    <div class="row">
      <div class="col-md-12">
        <h5>Anda Juga Bisa Menghubungi Kami</h5>
        <p class="mb-1">
          <a href="mailto:your-email@gmail.com" class="text-white me-3">
            <i class="fas fa-envelope"></i> Gmail
          </a>
          <a href="https://www.instagram.com/fadillahiqbal._/?hl=en" target="_blank" class="text-white me-3">
            <i class="fab fa-instagram"></i> Lastico
          </a>
          <a href="https://www.instagram.com/fadillahiqbal._/?hl=en" target="_blank" class="text-white me-3">
            <i class="fab fa-instagram"></i> Fadillah Iqbal
          </a>
          <div class="card-text"><p>Anda bisa menghubungi saya</p></div>
          <a href="https://www.instagram.com/fadillahiqbal._/?hl=en" target="_blank" class="text-white me-3">
            <i class="fab fa-instagram"></i> Valia
          </a>
          <a href="https://www.instagram.com/fadillahiqbal._/?hl=en" target="_blank" class="text-white me-3">
            <i class="fab fa-instagram"></i> Nisrina
          </a>
          
          <a>
            <i class="fab fa-whatsapp"></i> WhatsApp
          </a>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p class="mt-3">
          <small>&copy; 2024 WanderLust. "Bromo Lebih Dekat, Perjalanan Lebih Nyaman"</small>
        </p>
      </div>
    </div>
  </div>
</footer>

        <!-- Popper.js and Bootstrap Bundle -->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
></script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    </body>
</html>
