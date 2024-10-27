<?php
include "koneksi.php";

?>
<div class="container-fluid">
        <div class="col lg-10">
            <h2>Keluhan Pelanggan</h2>
            <hr>
            <a href="dashboard.php?hal=" class="btn btn-outline-primary">Tambah</a>
            <div class="container">
                <table class="table table-border table-striped mt-3" style="height: 50px; font-size: 12px;">   
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Judul Keluhan</th>
                            <th>Deskripsi Keluhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
    
                    <tbody>
                    
                    <?php
                      $no = 1; 
                      
                      $sql = mysqli_query($db, "SELECT * FROM saran, user WHERE saran.id_user = user.id_user");
                      while ($r= mysqli_fetch_array($sql)){

                       ?>

                                <tr>
                                    <td><?php $no++; ?></td>
                                    <td><?= $r['nama_user']; ?></td>
                                    <td><?= $r['judul_saran']; ?></td>
                                    <td><?= $r['detail_saran']; ?></td> 
                                    <td>
                                        <a href="dashboard.php?hal=edit_keluhan" title="edit" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>

                                        <a href="dashboard.php?hal=hapus_keluhan" title="hapus" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                    </td>
                             
                            </tr>
                            <?php  
                    }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

