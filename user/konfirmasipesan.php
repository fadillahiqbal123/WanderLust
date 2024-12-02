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

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- sweetalert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- google font -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300..900&display=swap" rel="stylesheet">
        <style>
            main {
                flex: 1;
                padding-top: 30px; 
                padding-bottom: 40px; 
                min-height: calc(100vh - 120px);
            }
            html, body {
                margin: 0;
                display: flex;
                flex-direction: column;
            }
        </style>
    </head>

    <body>
        <header>
            <?php include "layout/navbar.php"; ?>
        </header>

        <main>
            <?php
                $id_jadwal = intval($_GET['i']); // Menggunakan intval untuk menghindari SQL Injection
                $query = "
                    SELECT 
                        pesan.id_pesan, 
                        jadwal.tgl_berangkat, 
                        asal.alamat, 
                        destinasi.nama_destinasi, 
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
                        pesan.id_jadwal = $id_jadwal
                    ORDER BY 
                        pesan.id_pesan DESC
                    LIMIT 1";

                $result = mysqli_query($db, $query) or die(mysqli_error($db));

                $row = mysqli_fetch_object($result);
                if ($row) {
            ?>
                    <div class="container mt-3">
                        <div class="mb-4 panel panel-default" style="color:black;">
                            <div class="text-center fw-bold fs-40 h-font panel-body">KONFIRMARSI PESANAN</div>
                        </div>
                        <form class="form-control" action="konfirmasipembayaran.php?idp=<?php echo $row->id_pesan; ?>" method="post">
                            <div class="panel panel-primary">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="#">
                                            <img class="media-object" src="image/mandiri.jpg" style="width:100px; height:auto;" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <p>Atas Nama : Fadillah Iqbal<br>
                                           Nomor Rek. : 0362726393</p>
                                    </div>
                                </div>
                                <div class="panel-body" style="color:black;">
                                    <div class="col-md-5">
                                        <p>ID Pesan: <span><?php echo $row->id_pesan; ?></span></p>
                                        <p>Kota Asal: <span><?php echo $row->alamat; ?></span></p>
                                        <p>Kota Tujuan: <span><?php echo $row->nama_destinasi; ?></span></p>
                                        <p>Tanggal Berangkat: <span><?php echo date('d-m-Y', strtotime($row->tgl_berangkat)); ?></span></p>
                                        <p>Total Bayar: <span><?php echo $row->harga; ?></span></p>
                                        <p>Status Bayar: 
                                            <div class="alert <?php echo $row->status == 'Belum Bayar' ? 'alert-danger' : 'alert-success'; ?>" role="alert">
                                                <?php echo $row->status; ?>
                                            </div>
                                        </p>
                                        <?php if ($row->status == 'Belum Bayar') { ?>
                            <div class="mb-3">
                                <p>Waktu tersisa 1 jam untuk pembayaran: <span id="countdownTimer"></span></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 me-2">
                                    Pemesanan Anda Telah Berhasil. Silahkan cek status bayar Anda untuk konfirmasi pembayaran lebih lanjut.
                                </p>
                                <a href="cekstatus.php" class="btn btn-success"><i class="fa-solid fa-cart-shopping"></i></a>
                            </div>
                        <?php } else { ?>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 me-2">
                                    Pemesanan Anda Telah Berhasil. 
                                </p>
                                <a href="cekstatus.php" class="btn btn-primary">Cek Status</a>
                            </div>
                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            <?php
                } else {
                    echo '<div class="container mt-3"><div class="alert alert-warning">Tidak ada Jadwal untuk data ini</div></div>';
                }
            ?>
        </main>

        <footer>
            <?php include "layout/footer.php"; ?>
        </footer>

        <script>
            var waktuPembayaran = new Date().getTime() + 60 * 60 * 1000; 

            function formatTime(time) {
                var hours = Math.floor(time / 3600);
                var minutes = Math.floor((time % 3600) / 60);
                var seconds = time % 60;

                return hours + " jam " + minutes + " menit " + seconds + " detik";
            }

            var countdownInterval = setInterval(function() {
                var now = new Date().getTime();
                var timeLeft = waktuPembayaran - now; 

                if (timeLeft <= 0) {
                    clearInterval(countdownInterval); 
                    document.getElementById("countdownTimer").innerHTML = "Waktu pembayaran telah habis.";
                    document.getElementById("confirmButton").disabled = true;
                } else {
                    var time = Math.floor(timeLeft / 1000); 
                    document.getElementById("countdownTimer").innerHTML = formatTime(time);
                }
            }, 1000);
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
