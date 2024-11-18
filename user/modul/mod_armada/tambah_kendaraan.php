<div class="container-fluid">
    <div class="card">
        <div class="card-header"><strong>Form Tambah Data Armada</strong></div>
            <div class="card-body">      
                 <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Jenis Mobil</label>
                        <input type="text" name="jenis_mobil" class="form-control" placeholder="Masukan Tipe Mobil"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Polisi</label>
                        <input type="text" name="nomor_polisi" class="form-control" placeholder="Masukan Nomor Polisi"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna Mobil</label>
                        <input type="text" name="warna_mobil" class="form-control" placeholder="Masukan Warna Mobil"/>
                    </div>
                    <div class="mb-3">
                    <button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>
                    <a href="dashboard.php?hal=kendaraan" class="btn btn-outline-danger">Batal</a>
                    </div>
                </form>
                <?php 
                    if (isset($_POST['submit'])){
                        $jenis_mobil= $_POST['jenis_mobil'];
                        $nomor_polisi = $_POST['nomor_polisi'];
                        $warna_mobil = $_POST['warna_mobil'];

                        $sql = mysqli_query($db, "INSERT INTO kendaraan (jenis_mobil, nomor_polisi, warna_mobil) VALUES ('$jenis_mobil', '$nomor_polisi', '$warna_mobil')");

                        echo "<script>alert('Data Kendaraan Berhasil Ditambahkan'); window.location = 'dashboard.php?hal=kendaraan'</script>";

                    }
                    ?>
            </div>     
    </div>
</div>