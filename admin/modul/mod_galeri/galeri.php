<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header">
            <a href="dashboard.php?hal=tambah_galeri" class="btn btn-outline-primary"><i class="bi bi-plus"></i>Tambah Data Galeri</a>
        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan Foto</th>
                        <th>Nama Wisata</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = mysqli_query($db, "SELECT * FROM galeri, destinasi WHERE galeri.id_destinasi = destinasi.id_destinasi");
                        $no = 1;
                        while ($r = mysqli_fetch_array($sql)) {
                     ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $r['keterangan_foto'] ?></td>
                            <td><?php echo $r['nama_destinasi'] ?></td>
                            <td><img src="././img_galeri/<?php echo $r['nama_foto'] ?>" height="100" width="100"></td>
                         </tr>
                            <?php
                        }
                    ?>
                    <tr>
                       
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>