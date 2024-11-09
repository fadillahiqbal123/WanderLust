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
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/> 
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
              <!-- css -->
            <!-- data tables -->
            <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
            <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        
    </head>

    <body>
        <header>
           <?php 
           include "layout/navbar.php";
           ?>
        </header>
        <main style="min-height:100vh; padding-top: 80px;">
            <?php 
        $cari_asal = $_POST['cari_asal'];
        $cari_destinasi = $_POST['cari_destinasi'];
        $caritgl = $_POST['caritgl'];


        $queryJadwal = "
        SELECT jadwal.*, kendaraan.jenis_mobil, asal.alamat AS asal_alamat, destinasi.nama_destinasi
        FROM jadwal 
        JOIN kendaraan ON jadwal.id_mobil = kendaraan.id_mobil
        JOIN asal ON jadwal.id_asal = asal.id_asal
        JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
        WHERE jadwal.id_asal = '$cari_asal' 
        AND jadwal.id_destinasi = '$cari_destinasi' 
        AND jadwal.tgl_berangkat = '$caritgl'
        ";

$resultJadwal = mysqli_query($db, $queryJadwal) or die(mysqli_error($db));

?>

 <div class="container mt-5">
    <div class="panel panel-primary">
        <div class="panel-body" style="color:black;">
            <?php if (mysqli_num_rows($resultJadwal) > 0): ?>
                <table id="example" class="display" style="width:100;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jurusan</th>
                            <td>Tanggal/Jam Berangkat</td>
                            <th>Harga</th>
                            <th>Jumlah Kursi Tersedia</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultJadwal)): ?>
                            <tr>
                            <td></td>
                            <td><?php echo $row['asal_alamat'] . ' - ' . $row['nama_destinasi']; ?></td>
                            <td><?php echo date('d-m-Y H:i', strtotime($row['tgl_berangkat'])); ?></td>
                            <td><?php echo number_format($row['harga'], 0, ',', '.'); ?> IDR</td>
                            <td>
                                <?php 
                                      $id_jadwal = $row['id_jadwal']; 

                                    $result2 ="SELECT COUNT(no_kursi) FROM pesan WHERE id_jadwal='$id_jadwal'"; 
                                    $sqli2 = mysqli_query($db, $result2);
                                    $data2 = mysqli_fetch_array($sqli2);
                                    $banyakData2 = 5-$data2[0];
                                    echo  $banyakData2; 
                                ?>
                                </td>
                                <td>
                                    <a href="detailcari.php?hal=detail&var1=<?php echo $row ['id_jadwal'] ?>" class="btn btn-sm btn-primary">
                                         Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    Mohon maaf, jadwal yang Anda cari belum Dibuat.<br>Silahkan Kirim Kritik/Saran Anda Jika Dirasa Ingin menambah Jadwal
                </div>
            <?php endif; ?>
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
