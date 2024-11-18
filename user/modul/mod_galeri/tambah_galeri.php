<div class="container-fluid">
    <div class="row mt-2 pt-2">
    <div class="card">
        <div class="card-header"><strong>Tambah Data Galeri</strong></div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Keterangan Foto</label>
                    <textarea rows="2" class="form-control" name="keterangan_foto" placeholder="Masukan Keterangan Foto"></textarea>
                </div>
                <div class="form-group">
                    <label>Nama Wisata</label>
                    <select name="id_destinasi" class="form-control">
                        <option value="0">--Pilih Wisata--</option>
                        <?php  
                        // Menghapus tanda kurung tambahan di query
                        $sql = mysqli_query($db, "SELECT * FROM destinasi ORDER BY id_destinasi ASC");
                        while($r = mysqli_fetch_array($sql)) { ?>
                            <option value="<?php echo $r['id_destinasi']; ?>"><?php echo $r['nama_destinasi']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label>Pilih Foto</label>
                    <!-- Tidak perlu menggunakan value="0" di input file -->
                    <input type="file" class="form-control-file" name="nama_foto">
                </div>
                
                <div class="form-group mt-3">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a href="dashboard.php?hal=galeri" class="btn btn-outline-danger">Batal</a>
                </div>
            </form>
            <?php  

            if(isset($_POST['submit'])){
                $keterangan_foto= $_POST['keterangan_foto'];
                $id_destinasi = $_POST['id_destinasi'];
                $nama_foto = $_FILES['nama_foto']['name'];

                $extension_foto = pathinfo($nama_foto, PATHINFO_EXTENSION);
                $size_foto = $_FILES['nama_foto']['size'];

                if(!in_array($extension_foto, array('png', 'jpg', 'jpeg', 'gif'))) {
                    echo "<script>alert('foto tidak didukung!'); window.location = 'dashboard.php?hal=tambah_galeri'</script>";
                }else{
                    if ($size_foto > 409600) {
                        echo "<script>alert('Ukuran File Terlalu Besar'); window.location = 'dashboard.php?hal=tambah_galeri'</script>";
                    }else {
                       $nama_foto_baru = rand().'_'.$nama_foto;

                       move_uploaded_file($_FILES['nama_foto']['tmp_name'], '././img_galeri/'.$nama_foto_baru);

                       mysqli_query($db, "INSERT INTO galeri (keterangan_foto, id_destinasi, nama_foto) VALUES ('$keterangan_foto', '$id_destinasi', '$nama_foto_baru')");

                       echo "<script>alert('Data Galeri Berhasil Ditambahkan'); window.location = 'dashboard.php?hal=galeri'</script>";
                    }
                }
            
            }
            ?>
        </div>
    </div>
    </div>  
</div>
