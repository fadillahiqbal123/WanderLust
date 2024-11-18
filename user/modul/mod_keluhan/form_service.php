<?php
include "koneksi.php";

?>
<div class="container-fluid mt-3 pt-2">
        <div class="col lg-10">
            <h3>Keluhan Pelanggan</h3>
            <hr>
           
            <div class="container">
                <table class="table table-border table-striped mt-3" style="height: 50px; font-size: 15px;">   
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Judul Keluhan</th>
                            <th>Deskripsi Keluhan</th>
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
                             
                            </tr>
                            <?php  
                    }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

