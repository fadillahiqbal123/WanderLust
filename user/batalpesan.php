<!doctype html>
<html lang="en">
    <head>
        <title>Bata Pesan</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

    </head>

    <body>
        <header>
            <?php 
                include "layout/navbar.php";
            ?>
        </header>



        <main class="min-height: 100vh padding-top: 80px;">



         <div class="container-fluid">
            <div class="row mt-5 pt-5">
                <div class="panel panel-default" style="color:black">
                    <div class="panel-header text-center mt-3 pt-3 fw-bold h-font">
                        Konfirmasi Batal Pesan
                    </div>
                    <div class="panel-body">
                        <?php 
                        include "koneksi.php";
                            $idj = $_GET['idp'];

                            $sql = mysqli_query($db,"SELECT * FROM pesan, jadwal, asal, destinasi, user WHERE 
                                                                                 pesan.id_jadwal = jadwal.id_jadwal AND
                                                                                 pesan.id_user = user.id_user AND
                                                                                 jadwal.id_asal = asal.id_asal AND
                                                                                 jadwal.id_destinasi = destinasi.id_destinasi AND
                                                                                 id_pesan='$idj'");

                            if ($sql && mysqli_num_rows($sql) > 0) {
                                while ($row = mysqli_fetch_array($sql)) {

                            
                        ?>
                       <form class="form-control" action="batal.php?i=<?php echo $row['id_pesan']; ?>" method="POST">
                            <div class="col-md-5 mb-3">
                                <p>ID Pesan :<span><?php echo $row['id_pesan'] ?></span></p>
                                <p>Alamat : <span><?php echo $row['alamat'] ?></span></p>
                                <p>Tujuan Destinasi : <span><?php echo $row['nama_destinasi'] ?></span></p>
                                <p>Tanggal Berangkat : <span><?php echo $row['tgl_berangkat'] ?></span></p>
                                <p>Total Bayar : <span><?php echo $row['harga'] ?></span></p>
                                <p>Status Bayar : <div class="alert alert-danger" role="alert"><?php echo $row['status'] ?></div> </p>
                                
                                <input type="submit" name="action" value="Ya" class="btn btn-warning">


                                <a class="btn btn-danger" onclick=self.history.back() > TIDAK</a>
                            </div>
                            </form>
                            

                            <?php 

                            }
                        }else{
                            echo "<p>Data Tidak Ditemukan. </p>";
                        }
                            

                            ?>
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
