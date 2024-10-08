<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Wisata Bromo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top" style=" height:90px">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="image/logo_wanderlust.png" style="height: 90px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav justify-content-center mb-2 mb-lg-0 w-100">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Kritik Saran</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
            User
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">History</a></li>
            <li><a class="dropdown-item" href="#">Berita</a></li>
            <li><a class="dropdown-item" href="#">Rating</a></li>
            <li><a class="dropdown-item" href="#">Pesan Tiket</li>
            <li><a class="dropdown-item" href="#">About Bromo</a></li>
          
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pesan Tiket</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-warning" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
        </header>

    <!-- Konten Utama -->
    <div class="container pt-5"> 
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-inner">
                <div class="carousel-item active mt-10">
                    <img src="image/pict.jpg" class="d-block img-fluid" alt="Gunung Bromo"
                        data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this.src)" style="height: 700px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Gunung Bromo</h5>
                        <h6>Keindahan alam yang menakjubkan di Jawa Timur.</h6>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images4.alphacoders.com/104/thumb-1920-1046944.jpg" class="d-block img-fluid"
                        alt="Sunrise Bromo" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this.src)">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Sunrise Bromo</h5>
                        <h6>Menikmati matahari terbit dari Bromo</h6>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

      
        <div class="my-5">
            <h2>Tentang WanderLust</h2>
            <p>
                WanderLust adalah penyediaan jasa travel khusus untuk warga Kota Jember yang ingin melakukan perjalanan ke
                destinasi wisata Bromo dengan mudah dan praktis.
                Wanderlust dapat membuat anda hanya membayar satu kali saja dan tidak perlu sulit untuk melakukan perjalanan
                ke Bromo.
                Dengan WanderLust anda hanya perlu sekali membayar dan menikmati liburan anda dari penjemputan hingga diantar
                pulang kembali.
            </p>
        </div>

        
        <div class="my-5">
            <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="image/jeepbromo.png" class="d-block img-fluid" alt="Jeeps Bromo"
                            data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this.src)">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>WandeLust</h5>
                            <h6>Jasa Penyewaan Jeep WandeLust</h6>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="image/pengalaman_wisata_bromo.png" class="d-block img-fluid" alt="Fotografer Bromo"
                            data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this.src)">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>WandeLust</h5>
                            <h6>Jasa Fotografer WandeLust</h6>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

       
        <div class="my-5">
            <h2>Wisata Bromo</h2>
            <p>Gunung Bromo adalah salah satu gunung berapi yang paling terkenal di Indonesia. Terletak di Jawa Timur, Bromo
                menawarkan pemandangan yang spektakuler, terutama saat matahari terbit.</p>
            <h3>Aktivitas Menarik</h3>
            <ul>
                <li>Trekking ke puncak Bromo</li>
                <li>Menikmati sunrise di viewpoint</li>
                <li>Mengunjungi Pasir Berbisik</li>
                <li>Menjelajahi kawah Bromo</li>
            </ul>
        </div>

       
        <div class="py-5">
            <h3>Galeri</h3>
            <div class="row gallery">
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="https://javaadventuretrail.com/wp-content/uploads/2015/11/mount-bromo-tour.jpg"
                        class="img-fluid rounded shadow" alt="Sunrise Bromo" data-bs-toggle="modal"
                        data-bs-target="#imageModal" onclick="showImage(this.src)">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="https://www.letsescapetogether.com/wp-content/uploads/2022/10/MountBromosunriseslider-2.jpg"
                        class="img-fluid rounded shadow" alt="Sunrise Bromo" data-bs-toggle="modal"
                        data-bs-target="#imageModal" onclick="showImage(this.src)">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="https://www.indonesia.travel/content/dam/indtravelrevamp/en/destinations/revision-2019/all-revision-destination/bromo22.jpg"
                        class="img-fluid rounded shadow" alt="Bromo" data-bs-toggle="modal"
                        data-bs-target="#imageModal" onclick="showImage(this.src)">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="https://4.bp.blogspot.com/-IGG1EW39MTA/VkAx8tll1jI/AAAAAAAABmY/IaZJbFFjXMoq5sSEt0TqWGcntmcyg2Wdw/s1600/kawah_bromo.jpg"
                        class="img-fluid rounded shadow" alt="Kawah Bromo" data-bs-toggle="modal"
                        data-bs-target="#imageModal" onclick="showImage(this.src)">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img src="https://melampa.com/wp-content/uploads/2019/09/Bromo-Jeep-Tour-Melampa-Tour-Indonesia.jpg"
                        class="img-fluid rounded shadow" alt="Jeep Tour Bromo" data-bs-toggle="modal"
                        data-bs-target="#imageModal" onclick="showImage(this.src)">
                </div>
            </div>
        </div>
    </div>

 
    <footer class="footer">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-md-4 col-sm-12 text-center mb-4">
                    <h3>Pembuat</h3>
                    <p>
                        Kelompok 2 <br>
                        Teknik Informatika Golongan Internasional 2023 <br>
                        Politeknik Negeri Jember
                    </p>
                </div>
                <div class="col-md-4 col-sm-12 text-center mb-4">
                    <h3>Follow Us</h3>
                    <ul class="list-unstyled">
                        <li><a href="https://www.instagram.com/lasticoo" class="footer-link">Instagram Wanderlust</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-12 text-center mb-4">
                    <h3>Developer Team</h3>
                    <ul class="list-unstyled">
                        <li><a href="https://www.instagram.com/lasticoo" class="footer-link">Lastico Ridho Alparesz</a></li>
                        <li><a href="#" class="footer-link">Muhammad Fadillah Iqbal Arianto</a></li>
                        <li><a href="#" class="footer-link">Syausan Nouvalia Barozat</a></li>
                        <li><a href="#" class="footer-link">Nisrina Azhari Jinan</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center bg-light py-3">
            &copy; 2024 <strong>WandeLust</strong>. All Rights Reserved.
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">WandeLust</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid" alt="Gambar Besar">
                </div>
            </div>
        </div>
    </div>

    

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/nav.js"></script>
    <script src="js/image.js"></script>
</body>

</html>