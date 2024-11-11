<div class="container-fluid">
    <div class="row">
    <div class="card mt-3">
        <div class="card-header"><strong>Form Tambah Jadwal</strong></div>
        <div class="card-body">
            <form action="" method="POST">

            <div class="col-md-8 mb-3">
            <label>Keberangkatan</label>
             <select class="form-control" name="id_asal" id="id_asal">
                 <option value="0" selected>-- Pilih Alamat Keberangkatan --</option>
                 
                 <?php
                    $sql = mysqli_query($db, "SELECT * FROM asal ORDER BY id_asal ASC");
                    while($r = mysqli_fetch_array($sql)){  ?>

                        <option value="<?php echo $r['id_asal'] ?>"><?php echo $r['alamat'] ?></option>  
                    <?php
                     }
                ?> 
        </select>
        </div>
            
        <div class="col-md-8 mb-3">
            <label>Destinasi Wisata</label>
             <select class="form-control" name="id_destinasi" id="id_destinasi">
                 <option value="0" selected>--Pilih Destinasi Wisata--</option>
                 
                 <?php
                    $sql = mysqli_query($db, "SELECT * FROM destinasi   ORDER BY id_destinasi ASC");
                    while($r = mysqli_fetch_array($sql)){  ?>

                        <option value="<?php echo $r['id_destinasi'] ?>"><?php echo $r['nama_destinasi'] ?></option>  
                    <?php
                     }
                ?> 
        </select>
        </div>

            <div class="col-md-5 mb-3">
                <label class="form-label">Harga</label>
                <input type="text" name="harga" class="form-control" placeholder=""/>
            </div>

            <div class="col-md-2 mb-3">
                <label for="date" class="form-label">Tanggal Berangkat</label>
                <input type="date" name="tgl_berangkat" class="form-control" placeholder=""/>
            </div>

            <div class="col-md-2 mb-3">
                <label for="time" class="form-label">Jam Berangkat</label>
                <input type="time" name="jam_berangkat" class="form-control" placeholder=""/>
            </div>

            <div class="col-md-2 mb-3">
            <label>Nomor Polisi</label>
             <select class="form-control" name="id_mobil" id="id_mobil">
                 <option value="0" selected>--Pilih Nomor Polisi--</option>
                 
                 <?php
                    $sql = mysqli_query($db, "SELECT * FROM kendaraan ORDER BY id_mobil ASC");
                    while($r = mysqli_fetch_array($sql)){  ?>

                        <option value="<?php echo $r['id_mobil'] ?>"><?php echo $r['nomor_polisi'] ?></option>  
                    <?php
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
                    
                     mysqli_query($db, "INSERT INTO jadwal (id_asal,id_destinasi,harga,tgl_berangkat,jam_berangkat, id_mobil) VALUES ('$id_asal', '$id_destinasi', '$harga', '$tgl_berangkat', '$jam_berangkat', '$id_mobil')");

                     echo "<script>alert('Data Jadwal Berhasil Ditambahkan'); window.location = 'dashboard.php?hal=jadwal'</script>";
                }
            ?>
        </div>
    </div>
    </div>
</div>