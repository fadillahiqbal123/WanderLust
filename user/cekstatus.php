fitur cekstatus

<?php 
session_start();
include "koneksi.php";
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
            <!-- data tables -->
            <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
        </head>
    <style>
         * { 
            font-family: "Poppins", sans-serif; 
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

            main{
                min-height: 100vh;
                padding: 20px;
                padding-top: 80px; 
                flex-grow: 1;
            }

            footer{

            }
    
    </style>

    <body>
        <header>
          <?php  
            include "layout/navbar.php";

?>
        </header>



        <main>

<div class="panel panel-default" style="color:black">
    <div class="panel-body">Data Status Bayar</div>
</div>
<div class="panel panel-primary" style="color:black;">
<table id="example" class="display">
    <thead>
        <tr>
            <td></td>
            <td>ID Pesan</td>
            <td>Jurusan</td>
            <td>Berangkat</td>
            <td>Harga</td>
            <td>Status</td>
            <td>Pembatalan</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $mem = $_SESSION['username'];
        global $db;

        // Query untuk menghitung banyaknya data
        $result_count = "SELECT count(id_pesan) AS total FROM user, pesan, jadwal, asal, destinasi 
                         WHERE user.id_user = pesan.id_user 
                         AND user.username = '$mem' 
                         AND pesan.id_jadwal = jadwal.id_jadwal 
                         AND jadwal.id_asal = asal.id_asal 
                         AND jadwal.id_destinasi = destinasi.id_destinasi";

        $sqli = mysqli_query($db, $result_count) or die(mysqli_error($db));
        $data = mysqli_fetch_array($sqli);
        $banyakData = $data['total'];

        // Query untuk mengambil data detail
        $query1 = "SELECT * FROM user, pesan, jadwal, asal, destinasi 
                   WHERE user.id_user = pesan.id_user
                   AND user.username = '$mem'
                   AND pesan.id_jadwal = jadwal.id_jadwal
                   AND jadwal.id_asal = asal.id_asal
                   AND jadwal.id_destinasi = destinasi.id_destinasi"; 

        $result = mysqli_query($db, $query1) or die(mysqli_error($db));

        // Loop untuk menampilkan data
        while ($row = mysqli_fetch_object($result)) { 
            $id_pesan = $row->id_pesan;
            ?>
            <tr>
                <td></td>
                <td><?php echo $row->id_pesan; ?></td>
                <td><?php echo $row->alamat; ?> - <?php echo $row->nama_destinasi; ?></td>
                <td><?php echo $row->tgl_berangkat; ?> | <?php echo $row->jam_berangkat; ?></td>
                <td>Rp. <?php echo $row->harga; ?>,00</td>
                <td>
                    <?php 
                    if ($row->status == "Belum Bayar") { 
                        echo "<a href='konfirmasipembayaran.php?&idp=$id_pesan' class='btn btn-danger'> $row->status</a>";
                    } elseif ($row->status == "Dalam Proses") { 
                        echo "<a href='#' class='btn btn-primary disabled'> $row->status</a>";
                    } else {
                        echo "<a href='#' class='btn btn-success disabled'> $row->status</a>";
                    } 
                    ?>
                </td>
                <td>
                    <?php  
                    if ($row->status == "Belum Bayar") { 
                        echo "<a href='batalpesan.php?&idp=$id_pesan' class='btn btn-warning'>Batal</a>";
                    }
                    ?>
                </td>
            </tr>
            <?php 
        } 
        ?>
    </tbody>
</table>
<div class="well well-sm">
    Pembatalan pemesanan hanya dapat dilakukan pada pemesanan yang belum dilakukan konfirmasi pembayaran<br>
    Untuk melakukan konfirmasi pembayaran klik tombol <b style="color:red;">Belum Bayar</b>
</div>


        </main>




        <footer>
        <?php 
            include "layout/footer.php";
        ?>
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
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
            <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
            <script>
                const table = new DataTable('#example', {
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0
            }
        ],
        order: [[1, 'asc']]
    });
    
    table
        .on('order.dt search.dt', function () {
            let i = 1;
    
            table
                .cells(null, 0, { search: 'applied', order: 'applied' })
                .every(function (cell) {
                    this.data(i++);
                });
        })
        .draw();
            </script>
    </body>
</html>