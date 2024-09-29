<div class="container-fluid">
    <div class="card mt-4">
    <div class="card-header">
        <a href="dashboard.php?hal=tambah_wisata" class="btn btn-outline-primary"><i class="bi bi-plus-lg"></i>Data Wisata</a>
    </div>
    <div class="card-body">
        <table id="example" class="display" style="width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Wisata</th>
                    <th>Kategori</th>
                    <th>Lokasi Wisata</th>
                    <th>Maps</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $sql = mysqli_query($db, "SELECT * FROM destinasi, kategori WHERE destinasi.id_kategori = kategori.id_kategori");
                    while($r= mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td></td>
                    <td><?php echo $r['nama_destinasi'] ?></td>
                    <td><?php echo $r['nama_kategori']?></td>
                    <td><?php echo $r['lokasi_wisata'] ?></td>
                    <td>
                        <iframe width="200" height="150" src="<?php echo $r['link_peta']?>" style="border: 1px solid black"></iframe>
                </td>
                <td>
                <a href="dashboard.php?hal=edit_wisata&id=<?php echo $r['id_destinasi'] ?>" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a>

                <a href="dashboard.php?hal=hapus_wisata&id=<?php echo $r['id_destinasi'] ?>" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></a>
                </td>
                </tr>
                <?php  
                    }
                ?>
                </tbody>
            </tbody>
        </table>
    </div>
    </div>
</div>