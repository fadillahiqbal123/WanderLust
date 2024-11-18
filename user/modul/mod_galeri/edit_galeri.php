<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header"><strong>Form Edit Galeri</strong></div>
          <div class="card-body">
            <?php  
             $id = $_GET['id'];
             $sql = mysqli_query($db, "SELECT * FROM galeri WHERE id_galeri=$id");
             $r = mysqli_fetch_array($sql);

                ?>

          <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="" class="form-label">Keterangan Foto</label>
                <textarea rows="2" name="keterangan_foto"  class="form-control" placeholder="Masukan Keterangan"><?php echo $r['keterangan_foto'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Nama Wisata</label>
                <select name="id_destinasi" class="form-select">
                    <?php  
                        if ($r['id_destinasi'] == 0){
                            ?>
                            

                            <?php
                        }

                        $tampil = mysqli_query($db, "SELECT * FROM destinasi");
                        while($a = mysqli_fetch_array($tampil)){
                            if ($r['id_destinasi'] == $a['id_destinasi']){  
                                ?>
                                      <option value="<?php echo $a['id_destinasi'] ?>" selected><?php echo $a['nama_destinasi'] ?></option>


                            <?php
                            }else{?>

                                    <option value="<?php echo $a['id_destinasi'] ?>" selected><?php echo $a['nama_destinasi'] ?></option>
                                <?php
                            }
                        }
                    ?>
                    
                </select>
            </div>
            <div class="form-group mt-3">
                <label>Foto Wisata</label>
                <input type="file" class="form-control" name="nama_foto">
                <img class="mt-4" src="././img_galeri/<?php echo $r['nama_foto'] ?>" height="100" width="100">   
                <div id="fileHelpId" class="form-text">Gambar Lama</div>  
                 </div>
               <div class="form-group">
                <button type="submit" name="submit" class="btn btn-outline-primary">Update</button>
                <a href="dashboard.php?hal=galeri" class="btn btn-outline-danger">Batal</a>
               </div>
                 
            </form>
            <?php  
                    if(isset($_POST['submit'])){
                        $keterangan_foto = $_POST['keterangan_foto'];
                        $id_destinasi = $_POST['id_destinasi'];
                        $nama_foto = $_FILES['nama_foto']['name'];

                        $extension_foto = pathinfo($nama_foto, PATHINFO_EXTENSION);
                        $size_foto = $_FILES['nama_foto']['size'];

                        if (empty($nama_foto)){
                            mysqli_query($db, "UPDATE galeri SET keterangan_foto = '$keterangan_foto',
                                                                               id_destinasi       = '$id_destinasi'
                                                                               WHERE id_galeri ='$id'");


                            echo "<script>alert('Galeri Berhasil di Update'); window.location = 'dashboard.php?hal=galeri'</script>";
                        }else{

                            if (!in_array($extension_foto, array('png', 'jpg', 'jpeg', 'gif'))){
                            echo "<script>alert('File Tida Didukung'); window.location = 'dashboard.php?hal=edit_galeri&id=$id'</script>";
                          

                                }else{
                                        if ($size_foto > 409600) {

                                            echo "<script>alert('File Terlalu Besar'); window.location = 'dashboard.php?hal=edit_galeri&id=$id' </script>";
                                        }else {
                                            $nama_foto_baru = rand().'_'.$nama_foto;

                                            unlink("././img_galeri/".$r['nama_foto']);
                                            move_uploaded_file($_FILES['nama_foto']['tmp_name'], '././img_galeri/'.$nama_foto_baru);

                                            mysqli_query($db, "UPDATE galeri SET keterangan_foto = '$keterangan_foto',
                                                                               id_destinasi      = '$id_destinasi',
                                                                               nama_foto         = '$nama_foto_baru'
                                                                               WHERE id_galeri   ='$id'");

                                            echo "<script>alert('Galeri Berhasil Diubah'); window.location =  'dashboard.php?hal=galeri'</script>";
                                        }
                                }
                            }
                        }
                        
                    

            ?>
          </div>  
        </div>
    </div>
</div>