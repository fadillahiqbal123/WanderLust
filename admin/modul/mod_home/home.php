<div class="container-fluid">
    <div class="col-md-12 border">
        <div class="row mt-5">
            <div class="col-sm-6 col-md-4 col-lg-3 card-group">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <?php  
                            $sql_galeri = mysqli_query($db, "SELECT * FROM galeri");
                            $jumlah_galeri = mysqli_num_rows($sql_galeri); 
                        ?>
                        <h1 class="card-title"><?php echo $jumlah_galeri ?></h1>
                        <p class="card-text">Total Data Galeri</p>
                    </div>
                    <div class="card-footer text-center">
                        <a class="text-white text-decoration-none" href="dashboard.php?hal=galeri"><strong>Lihat Data</strong> <i class="bi bi-arrow-right-square-fill"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 card-group">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <?php  
                            $sql_destinasi = mysqli_query($db, "SELECT * FROM destinasi");
                            $jumlah_destinasi = mysqli_num_rows($sql_destinasi);
                        ?>
                        <h1 class="card-title"><?php echo $jumlah_destinasi ?></h1>
                        <p class="card-text">Total Data Wisata</p>
                    </div>
                    <div class="card-footer text-center">
                        <a class="text-white text-decoration-none" href="dashboard.php?hal=destinasi-wisata"><strong>Lihat Data</strong> <i class="bi bi-arrow-right-square-fill"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 card-group">
                <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <?php  
                            $sql_kategori = mysqli_query($db, "SELECT * FROM kategori");
                            $jumlah_kategori = mysqli_num_rows($sql_kategori);
                        ?>
                        <h1 class="card-title"><?php echo $jumlah_kategori ?></h1>
                        <p class="card-text">Total Data Kategori</p>
                    </div>
                    <div class="card-footer text-center">
                        <a class="text-white text-decoration-none" href="dashboard.php?hal=kategori"><strong>Lihat Data</strong> <i class="bi bi-arrow-right-square-fill"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 card-group">
                <div class="card text-white bg-danger-subtle mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <?php 
                            $sql_berita = mysqli_query($db, "SELECT * FROM berita");
                            $jumlah_berita = mysqli_num_rows($sql_berita);
                        ?>
                        <h1 class="card-title"><?php echo $jumlah_berita ?></h1>
                        <p class="card-text">Total Data Berita</p>
                    </div>
                    <div class="card-footer text-center">
                        <a class="text-white text-decoration-none" href="dashboard.php?hal=berita"><strong>Lihat Data</strong> <i class="bi bi-arrow-right-square-fill"></i></a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row border mt-2">
        <div class="col-md-6">
            <canvas id="grafikWisata" class="p-2" style="width:100%; height:100%; max-width:650px"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="grafikGaleri" class="p-2" style="width:100%; height:100%; max-width:650px"></canvas>
        </div>
    </div>

    <div class="row border mt-2">
        <div class="col-md-6">
        <table class="table table-sm table-bordered mt-2">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Wisata</th>
                <th scope="col">Kategori</th>
                <th scope="col">Lokasi</th>
                </tr>
            </thead>
            <tbody>
                <?php   
                    $sql = mysqli_query($db, "SELECT * FROM destinasi, kategori WHERE destinasi.id_kategori = kategori.id_kategori ORDER BY destinasi.id_destinasi DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($sql)){?>

                        <tr>
                        <th scope="row"><?php echo $no++ ?></th>
                        <td><?php echo $r['nama_destinasi'] ?></td>
                        <td><?php echo $r['nama_kategori']  ?></td>
                        <td><?php echo $r['lokasi_wisata'] ?></td>
                    </tr>

                    <?php
                    }
                ?>
                
            </tbody>
        </table>
        </div>
        <div class="col-md-6">
        <table class="table table-sm table-bordered mt-2">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Penulis</th>
                </tr>
            </thead>
            <tbody>
                <?php   
                    $sql = mysqli_query($db, "SELECT * FROM berita, admin WHERE berita.id_admin = admin.id_admin");
                    $no = 1;
                    while($r=mysqli_fetch_array($sql)){?>

                        <tr>
                        <th scope="row"><?php echo $no++ ?></th>
                        <td><?php echo $r['judul_berita'] ?></td>
                        <td><?php echo $r['nama_admin'] ?></td>
                    </tr>

                    <?php
                    }
                ?>
                
            </tbody>
        </table>
        </div>
    </div>
</div>
