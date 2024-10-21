<div class="container-fluid">
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
                    <input type="file" class="form-control-file" name="nama_foto">
                </div>
                
                <div class="form-group mt-3">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <?php  

            if(isset($_POST['submit'])){
                $keterangan_foto= $_POST['keterangan_foto'];
                $id_destinasi = $_POST['id_destinasi'];
                $nama_foto = $_FILES['nama_foto']['name'];
                $tmp_foto = $_FILES['nama_foto']['tmp_name'];
                $size_foto = $_FILES['nama_foto']['size'];
                $extension_foto = pathinfo($nama_foto, PATHINFO_EXTENSION);

                // Validasi ekstensi file
                if(!in_array($extension_foto, array('png', 'jpg', 'jpeg', 'gif'))) {
                    echo "<script>alert('Format foto tidak didukung!'); window.location = 'dashboard.php?hal=tambah_galeri'</script>";
                } else {
                    // Validasi ukuran file
                    if ($size_foto > 10485760) { // Batasan ukuran 10MB
                        echo "<script>alert('Ukuran File Terlalu Besar'); window.location = 'dashboard.php?hal=tambah_galeri'</script>";
                    } else {
                        // Baca file gambar dalam bentuk binary
                        $image = addslashes(file_get_contents($tmp_foto));

                        // Simpan data ke database
                        $query = "INSERT INTO galeri (keterangan_foto, id_destinasi, nama_foto) 
                                  VALUES ('$keterangan_foto', '$id_destinasi', '$image')";

                        if (mysqli_query($db, $query)) {
                            echo "<script>alert('Data Galeri Berhasil Ditambahkan'); window.location = 'dashboard.php?hal=galeri'</script>";
                        } else {
                            echo "<script>alert('Data Galeri Gagal Ditambahkan'); window.location = 'dashboard.php?hal=tambah_galeri'</script>";
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</div>
