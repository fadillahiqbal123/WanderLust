<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3><strong>Form Tambah Alamat</strong></h3>
        </div>
        <div class="card-body">
        <?php  
            $id = $_GET['id'];
            $sql = mysqli_query($db, "SELECT * FROM asal WHERE id_asal='$id'");
            $r = mysqli_fetch_array($sql);

         ?>

            <form action="" method="POST">
            <div class="form-group">
                    <label>Nama Admin</label>
                    <select name="id_admin" class="form-control">
                        <?php 
                            if($r['id_admin'] == 0) {?>

                                <option value="0" selected>--Pilih Wisata</option>

                                <?php
                            }

                            $tampil = mysqli_query($db, "SELECT * FROM admin");
                            while($a = mysqli_fetch_array($tampil)){
                                if ($r['id_admin'] == $a['id_admin']) { ?>
                                    <option value="<?php echo $a['id_admin'] ?>" selected><?php echo $a['nama_admin'] ?></option>

                                    <?php
                                }else { ?>
                                    <option value="<?php echo $a['id_admin'] ?>"d><?php echo $a['nama_admin'] ?></option>

                                    <?php
                                }
                            }
                        ?>
                      
                    </select>
                </div>

            <div class="form-group mb-3">
                <label class="form-label">Alamat Penjemputan</label>
                <textarea type="text" rows="4" name="alamat" class="form-control" placeholder="Masukan Alamat Untuk Pelanggan" style="font-size: 15px;"><?php echo $r['alamat'] ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-outline-primary">Create</button>
            </div>
            </form>
            <?php  
                if (isset($_POST['submit'])){
                    $id_admin = $_POST['id_admin'];
                    $alamat = $_POST['alamat'];

                    mysqli_query($db, "UPDATE asal SET id_admin='$id_admin', alamat='$alamat' WHERE id_asal='$id'");

                    echo "<script>alert('Alamat Berhasil DiUpdate'); window.location = 'dashboard.php?hal=alamat'</script>";
                }
            ?>
        </div>
    </div>
</div>