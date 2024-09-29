<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header"><strong>Tambah Data</strong></div>
        <div class="card-body">
            <form action="" method="POST">
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control" name="nama_kategori" placeholder="Masukan Kategori"/>  
            </div>
            <div class="form-group">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukan Keterangan"></textarea>
            </div>
            <div class="form-group mt-3">
            <button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>
            </div>
            </form>
            <?php  
                if (isset($_POST['submit'])){
                    $nama_kategori = $_POST['nama_kategori'];
                    $keterangan = $_POST['keterangan'];

                    mysqli_query($db, "INSERT INTO kategori (nama_kategori, keterangan) VALUES ('$nama_kategori', '$keterangan')");

                    echo "<script>alert('Kategori Berhasil Ditambahkan'); window.location = 'dashboard.php?hal=kategori'</script>";
                }
            ?>
        </div>
    </div>
</div>