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
                <a class="nav-link active me-2 js-scroll-trigger text-dark" aria-current="page" href="dashboard.php"><strong>Home</strong></a>
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