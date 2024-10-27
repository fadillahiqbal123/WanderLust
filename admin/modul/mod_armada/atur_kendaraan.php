<div class="container">
    <h3><strong>Form Atur Kendaraan</strong></h3>
     <div class="card">
        <div class="card-header">
         <a href="dashboard.php?hal=tambah_kendaraan" class="btn btn-outline-success" class="btn btn-outline-success" style="width: 100x; height: 30px; font-size: 12px;"><i class="bi bi-plus-lg"></i> Create</a>
        </div>
        <div class="card-body">
               <table id="example" class="display" style="height: 50px; font-size: 13px;">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Jenis Mobil</th>
                        <th>Nomor Polisi</th>
                        <th>Warna Mobil</th>
                        <th>Aksi</th>
 
                     </tr>
                  </thead>
                  <tbody>
                     <?php  
                     $sql = mysqli_query($db, "SELECT * FROM kendaraan");
                     while($r = mysqli_fetch_array($sql)){

                  ?>
                     <tr>
                        <td></td>
                        <td><?php echo $r['jenis_mobil'] ?></td>
                        <td><?php echo $r['nomor_polisi'] ?></td>
                        <td><?php echo $r['warna_mobil'] ?></td>
                        
                        <td>
                           <a href="dashboard.php?hal=edit_kendaraan&id=<?php echo $r['id_mobil'] ?>" class="btn btn-outline-warning" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a>

                           <a href="dashboard.php?hal=hapus_kendaraan&id=<?php echo $r['id_mobil'] ?>" class="btn btn-outline-danger" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></a>
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