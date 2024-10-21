<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header">
            <a href="dashboard.php?hal=tambah_galeri" class="btn btn-outline-primary"><i class="bi bi-clipboard2-plus-fill"></i></a>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped">
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
                        while($r = mysqli_fetch_array($sql)){ 
                            $foto_data = base64_encode($r['nama_foto']); // Enkode gambar
                            $foto_type = 'image/jpeg'; // Sesuaikan dengan tipe gambar di database (jpeg, png, dll.)
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut -->
                                <td><?php echo $r['keterangan_foto']; ?></td>
                                <td><?php echo $r['nama_destinasi']; ?></td>
                                <td>
                                    <img src="data:<?php echo $foto_type; ?>;base64,<?php echo $foto_data; ?>" height="100" width="200" alt="Foto Destinasi">
                                </td>
                                <td>
                                    <a href="dashboard.php?hal=edit_galeri&id=<?php echo $r['id_galeri'] ?>" class="btn btn-outline-success" title="edit"><i class="bi bi-pencil-square"></i></a>

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
