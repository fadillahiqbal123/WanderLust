<div class="cotainer-fluid">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
        <?php  
            $id = $_GET['id'];
            $sql = mysqli_query( $db, "SELECT * FROM kendaraan WHERE id_mobil='$id'");
            $r = mysqli_fetch_array($sql);
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Jenis Mobil</label>
                    <input type="text" name="jenis_mobil" class="form-control"  value="<?php echo $r['jenis_mobil'] ?>"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Polisi</label>
                    <input type="text" name="nomor_polisi" class="form-control" value="<?php echo $r['nomor_polisi'] ?>"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Warna Mobil</label>
                    <input type="text" name="warna_mobil" class="form-control" value="<?php echo $r['warna_mobil'] ?>"/>
                </div>
                <div class="mb-3">
                    <button type="submit" name="submit" class="btn btn-outline-warning">Update</button>
                    <a href="dashboard.php?hal=kendaraan" class="btn btn-outline-danger">Batal</a>
                   
                </div>  
            </form>
            <?php  
                        if(isset($_POST['submit'])){
                            $jenis_mobil = $_POST['jenis_mobil'];
                            $nomor_polisi = $_POST['nomor_polisi'];
                            $warna_mobil = $_POST['warna_mobil'];

                            mysqli_query($db, "UPDATE kendaraan SET jenis_mobil='$jenis_mobil', nomor_polisi='$nomor_polisi', warna_mobil='$warna_mobil' WHERE id_mobil='$id'");

                            echo "<script>alert('Data Kendaraan Berhasil di Update'); window.location = 'dashboard.php?hal=kendaraan'</script>";
                        }
                    ?>
        </div>
    </div>
</div>