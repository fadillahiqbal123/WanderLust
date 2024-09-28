<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
       
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
             rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            body {
            background-image: url("image/pict.jpg"); /* Pastikan path ini benar */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center; 
            align-items: center; 
                }
                
           .carousel-item img {
               height: 400px;
               object-fit: cover;
               width: 100%;
            }
            .container {
            max-width: 100%;
            padding: 0;
            }   
        </style>
    </head>

    <body>
        <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top" style=" height:90px">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="image/logo_wanderlust.png" style="height: 90px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav justify-content-center mb-2 mb-lg-0 w-100">
        <li class="nav-item mx-3">
          <a class="nav-link" aria-current="page" href="homepage,php">Home</a>
          <li class="nav-item  mx-4">
          <a class="nav-link" href="#">Profil</a>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link" href="#">Berita</a>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link" href="#">Pemesanan</a>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link" href="#">About Bromo</a>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link" href="#">Kontak</a>
        </li>
        <div class="row mx-4">
        <li class="dropdown d-flex nav-item text-end">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
            User
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">User</a></li>
            <li><a class="dropdown-item" href="#">Setting</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
          </li>
          </div>
          </div>
      </ul>
    
    </div>
  </div>
        </header>
        <main>
          <div class="row">
            <div class="col">
        <div class="container pt-5"> 
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-inner">
                <div class="carousel-item active mt-10">
                    <img src="image/bromo4.jpg" class="d-block img-fluid" alt="Gunung Bromo"
                        data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this.src)">
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
        </div>
        </div>
        </main>
        <footer>
          
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
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
