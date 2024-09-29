<div class="container-fluid">
    <div class="card mt-3">
        <form action="" method="POST">
        <div class="card-header"><strong>Form Tambah Wisata</strong></div>
        <div class="card-body">
            <div class="form-group mb-3">
                <label class="form-label">Nama Wisata</label>
                <input type="text" name="nama_destinasi" class="form-control" placeholder="Masukan Nama Destinasi Wisata"/>
            </div>
            <div class="form-group">
            <label>Kategori Wisata</label>
             <select class="form-control" name="id_kategori" id="id_kategori">
                 <option value="0" selected>--Pilih Kategori Wisata--</option>
                 
                 <?php
                    $sql = mysqli_query($db, "SELECT * FROM kategori ORDER BY id_kategori ASC");
                    while($r = mysqli_fetch_array($sql)){  ?>

                        <option value="<?php echo $r['id_kategori'] ?>"><?php echo $r['nama_kategori'] ?></option>  
                    <?php
                     }
                ?> 
        </select>
        </div>
        <div class="form-group mt-3">
                <label class="form-label">Lokasi Wisata</label>
                <input type="text" name="lokasi_wisata" class="form-control" placeholder="Masukan Lokasi Wisata"/>
            </div>
        <div class="form-group mt-3">
            <label>Link Peta</label>
            <textarea class="form-control" name="link_peta" rows="2" placeholder="Masukan Link Peta"></textarea>
        </div>
        <div class="form-group mt-3">
            <label>Deskripsi</label>
            <textarea class="form-control ckeditor" id="ckeditor" name="deskripsi" rows="4" placeholder="Masukan Deskripsi"></textarea>
        </div>
        <div class="form-group mt-3">
            <button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>
        </div>
        </div>
        </form>
        <?php 
          if(isset($_POST['submit'])) {
            $nama_destinasi = $_POST['nama_destinasi'];
            $id_kategori = $_POST['id_kategori'];
            $lokasi_wisata = $_POST['lokasi_wisata'];
            $link_peta = $_POST['link_peta'];
            $deskripsi = $_POST['deskripsi'];

            mysqli_query($db, "INSERT INTO destinasi (nama_destinasi,id_kategori,lokasi_wisata,link_peta,deskripsi) VALUES ('$nama_destinasi', '$id_kategori', '$lokasi_wisata', '$link_peta', '$deskripsi')");

            echo "<script>alert('Data Berhasil Ditambahkan'); window.location = 'dashboard.php?hal=destinasi-wisata'</script>";
          }

?>
          </div>

    </div>
</div>