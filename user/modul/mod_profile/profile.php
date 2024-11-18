<div class="container-fluid mt-4">
    <div class="card">
    <div class="card-header"><strong>Ubah Konten Profile</strong></div>
    <div class="card-body">
        <?php
            $sql = mysqli_query($db, "SELECT * FROM profil");
            $r = mysqli_fetch_array($sql);


        ?>
        <form action="" method="POST" enctype="multipart/form-data">
           <div class="form-group mb-3 mt-3">
            <label>Konten Profile</label>
            <textarea class="form-control ckeditor" type="text" name="konten_profil" id="ckeditor" rows="3"><?php echo $r['konten_profil']  ?></textarea>
           </div>
           <div class="form-group mb-3 mt-3">
            <label class="form-label">Foto Profile</label>
            <input type="file" class="form-control-file" name="foto_profil"/>
            <small id="fileHelpId" class="form-text text-muted" style="display: block;">Upload File Image(jpg, png, jpeg)</small>
           </div>
           <div class="form-group">
                <img src="././img_profile/<?php echo $r["foto_profil"]?>" alt="<?php echo $r["foto_profil"]  ?>" heigth="100" width="100">
           </div>
           <div class="mb-2 mt-3">
           <button type="submit" name="submit" class="btn btn-primary">Update</button>
           </div>
        </form>
            <?php
                if(isset($_POST['submit'])){
                    $konten_profil= $_POST['konten_profil'];
                    $id_profil = $r['id_profile'];

                    $foto_profil = $_FILES['foto_profil']['name'];
                    $path_foto_profil = "././img_profile/".$r['foto_profil'];
                    $file_extension = array('png', 'jpg', 'jpeg', 'gif');
                    $extension = pathinfo($foto_profil, PATHINFO_EXTENSION);
                    $size_foto_profil = $_FILES['foto_profil']['size'];
                    $rand = rand();

                    if(empty($foto_profil)){

                        mysqli_query($db, "UPDATE profil SET konten_profil='$konten_profil' WHERE id_profile='$id_profil'");

                        echo "<script>alert('Konten Profile Berhasil Diperbarui!'); window.location = 'dashboard.php?hal=profile'</script>";
                    }else{

                       if(!in_array($extension, $file_extension)){
                            echo "<script>alert('File Tidak Didukung'); window.location = 'dashboard.php?hal=profile' </script>";
                       }else{
                        if($size_foto_profil < 409600){
                            $nama_foto_profil = $rand.'_'.$foto_profil;
                            unlink($path_foto_profil);
                            move_uploaded_file($_FILES['foto_profil']['tmp_name'], '././img_profile/'.$nama_foto_profil);
                            mysqli_query($db, "UPDATE profil SET konten_profil='$konten_profil', foto_profil='$nama_foto_profil' WHERE id_profile='$id_profil'");

                            echo "<script>alert('Konten dan Foto Profile Berhasil Diubah); window.location = 'dashboard.php?hal=profile'</script>";
                           
                        }else{
                            echo "<script>alert('Ukuran Foto Terlalu Besar'); window.location = 'dashboard.php?hal=profile'</script>";
                        }
                       }

                    }   

                }
            ?>
    </div>
    </div>
</div>