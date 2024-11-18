<div class="container">
    <h3><strong>Form Atur Alamat</strong></h3>
     <div class="card">
        <div class="card-header">
        <a href="dashboard.php?hal=tambah_alamat" class="btn btn-outline-success" style="width: 100px; height: 30px; font-size: 12px;"><i class="bi bi-plus-lg"></i> Create</a>
        </div>
        <div class="card-body">
               <table id="example" class="display" style="height: 50px; font-size: 12px;">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Id Asal Kabupaten</th>
                        <th>Nama Admin</th>
                        <th>Alamat Kabupaten Jember</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php  
                     $sql = mysqli_query($db, "SELECT * FROM asal, admin WHERE asal.id_admin = admin.id_admin");
                     while ($r = mysqli_fetch_array($sql)){
                     ?>
                     <tr>
                        <td></td>
                        <td><?php echo $r['id_asal'] ?></td>
                        <td><?php echo $r['nama_admin'] ?></td>
                        <td><?php echo $r['alamat'] ?></td>
                        <td>        
                           <a href="dashboard.php?hal=edit_alamat&id=<?php echo $r['id_asal'] ?>" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a>

                           <a href="dashboard.php?hal=hapus_alamat&id=<?php echo $r['id_asal'] ?>" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></a>
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