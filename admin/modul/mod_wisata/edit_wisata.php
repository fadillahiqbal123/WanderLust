<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header"><strong>Form Edit Wisata</strong></div>
        <div class="card-body">
                <?php  
                        $id = $_GET['id'];
                        $sql = mysqli_query($db, "SELECT * FROM destinasi WHERE id_destinasi='$id'");
                        $r = mysqli_fetch_array($sql);

                 ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Nama Wisata</label>
                    <input type="text" name="nama_destinasi" class="form-control" value="<?php echo $r['nama_destinasi']  ?>"/>
                </div> 

                <div class="form-group">
                    <label>Kategori Wisata</label>
                    <select name="id_kategori" class="form-control">
                        <?php 
                            if($r['id_kategori'] == 0) {?>

                                <option value="0" selected>--Pilih Wisata</option>

                                <?php
                            }

                            $tampil = mysqli_query($db, "SELECT * FROM kategori");
                            while($a = mysqli_fetch_array($tampil)){
                                if ($r['id_kategori'] == $a['id_kategori']) { ?>
                                    <option value="<?php echo $a['id_kategori'] ?>" selected><?php echo $a['nama_kategori'] ?></option>

                                    <?php
                                }else { ?>
                                    <option value="<?php echo $a['id_kategori'] ?>"><?php echo $a['nama_kategori'] ?></option>

                                    <?php
                                }
                            }
                        ?>
                      
                    </select>
                </div>

                 
                <div class="form-group">
                    <label>Lokasi Wisata</label>
                    <input type="text" name="lokasi_wisata" class="form-control" value="<?php echo $r['lokasi_wisata'] ?>"/>
                </div>

                <div class="form-group">
                    <label>Link Peta</label>
                    <textarea rows="4" class="form-control" name="link_peta"><?php echo $r['link_peta'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea rows="4" class="form-control ckeditor" name="deskripsi"><?php echo $r['deskripsi']?></textarea>
                </div>
                <div class="form-group mt-3">
                <button type="submit" name="submit" class="btn btn-outline-primary">Upadate</button>
                </div>
            </form>
            <?php  
                if(isset($_POST['submit'])){
                    $nama_destinasi = $_POST['nama_destinasi'];
                    $id_kategori = $_POST['id_kategori'];
                    $lokasi_wisata = $_POST['lokasi_wisata'];
                    $link_peta = $_POST['link_peta'];
                    $deskripsi = $_POST['deskripsi'];

                    mysqli_query( $db, "UPDATE destinasi SET nama_destinasi='$nama_destinasi', id_kategori='$id_kategori',
                    lokasi_wisata='$lokasi_wisata', link_peta='$link_peta', deskripsi='$deskripsi' WHERE id_destinasi='$id'");

                    echo "<script>alert('Data Berhasil di Update'); window.location = 'dashboard.php?hal=destinasi-wisata'</script>";
                }
            ?>
        </div>
    </div>
</div>