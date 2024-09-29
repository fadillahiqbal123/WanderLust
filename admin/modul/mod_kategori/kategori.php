<div clas="container-fluid">
    <div class="card mt-4">
        <div class="card-header">
        <a href="dashboard.php?hal=tambah_kategori" class="btn btn-outline-primary"><i class="bi bi-plus"></i>Data Kategori</a>
        </div>
        <div class="card-body">
                <table id="example" class="display" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $sql = mysqli_query($db, "SELECT * FROM kategori");
                              while($r = mysqli_fetch_array($sql)) {

                              

                         ?>
                        <tr>
                        <td></td>
                        <td><?php echo $r['nama_kategori'] ?> </td>
                        <td><?php echo $r['keterangan']   ?></td>
                        <td>
                            <a href="dashboard.php?hal=edit_kategori&id=<?php echo $r['id_kategori'] ?>" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a>

                            <a type="button" href="dashboard.php?hal=hapus_kategori&id=<?php echo $r['id_kategori']  ?>" title="hapus" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></a>
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