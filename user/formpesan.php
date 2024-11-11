<?php 

include "koneksi.php";

?>

<!doctype html>
<html lang="en">
    <head>
        <title>WanderLusr</title>
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

    </head>

    <body>
        <header>
           <?php 
                include "layout/navbar.php";
            ?>
        </header>
        <main class="min-height:100vh; padding-top: 80px;">
        <?php
    
    $idj = isset($_GET['idp']) ? (int)$_GET['idp'] : 0;

    // Query untuk mendapatkan informasi jadwal, kendaraan, kota_asal, dan kota_tujuan
    $query1 = "
        SELECT * FROM jadwal
        JOIN kendaraan ON kendaraan.id_mobil = jadwal.id_mobil
        JOIN asal ON jadwal.id_asal = asal.id_asal
        JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
        WHERE jadwal.id_jadwal = $idj
    ";

    $result = mysqli_query($db, $query1) or die(mysqli_error($db));
    while ($row = mysqli_fetch_object($result)) {
?>
<div class="container">
    <div class="row mt-5 pt-5">
        <div class="col-md-12 mb-3">
            <div class="panel panel-default fw-bold h-font" style="color:black; font-size: 25px;">
                <div class="panel-body text-center">INPUT DATA PESAN</div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body" style="color:black;">
                    <form class="form-control" action="konfirpesan.php?&i=<?php echo $row -> id_jadwal; ?>" method="POST">
                        <div class="row">
                            <?php 
                                if (isset($_SESSION['email'])) {
                                    $zet = $_SESSION['email'];
                                    $querya = "SELECT * FROM user WHERE email = '$zet'";
                                    $resultan = mysqli_query($db, $querya) or die(mysqli_error($db));

                                    while ($rom = mysqli_fetch_object($resultan)) {
                            ?>
                            <div class="col-md-6 mt-3">
                                <label for="id_jadwal" class="mb-2">ID Jadwal</label>
                                <input class="form-control" type="text" name="id_jadwal" maxlength="30" value="<?php echo $idj; ?>" readonly/>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="email" class="mb-2">Email Pemesan</label>
                                <input class="form-control" type="text" name="email" maxlength="30" value="<?php echo $rom->email; ?>" readonly/>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="id_user" class="mb-2">ID User</label>
                                <input class="form-control" type="text" name="id_user" maxlength="30" value="<?php echo $rom->id_user; ?>" readonly/>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="status" class="mb-2">Status</label>
                                <input class="form-control" type="text" name="status" maxlength="30" value="Belum Bayar" readonly />
                            </div>
                            <?php 
                                    } 
                                } 
                            ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label class="mb-2">No Kursi</label>
                                <select id="no_kursi" name="no_kursi" class="form-control">
                                    <option value="">Pilih Kursi</option>
                                    <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            $sql = "SELECT COUNT(no_kursi) FROM pesan WHERE id_jadwal = $idj AND no_kursi = $i";
                                            $res = mysqli_query($db, $sql);
                                            $ou = mysqli_fetch_array($res);
                                            if ($ou[0] == 1) {
                                                echo "<option disabled>$i (terisi)</option>";
                                            } else {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p><input type="submit" name="action" value="Simpan" class="btn btn-primary btn-sm mt-4"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="panel panel-info">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <hr>
                            <p>Alamat: <?php echo $row->alamat; ?></p>
                            <p>Nama Destinasi: <?php echo $row->nama_destinasi; ?></p>
                            <p>Tanggal Berangkat: <?php echo $row->tgl_berangkat; ?></p>
                        </div>
                        <div class="col-md-6">
                            <hr>
                            <img src="" alt="Gambar Destinasi" class="img-fluid"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5 justify-content-between mt-3">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <p>Keterangan:<br>0: Supir<br>
                    <?php
                        for ($i = 1; $i <= 5; $i++) {
                            $sql = "SELECT COUNT(no_kursi) FROM pesan WHERE id_jadwal = $idj AND no_kursi = $i";
                            $result = mysqli_query($db, $sql);
                            $out = mysqli_fetch_array($result);
                            echo "$i : " . ($out[0] == 1 ? "Terisi" : "Kosong") . "<br>";
                        }
                    ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php } ?>

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
