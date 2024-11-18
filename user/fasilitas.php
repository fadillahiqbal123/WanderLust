<?php 

?>


<!doctype html>
<html lang="en">
    <head>
        <title>Fasilitas</title>
       
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
            <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
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
           
            <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
        <style>
                main{
                    min-height: 100vh;
                    padding: 50px;
                    padding-top: 80px; 
                    flex-grow: 1;
                }

                .h-line{
                    width: 150px;
                    margin: 0 auto;
                    height: 1.7px;
                }

                .pop:hover{
                    border-top-color: #28a745;
                    transform: scale();
                    transition: all 0.3s;
                }

           
            </style>
    </head>

    <body>
        <header>
        <?php  
            include "layout/navbar.php";

?>
        </header>



        <main>


            <div class="my-3">
                <h2 class="fw-bold h-font text-center">Fasilitas</h2>
                <div class="h-line bg-dark"></div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="d-flex text-align-center">
                            <img src="image/point.jpg" width="40px">
                            <h5 class="m-0 ms-3">Penjemputan</h5>
                        </div>
                            <p>
                            Tak perlu khawatir dalam perjalanan anda menuju point meet hingga destinasi wisata. 
                            Kami menyediakan jasa antar jemput dari titik keberangkatan anda.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="d-flex text-align-center">
                            <img src="image/picture.jpg" width="40px">
                            <h5 class="m-0 ms-3">Dokumentasi Di Setiap Moment</h5>
                        </div>
                            <p>
                            Kami menyediakan fasilitas dokumentasi ekslusif  yang dapat 
                            mengabadikan setiap momen dalam perjalanan anda
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="d-flex text-align-center">
                            <img src="image/keamanan.jpg" width="40px">
                            <h5 class="m-0 ms-3">Asuransi Keselamatan</h5>
                        </div>
                            <p>
                            Jaminan keselamatan di setiap perjalanan anda 
                            dengan adanya asuransi terpercaya dari pihak travel.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="d-flex text-align-center">
                            <img src="image/kenyamanan.jpg" width="40px">
                            <h5 class="m-0 ms-3">Kenyamanan</h5>
                        </div>
                            <p>
                            Kami selalu ada untuk memenuhi di setiap kebutuhan anda , tak perlu khawatir untuk fasilitas dan kemyamanan dalam perjalanan anda
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="d-flex text-align-center">
                            <img src="image/driver.jpg" width="40px">
                            <h5 class="m-0 ms-3">Supir Berpengalaman</h5>
                        </div>
                            <p>
                            Kami menyediakan supir yang berpengalaman lebih dari 10 tahun dan bersurat lengkap yang bekerja sama dengan kami dalam pengantar jemputan trip Bromo.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                



        </main>



        <footer>
            <?php 
                include "layout/footer.php";
            ?>
        </footer>
       
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"
        ></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
