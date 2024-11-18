<?php

include "koneksi.php";
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
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
    </head>

    <body>
        <header>
          <?php include "layout/navbar.php"; ?>
        </header>

        <main class="min-height: 100vh; padding-top: 90px;">
            <?php 
                 $idj = $_GET['idp'];
                 $query1 = "select * from pesan where id_pesan= ".$idj;
                   
                $result=mysqli_query($db,$query1) or die(mysql_error());
                while($row=mysqli_fetch_object($result))
                   {
            ?>
        <?php
        if (isset($_GET['idp'])) {
            $id_pesan = intval($_GET['idp']);
        
            $query = "
                SELECT 
                    pesan.id_pesan, 
                    jadwal.tgl_berangkat, 
                    asal.alamat AS kota_asal, 
                    destinasi.nama_destinasi AS kota_tujuan, 
                    pesan.status, 
                    jadwal.harga 
                FROM 
                    pesan 
                JOIN 
                    jadwal ON pesan.id_jadwal = jadwal.id_jadwal 
                JOIN 
                    asal ON jadwal.id_asal = asal.id_asal 
                JOIN 
                    destinasi ON jadwal.id_destinasi = destinasi.id_destinasi 
                WHERE 
                    pesan.id_pesan = $id_pesan";
            
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $row = mysqli_fetch_object($result);
        ?>


        <h3 class="text-center fw-bold h-font mt-5 pt-5">Konfirmasi Pembayaran Anda</h3>
            <div class="container mt-3 pt-3 mb-3">
                <div class="row">
                <form class="form-control" action="prosespembayaran.php?idp=<?php echo $id_pesan; ?>" method="post">
                    
                    <p>ID Pesan: <strong><?php echo $row->id_pesan; ?></strong></p>
                    <p>Kota Asal: <strong><?php echo $row->kota_asal; ?></strong></p>
                    <p>Kota Tujuan: <strong><?php echo $row->kota_tujuan; ?></strong></p>
                    <p>Tanggal Berangkat: <strong><?php echo date('d-M-Y', strtotime($row->tgl_berangkat)); ?></strong></p>
                    <p>Total Bayar: <strong><?php echo $row->harga; ?></strong></p>

                    <div class="col-md-5 mb-3">
                        <label class="form-label">ID Pesan</label>
                        <input class="form-control" type="text hidden" name="id_pesan" value="<?php echo $row->id_pesan; ?>" readonly>
                    </div>
                   
                    <div class="col-md-5 mb-3">
                        <label for="no_resi" class="form-label">Nomor Resi</label>
                        <input type="text" name="no_resi" class="form-control" required>
                    </div>

                  
                    <div class="col-md-5 mb-3">
                        <label for="tgl_transfer" class="form-label">Tanggal Transfer</label>
                        <input type="date" name="tgl_transfer" class="form-control" required>
                    </div>

                    
                    <div class="col-md-5 mb-3">
                        <label for="jam_transfer" class="form-label">Jam Transfer</label>
                        <input type="time" name="jam_transfer" class="form-control" required>
                    </div>

                   
                    <div class="col-md-5 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" name="status" class="form-control" value="Dalam Proses" readonly>
                    </div>

                    <div class="d-flex">
                    <p class="me-2"><input type="submit" name="action" value="Simpan" class="btn mb-3 btn-success"></p>
                    <p><a href="cekstatus.php" name="submit" class="btn btn-warning">Kembali</a></p>
                    </div>
                </form>
                </div>
            </div>
        <?php
        }
    }
        ?>
            
        </main>
        <footer>
            <?php include "layout/footer.php"; ?>
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>
