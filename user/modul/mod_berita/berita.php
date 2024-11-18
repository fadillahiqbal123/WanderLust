<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header">
            <a href="dashboard.php?hal=tambah_berita" class="btn btn-outline-success" style="width: 100px; height: 30px; font-size: 12px;"><i class="bi bi-plus"></i> Create</a>
        </div>
        <div class="card-body">
        <table id="example" class="display" style="height: 50px; font-size: 12px;">
        <thead>
            <tr>
                <th></th>
                <th>Judul Berita</th>
                <th>Penulis</th>
                <th>Tanggal Uploaded</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = mysqli_query($db, "SELECT * FROM berita, admin WHERE berita.id_admin=admin.id_admin");
            while($r = mysqli_fetch_array($sql)) {
            
            ?>

            <tr>
                <td></td>
                <td><?php echo $r['judul_berita'];  ?></td>
                <td><?php echo $r['nama_admin'] ?></td>
                <td><?php echo date('d-m-Y',strtotime($r['tgl_berita'])) ?></td>
                <td><img src="././img_berita/<?php echo $r['foto_berita'] ?>" height="100" width="150"></td>
                <td>
                  <a type="button" class="btn btn-outline-danger" title="Hapus" href="dashboard.php?hal=hapus_berita&id=<?php echo $r['id_berita'] ?>"><i class="bi bi-trash3-fill"></i></a>
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