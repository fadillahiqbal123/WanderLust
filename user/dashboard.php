<!-- selanjutnya adalah tambah gambar dan komponen lain, saya berifir untuk memprioritaskan crud yang simple
namun tetap bekerja dengan baik, Bismillah Semoga Bisa Gusti Allah Menyertai ku -->
<?php
  session_start();
  date_default_timezone_set('Asia/Jakarta');

  $timeout_duration = 9000;

   if(empty($_SESSION['email']) and empty($_SESSION['password'])) {
    echo'
    <br><br><br><br><br><br><br><br>
    <center>
    <b>Maaf, silahkan login kembali</b><br>
    <b>Anda sudah keluar dari sistem</b><br>
    <b>atau anda belum melakukan login</b><br>

    <a href="homepage.php" title="Klik Gambar ini untuk kembali ke Halaman Login"><img src="image/key1.png" height="100" width="100"></img></a>
    </center> 
    ';
   }else{
    $db = new mysqli("localhost", "root", "", "db_wisata");

    if ($db->connect_error) {
        die("Koneksi gagal: " . $db->connect_error);
    }

    $sql = "SELECT DISTINCT judul_berita, tgl_berita, konten_berita, foto_berita FROM berita";
    $result = $db->query($sql);
   
    ?>


<?php 
if(isset($_SESSION['last_activty']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    echo "<script>alert('Sesi Anda Telah Berakhir Karena Tidak Ada Aktivitas');
     window.location = 'homepage.php'</script>";
     exit();
}

$_SESSION['last_activity'] = time();
?>


  
    

<!doctype html>
<html lang="en">
    <head>
    <title>WanderLust</title>
    <link rel="icon" href="image/lofo_wanderlust1.png" type="image/png">
       
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
             rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <!-- sweetalert -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
            
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
             
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
          <div class="collapse navbar-collapse" id="#navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active me-2 js-scroll-trigger text-dark" aria-current="page" href="#section1"><strong>Home</strong></a>
              </li>

              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              <li class="nav-item">
                <a class="nav-link me-2 js-scroll-trigger text-dark" href="jadwal.php"><strong>Lihat Jadwal</strong></a>
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
                <a class="nav-link me-2 active js-scroll-trigger text-dark" href="cekstatus.php"><strong>Cek Status Bayar</strong></a>
              </li>
              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              <a class="nav-link me-2 active js-scroll-trigger text-dark" href="about.php"><strong>About</strong></a>
              </li>
              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              
              
            
              <li class="nav-item dropdown">
          <button class="nav-link dropdown-toggle bg-primary text-light rounded" href="#" role="button" data-bs-toggle="dropdown">
           <strong>User</strong>
         </button>
          <ul class="dropdown-menu">
          <li>
    <a class="dropdown-item" role="button">
        <i class="fa-solid fa-user"></i>
        <span class="username"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Apa'; ?></span>
    </a>
</li>
            <small><p class="dropdown-item text-center"><i class="bi bi-clock-fill"></i> Pkl <?php echo date('H:i:s')?> WIB</l></small>
            <li><a class="dropdown-item" href="setting.php"><i class="bi bi-gear-fill"></i> Setting</a></li>
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
  <img src="image/pemandangan14.png" class="d-block w-100">
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
<div class="carousel-item">
  <img src="image/pemandangan16.jpg" class="d-block w-100">
  <div class="carousel-caption d-none d-md-block">
    <div class="card bg-dark opacity-75">
      <div class="card-body">
        <h1 class="display-5 fw-bold text-white" style="margin-top: 20px;">Gunung Gentong</h1>
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


<div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">Cek Jadwal</h5>
           
            <form action="hasil_cari.php" method="POST">
                <div class="row align-items-end">
                 
                    <div class="form-group col-md-4 mb-3">
                        <label class="form-label" style="font-weight:500;">Keberangkatan</label>
                        <select name="cari_asal" class="form-select shadow-none" required>
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
                    <div class="form-group col-md-4 mb-3">
                        <label class="form-label" style="font-weight:500;">Destinasi Wisata</label>
                        <select name="cari_destinasi" class="form-select shadow-none" required>
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

                    <div class="form-group col-md-3 mb-3">
                      <label for="date" class="form-label" style="font-weight: 500;">Pilih Tanggal</label>
                      <input type="date" class="form-control shadow-none" name="caritgl" required>
                    </div>

                    <!-- Button Submit -->
                    <div class="col-sm-1 mb-lg-3 mt-2">
                        <input type="submit" class="btn btn-primary" value="Cari"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php

function sql_select() {
  global $db;

          $sql = "SELECT DISTINCT 
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
                  
                    <img src="image/paket1.png" class="d-block w-100" alt="Jadwal Image">
                    <div class="card-body">
                        
                        <h5 class="card-title mb-4"><strong><?php echo $baris['alamat']; ?> - <?php echo $baris['nama_destinasi']; ?></strong></h5>
                        
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
                                <i class="bi bi-star text-warning"></i> 
                            </span>
                        </div>
                        <!-- Tombol aksi -->
                        <div class="d-flex justify-content-evenly mb-2 mt-3">
                            <?php if ($baris['no_kursi'] < 5) { ?>
                                <a href="hasil_cari.php?&id=<?php echo $baris['id_jadwal']; ?>" class="btn btn-outline-primary btn-sm rounded-5">PESAN SEKARANG</a>
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








<!-- layanan biasa -->
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
            <img src="image/point.jpg" width="100px;">
            <h5 class="mt-3">Penjumputan Sesuai Titik</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/picture.jpg" width="100px;">
            <h5 class="mt-3">Dokumentasi Di Setiap Moment</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/keamanan.jpg" width="100px;">
            <h5 class="mt-3">Keamanan</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/kenyamanan.jpg" width="100px;">
            <h5 class="mt-3">Kenyamanan</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center rounded bg-white shadow py-4 my-4">
            <img src="image/driver.jpg" width="100px;">
            <h5 class="mt-3">Driver Berpengalaman</h5>
        </div>   
    </div>
</div>


    <h5 class="mt-5 pt-5 text-center fw-bold h-font">Reach Us</h5>
  <div class="container mt-5 mb-5">
  <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-4 bg-white rounded">
      <iframe class="w-100 rounded" height="350" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63224.15076365207!2d112.93910754647912!3d-7.946191125724633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd637aaab794a41%3A0xada40d36ecd2a5dd!2sGn.%20Bromo!5e0!3m2!1sid!2sid!4v1730612238451!5m2!1sid!2sid" loading="lazy"></iframe>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="bg-white p-4 rounded mb-4 shadow">
            <h5>Call Us</h5>
            <a href="tel: +62875849258758" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> +6285849258758
            </a>
            <br>
            <a href="tel: +62875849258758" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-whatsapp"></i> +6285849258758
            </a>
          </div>
          <div class="bg-white p-4 rounded mb-4 shadow">
            <h5>Follow Us</h5>
            <a href="#" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6">
              <i class="bi bi-twitter me-1"></i> Twitter
              </span>
            </a>
            <br>
            <a href="#" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6">
              <i class="bi bi-instagram me-1"></i> Instagram
              </span>
            </a>
            <br>
            <a href="#" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6">
              <i class="bi bi-youtube me-1"></i> Youtube
              </span>
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kritikSaranModal">
              Kirim Kritik dan Saran
        </button>

<!-- Modal -->
          <div class="modal fade" id="kritikSaranModal" tabindex="-1" aria-labelledby="kritikSaranModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="kritikSaranModalLabel">Form Kritik dan Saran</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="simpan_kritik.php"> <!-- Ubah action ke file PHP untuk menyimpan data -->
                    <div class="form-group mb-3">
                    <div class=" mb-3">
                      <label for="judulSaran" class="form-label">Judul Saran</label>
                      <input type="text" class="form-control" id="judulSaran" name="judul_saran" placeholder="Masukkan Judul Saran Anda" required>
                    </div>
                    <div class="mb-3">
                      <label for="kritikSaran" class="form-label">Detail Saran</label>
                      <textarea class="form-control" id="kritikSaran" name="detail_saran" rows="3" placeholder="Masukkan Kritik dan Saran Anda" required></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LfGAXgqAAAAAO2v15eo4Qr2oynpK8y9gGf0vnqE"></div>
                    <br/>
                    <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        </div>
        </div>
  

    <!-- Form Kritik dan Saran di sebelah peta -->
  
  

<!-- Modal -->
<!-- <div class="modal fade" id="kritikSaranModal" tabindex="-1" aria-labelledby="kritikSaranModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kritikSaranModalLabel">Form Kritik dan Saran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="simpan_kritik.php">  Ubah action ke file PHP untuk menyimpan data -->
          <!-- <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
          </div>
          <div class="mb-3">
            <label for="judulSaran" class="form-label">Judul Saran</label>
            <input type="text" class="form-control" name="judul_saran" placeholder="Masukkan Judul Saran Anda" required>
          </div>
          <div class="mb-3">
            <label for="kritikSaran" class="form-label">Detail Saran</label>
            <textarea class="form-control"  name="detail_saran" rows="3" placeholder="Masukkan Kritik dan Saran Anda" required></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div> -->

  </main>

  <footer>
  <div class="container-fluid bg-light mt-5">
    <div class="row">
      <div class="col-md-4">
       <h3 class="fs-3 h-font fw-bold mb-2">WanderLust</h3>
          <p class="mt-3">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
            Unde incidunt possimus in magnam necessitatibus, 
            deleniti omnis exercitationem, 
            eveniet voluptatem, aperiam aspernatur architecto tempore enim? Fuga ad magni sed maiores dicta.
          </p>
       
      </div>
      <div class="col-md-4">
          <h3 class="mb-3">Links</h3>
          <a href="#" class="d-inline-block text-dark text-decoration-none">Home</a>
          <br>
          <a href="#" class="d-inline-block text-dark text-decoration-none">Lihat Jadwal</a>
          <br>
          <a href="#" class="d-inline-block text-dark text-decoration-none">Fasilitas</a>
          <br>
          <a href="#" class="d-inline-block text-dark text-decoration-none">Cek Status Bayar</a>
          <br>
          <a href="#" class="d-inline-block text-dark text-decoration-none">About</a>
          <br>
          <a href="#" class="d-inline-block text-dark text-decoration-none">User</a>
      </div>
      <div class="col-md-4">
      <h3 class="mb-3">Follow Us</h3>
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">     
      <i class="fas fa-envelope"></i> Gmail
      </a>
      <br>
      <a href="https://www.instagram.com/fadillahiqbal._/?hl=en" class="d-inline-block text-dark text-decoration-none mb-2">
          <i class="fab fa-instagram"></i> @fadillahiqbal_
      </a>
      <br>
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">     
      <i class="bi bi-twitter"></i> Twitter
      </a>
      <br>
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">     
      <i class="bi bi-youtube"></i> Youtube
      </a>
        </div>
    </div>
    
    <!-- <div class="row">
      <div class="col-md-12">
        <p class="mt-3">
          <small>&copy; 2024 WanderLust. "Bromo Lebih Dekat, Perjalanan Lebih Nyaman"</small>
        </p>
      </div>
    </div> -->
  </div>
  <h6 class="text-white bg-dark p-3 m-0 text-center">Designed By WanderLust Team</h6>


</footer>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"
        ></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></scrip>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
<?php 
   }
?>