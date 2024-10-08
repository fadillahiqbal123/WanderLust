<!-- selanjutnya adalah tambah gambar dan komponen lain, saya berifir untuk memprioritaskan crud yang simple
namun tetap bekerja dengan baik, Bismillah Semoga Bisa Gusti Allah Menyertai ku -->


<!doctype html>
<html lang="en">
    <head>
        <title>User WanderLust:</title>
       
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
             rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
           <link rel="stylesheet" href="css/style.css">
    </head>

    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-ligth bg-transparent fixed-top" id="mainNav">
           <div class="container">
          <a class="navbar-brand" href="page-top"><img src="image/lofo_wanderlust1.png" height="60px";></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" aria-current="page" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="#login">login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="#register">Registrasi</a>
               </li>
               <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="#berita">Berita</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger text-white" href="#hubungi_kami">Hubungi Kami</a>
              </li> 
              </ul>
            </div>
          </div>
        </nav>

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

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/jeep1.png " class="d-block w-100">
      <div class="carousel-caption d-none d-md-block">
      <h1 class="display-5 fw-bold text-white" style="margin-top: 80px;">Pura Luhur Poten<br><span class="font-weight-bold">With WanderLust</span></h1>
            <hr class="my-4" style="border-color: blue; width: 100px; border-width:5px; margin: 0 auto;">
            <p class="col-md-12 fs-2 text-white lead">Keindahan Budaya dan Agama Akan Nampak Disini</p>
            <button class="btn btn-warning btn-lg my-4 rounded-5" type="button">MORE DETAIL</button>
      </div>
    </div>
    <div class="carousel-item">
      <img src="image/pemandangan7.jpg" class="d-block w-100" alt="#">
      <div class="carousel-caption d-none d-md-block">
      <h1 class="display-5 fw-bold text-white" style="margin-top: 80px;">Gunung Bromo<br><span class="font-weight-bold">With WanderLust</span></h1>
            <hr class="my-4" style="border-color: blue; width: 100px; border-width:5px; margin: 0 auto;">
            <p class="col-md-12 fs-2 text-white lead">Keindahan Gunung Bromo</p>
            <button class="btn btn-warning btn-lg my-4 rounded-5" type="button">MORE DETAIL</button>
      </div>
    </div>
    <div class="carousel-item">
      <img src="image/pemandangan8.jpg" class="d-block w-100" alt="#">
      <div class="carousel-caption d-none d-md-block">
      <h1 class="display-5 fw-bold text-white" style="margin-top: 80px;">Gunung Bromo<br><span class="font-weight-bold">With WanderLust</span></h1>
      <hr class="my-4" style="border-color: blue; width: 100px; border-width:5px; margin: 0 auto;">
            <p class="col-md-12 fs-2 text-white lead">Paket Murah Dan Bersaing</p>
            <button class="btn btn-warning btn-lg my-4 rounded-5" type="button">MORE DETAIL</button>
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
</div>


<div class="map-container my-5">
  <iframe width="50%" height="250" 
    src="https://www.openstreetmap.org/export/embed.html?bbox=112.67372131347658%2C-8.24207140288243%2C113.19419860839845%2C-7.834812882712155&amp;layer=mapnik" 
    style="border: 1px solid black"></iframe>
  <br/>
  <small><a href="https://www.openstreetmap.org/#map=11/-8.0385/112.9340">View Larger Map</a></small>
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
    </body>
</html>
