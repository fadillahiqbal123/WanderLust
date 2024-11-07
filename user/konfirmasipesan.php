<?php  
include "koneksi.php";
session_start();

?>


<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
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
            <style>
    main {
        flex: 1;
        padding-top: 80px; /* Sesuaikan dengan tinggi navbar */
        padding-bottom: 40px; /* Sesuaikan dengan tinggi footer */
        min-height: calc(100vh - 120px); /* Sesuaikan total tinggi navbar dan footer */
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
            <?php 
                include "layout/navbar.php";
            ?>
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
        pesan.id_jadwal = $id_jadwal";

$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_object($result)) {
?>
    <div class="container mt-5">
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
                        <p>Tanggal Berangkat: <span><?php echo $row->tgl_berangkat; ?></span></p>
                        <p>Total Bayar: <span><?php echo $row->harga; ?></span></p>
                        <p>Status Bayar: 
                            <div class="alert alert-danger" role="alert"><?php echo $row->status; ?></div>
                        </p>
                        <div class="fw-bold">
                            <p>Anda memiliki waktu paling lambat 1 jam sebelum jam keberangkatan untuk melakukan pembayaran.<br>
                            Setelah <u>Pembayaran Selesai</u>, silakan lakukan konfirmasi pembayaran dengan memasukkan Nomor Resi transfer pembayaran pemesanan tiket travel di website kami. Terima Kasih</p>
                        </div>
                        <input type="submit" name="action" value="Konfirmasi Pembayaran" class="btn btn-success">
                        <a class="btn btn-danger" onclick="self.history.back()">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php
}
?>



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
