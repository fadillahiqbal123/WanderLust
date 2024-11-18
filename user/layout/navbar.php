<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

$timeout_duration = 9000;

if (empty($_SESSION['email']) && empty($_SESSION['password'])) {
    echo '
    <br><br><br><br><br><br><br><br>
    <center>
    <b>Maaf, silahkan login kembali</b><br>
    <b>Anda sudah keluar dari sistem</b><br>
    <b>atau anda belum melakukan login</b><br>
    <a href="homepage.php" title="Klik Gambar ini untuk kembali ke Halaman Login">
      <img src="image/key1.png" height="100" width="100">
    </a>
    </center>';
    exit();
} 

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    echo "<script>alert('Sesi Anda Telah Berakhir Karena Tidak Ada Aktivitas');
     window.location = 'homepage.php';</script>";
    exit();
}

$_SESSION['last_activity'] = time();
?>

<header>
<nav class="navbar navbar-expand-lg navbar-ligth bg-white align-items-center fixed-top px-lg-3 py-lg-2 shadow-sm styicky-top">
           <div class="container">

           <a class="navbar-brand me-auto" href="#page-top">
            <img src="image/lofo_wanderlust1.png" height="60px;" style="vertical-align: middle;">
        </a>

          <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="#navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active js-scroll-trigger text-dark" aria-current="page" href="dashboard.php"><strong>Home</strong></a>
              </li>

              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              <li class="nav-item">
                <a class="nav-link me-2 js-scroll-trigger text-dark" href="jadwal.php"><strong>Lihat Jadwal</strong></a>
              </li>

              <span class="text-dark mx-2 d-flex align-items-center">|</span>
              <li class="nav-item">
                <a class="nav-link me-2 js-scroll-trigger text-dark" href="fasilitas.php"><strong>Fasilitas</strong></a>
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

            <li class="nav-item dropdown">
            <button type="button" class="btn btn-light text-align-center" data-bs-toggle="modal" data-bs-target="#profileModal">
            <i class="bi bi-gear-fill"></i> Buka Profile
            </button>
            </li>

            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
          </ul>
        </li> 
        
              </ul>
            </div>
          </div>
        </nav>

           
        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Nama: <span><?php echo $_SESSION['nama_user']; ?></span></p>
                <p>Email: <span><?php echo $_SESSION['email']; ?></span></p>
                <p>Username: <span><?php echo $_SESSION['username']; ?></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</header>
