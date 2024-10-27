<div class="container-fluid">
    <div class="row">
    <div class="card mt-3">
        <div class="card-header"><strong>Form Tambah Jadwal</strong></div>
        <div class="card-body">
        <?php  
                        $id = $_GET['id'];
                        $sql = mysqli_query($db, "SELECT * FROM jadwal WHERE id_jadwal='$id'");
                        $r = mysqli_fetch_array($sql);

                 ?>

            <form action="" method="POST">
            <div class="col-md-8 mb-3">
                    <label>Alamat Keberangkatan</label>
                    <select name="id_asal" class="form-control">
                        <?php 
                            if($r['id_asal'] == 0) {?>

                                <option value="0" selected>-- Pilih Alamat Keberangkatan --</option>

                                <?php
                            }

                            $tampil = mysqli_query($db, "SELECT * FROM asal");
                            while($a = mysqli_fetch_array($tampil)){
                                if ($r['id_asal'] == $a['id_asal']) { ?>
                                    <option value="<?php echo $a['id_asal'] ?>" selected><?php echo $a['alamat'] ?></option>

                                    <?php
                                }else { ?>
                                    <option value="<?php echo $a['id_asal'] ?>"><?php echo $a['alamat'] ?></option>

                                    <?php
                                }
                            }
                        ?>
                      
                    </select>
                </div>
            
                <div class="col-md-8 mb-3">
                    <label>Alamat Keberangkatan</label>
                    <select name="id_destinasi" class="form-control">
                        <?php 
                            if($r['id_destinasi'] == 0) {?>

                                <option value="0" selected>-- Pilih Tujuan Destinasi --</option>

                                <?php
                            }

                            $tampil = mysqli_query($db, "SELECT * FROM destinasi");
                            while($a = mysqli_fetch_array($tampil)){
                                if ($r['id_destinasi'] == $a['id_destinasi']) { ?>
                                    <option value="<?php echo $a['id_destinasi'] ?>" selected><?php echo $a['nama_destinasi'] ?></option>

                                    <?php
                                }else { ?>
                                    <option value="<?php echo $a['id_destinasi'] ?>"d><?php echo $a['nama_destinasi'] ?></option>

                                    <?php
                                }
                            }
                        ?>
                      
                    </select>
                </div>

            <div class="col-md-5 mb-3">
                <label class="form-label">Harga</label>
                <input type="text" name="harga" class="form-control" value="<?php echo $r['harga'] ?>"/>
            </div>

            <div class="col-md-2 mb-3">
                <label for="date" class="form-label">Tanggal Berangkat</label>
                <input type="date" name="tgl_berangkat" class="form-control" value="<?php echo $r['tgl_berangkat'] ?>"/>
            </div>

            <div class="col-md-2 mb-3">
                <label for="time" class="form-label">Jam Berangkat</label>
                <input type="time" name="jam_berangkat" class="form-control" placeholder="" value="<?php echo $r['jam_berangkat']  ?>"/>
            </div>
            <div class="col-md-8 mb-3">
                    <label>Nomor Polisi Mobil</label>
                    <select name="id_mobil" class="form-control">
                        <?php 
                            if($r['id_mobil'] == 0) {?>

                                <option value="0" selected>-- Nomor Polisi --</option>

                                <?php
                            }

                            $tampil = mysqli_query($db, "SELECT * FROM kendaraan");
                            while($a = mysqli_fetch_array($tampil)){
                                if ($r['id_mobil'] == $a['id_mobil']) { ?>
                                    <option value="<?php echo $a['id_mobil'] ?>" selected><?php echo $a['nomor_polisi'] ?></option>

                                    <?php
                                }else { ?>
                                    <option value="<?php echo $a['id_mobil'] ?>"><?php echo $a['nomor_polisi'] ?></option>

                                    <?php
                                }
                            }
                        ?>
                      
                    </select>
                </div>

            <div class="mb-3">
                <button type="submit" name="submit" class="btn btn-outline-primary"> Submit</button>

                <a href="dashboard.php?hal=jadwal" class="btn btn-outline-danger">Batal</a>
            </div>
            </form>

            <?php 
                if(isset($_POST['submit'])){
                    $id_asal = $_POST['id_asal'];
                    $id_destinasi = $_POST['id_destinasi'];
                    $harga = $_POST['harga'];
                    $tgl_berangkat = $_POST['tgl_berangkat'];
                    $jam_berangkat = $_POST['jam_berangkat'];
                    $id_mobil = $_POST['id_mobil'];
                    
                     mysqli_query($db, "UPDATE jadwal SET id_asal='$id_asal', id_destinasi='$id_destinasi', harga='$harga', tgl_berangkat='$tgl_berangkat', jam_berangkat='$jam_berangkat', id_mobil='$id_mobil' WHERE id_jadwal='$id'");

                     echo "<script>alert('Data Jadwal Berhasil Diperbarui'); window.location = 'dashboard.php?hal=jadwal'</script>";
                }
            ?>
        </div>
    </div>
    </div>
</div>