<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header">
            <a href="dashboard.php?hal=tambah_galeri" class="btn btn-outline-success" style="width: 100px; height: 30px; font-size: 12px;"><i class="bi bi-clipboard2-plus-fill"></i> Create</a>
        </div>
        <div class="card-body">
            <table id="example" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan Foto</th>
                        <th>Nama Wisata</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                        $sql = mysqli_query($db, "SELECT * FROM galeri, destinasi WHERE galeri.id_destinasi = destinasi.id_destinasi");
                        $no = 1; // Inisialisasi nomor
                        while($r = mysqli_fetch_array($sql)){ ?>
                            <tr>
                                <td></td>
                                <td><?php echo $r['keterangan_foto']; ?></td>
                                <td><?php echo $r['nama_destinasi']; ?></td>
                                <td><img src="././img_galeri/<?php echo $r['nama_foto']; ?>" height="100" width="200" alt="Foto Destinasi"></td>
                                <td>
                                    <a href="dashboard.php?hal=edit_galeri&id=  galeri'] ?>" class="btn btn-outline-success" title="edit"><i class="bi bi-pencil-square"></i></a>

                                    <a href="dashboard.php?hal=hapus_galeri&id=<?php echo $r['id_galeri'] ?>" class="btn btn-outline-danger" title="hapus data"><i class="bi bi-trash3-fill"></i></a>
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
