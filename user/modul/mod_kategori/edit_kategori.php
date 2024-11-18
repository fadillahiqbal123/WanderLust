<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header"><strong>From Ubah Data</strong></div>
        <div class="card-body">
            <?php  
                $id = $_GET['id'];
               $sql = mysqli_query( $db, "SELECT * FROM kategori WHERE id_kategori='$id'");
               $r = mysqli_fetch_array($sql);
            ?>
            <form action="" method="POST">
                <div clas="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="nama_kategori" value="<?php echo $r['nama_kategori'] ?>">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"><?php echo $r['keterangan'] ?></textarea>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="submit" class="btn btn-outline-primary">Update</button>
                    <a href="dashboard.php?hal=kategori" class="btn btn-outline-danger">Batal</a>
                </div>
            </form>
            <?php 
                if(isset($_POST['submit'])){
                    $nama_kategori = $_POST['nama_kategori'];
                    $keterangan = $_POST['keterangan'];

                    mysqli_query($db, "UPDATE kategori SET nama_kategori='$nama_kategori', keterangan='$keterangan' WHERE id_kategori='$id'");

                    echo "<script>alert('Kategori Berhasil di Upadate'); window.location = 'dashboard.php?hal=kategori'</script>";
                }

            ?>
        </div>
    </div>
</div>