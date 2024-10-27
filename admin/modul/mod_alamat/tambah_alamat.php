<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3><strong>Form Tambah Alamat</strong></h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group mb-3">
                    <label class="mb-2">Pilih Admin</label>
                        <select class="form-control" name="id_admin" id="id_admin">
                            <option value="0" selected>--Pilih Nama  Admin--</option>
                 
                 <?php
                    $sql = mysqli_query($db, "SELECT * FROM admin ORDER BY id_admin ASC");
                    while($r = mysqli_fetch_array($sql)){  ?>

                        <option value="<?php echo $r['id_admin'] ?>"><?php echo $r['nama_admin'] ?></option>  
                    <?php
                     }
                ?> 
        </select>
                </div>
            <div class="form-group mb-3">
                <label class="form-label">Alamat Penjemputan</label>
                <textarea type="text" rows="4" name="alamat" class="form-control" placeholder="Masukan Alamat Untuk Pelanggan" style="font-size: 15px;"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-outline-primary">Create</button>
            </div>
            </form>
            <?php  
                if (isset($_POST['submit'])){
                    $id_admin = $_POST['id_admin'];
                    $alamat = $_POST['alamat'];

                    mysqli_query($db, "INSERT INTO asal (id_admin, alamat) VALUES ('$id_admin', '$alamat')");

                    echo "<script>alert('Alamat Berhasil Ditambahkan'); window.location = 'dashboard.php?hal=alamat'</script>";
                }
            ?>
        </div>
    </div>
</div>