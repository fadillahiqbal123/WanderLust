    <?php 
    include "koneksi.php";


    // Fungsi untuk mengambil semua jadwal dari database
    function sql_select_all()
    {
        global $db; // Pastikan koneksi database sudah didefinisikan sebelumnya
        $sql = "SELECT jadwal.id_jadwal, jadwal.tgl_berangkat, jadwal.jam_berangkat, jadwal.harga, 
                    kendaraan.jenis_mobil, kendaraan.warna_mobil, kendaraan.nomor_polisi, 
                    asal.alamat, destinasi.nama_destinasi 
                FROM jadwal
                JOIN kendaraan ON jadwal.id_mobil = kendaraan.id_mobil 
                JOIN asal ON jadwal.id_asal = asal.id_asal 
                JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi";

        $hasil = mysqli_query($db, $sql) or die(mysqli_error($db));
        return $hasil;
    }
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
            <!-- google font -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                <!-- google font -->
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <!-- data tables -->
            <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
            <style>
                * { font-family: "Poppins", sans-serif; }
            .panel-custom {
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 50px;
                background-color: #ffffff;
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            }
            .panel-title-custom {
                font-size: 1.2rem;
                font-weight: bold;
                color: #333;
            }
            .panel-body {
                background-color: #f8f9fa;
                padding: 15px;
                border-radius: 6px;
            }
            .btn-primary {
                background-color: #0084ff;
                border-color: #0084ff;
            }
            .btn-danger {
                background-color: #e74c3c;
                border-color: #e74c3c;
            }
            .table td, .table th {
                vertical-align: middle;
            }
            .table-striped tbody tr:nth-of-type(odd) {
                background-color: #f9f9f9;
            }
            </style>
        </head>

        <body>
            <header>
                <?php
            include "layout/navbar.php";

            ?>
            </header>


            <main style="padding-top: 20px;">
        <h4 class="mt-2 pt-2 mb-5 text-center fw-bold">Layanan Jadwal</h4>
        <div class="container-fluid my-5">

    <table id="example" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Keberangkatan</th>
                <th>Waktu Berangkat</th>
                <th>Harga</th>
                <th>Mobil</th>
                <th>Warna</th>
                <th>Nomor Polisi</th>
                <th>Kursi Tersedia</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $hasil = sql_select_all();
            $no = 1; // Penomoran baris
            while ($baris = mysqli_fetch_array($hasil)) {
                $id_jadwal = $baris['id_jadwal'];
                // Hitung kursi yang tersedia
                $result2 =  "SELECT COUNT(no_kursi) FROM pesan WHERE id_jadwal = '$id_jadwal'";
                $sqli2 = mysqli_query($db, $result2);
                $data2 = mysqli_fetch_array($sqli2);
                $banyakData = 5 - $data2[0];
            ?>
                <tr>
                    <td></td>
                    <td><?php echo $baris['alamat'] . '-' . $baris['nama_destinasi']; ?></td>
                    <td><?php echo $baris['tgl_berangkat'] . ' | ' . $baris['jam_berangkat']; ?></td>
                    <td>Rp.<?php echo number_format($baris['harga'], 0, ',', '.'); ?>,00</td>
                    <td><?php echo $baris['jenis_mobil']; ?></td>
                    <td><?php echo $baris['warna_mobil']; ?></td>
                    <td><?php echo $baris['nomor_polisi']; ?></td>
                    <td><?php echo $banyakData; ?></td>
                    <td>
                        <?php 
                        if ($banyakData > 0) {
                            echo "<a href='formpesan.php?formpesan&idp=$id_jadwal' class='btn btn-primary btn-sm'>Pesan</a>";
                        } else {
                            echo "<button class='btn btn-danger btn-sm' disabled>Kursi Penuh</button>";
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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
