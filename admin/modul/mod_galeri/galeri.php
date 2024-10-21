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
                        <th>Keterangan Foto/Video</th>
                        <th>Nama Wisata</th>
                        <th>Media</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data galeri beserta destinasi
                    $sql = mysqli_query($db, "SELECT * FROM galeri, destinasi WHERE galeri.id_destinasi = destinasi.id_destinasi");
                    $no = 1; // Inisialisasi nomor
                    while ($r = mysqli_fetch_array($sql)) {
                        $media_data = base64_encode($r['nama_foto']); // Enkode file
                        $keterangan_foto = $r['keterangan_foto'];
                        $nama_destinasi = $r['nama_destinasi'];

                        // Deteksi apakah file adalah video atau gambar berdasarkan ekstensinya
                        $file_info = finfo_open(FILEINFO_MIME_TYPE);
                        $file_type = finfo_buffer($file_info, $r['nama_foto']);
                        finfo_close($file_info);

                        // Tampilkan media
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut -->
                            <td><?php echo $keterangan_foto; ?></td>
                            <td><?php echo $nama_destinasi; ?></td>
                            <td>
                                <?php
                                if (strpos($file_type, 'image') !== false) {
                                    // Jika file adalah gambar
                                    echo '<img src="data:' . $file_type . ';base64,' . $media_data . '" height="100" width="200" alt="Foto Destinasi">';
                                } elseif (strpos($file_type, 'video') !== false) {
                                    // Jika file adalah video
                                    echo '<video width="200" controls>
                                            <source src="data:' . $file_type . ';base64,' . $media_data . '" type="video/mp4">
                                            Your browser does not support the video tag.
                                          </video>';
                                }
                                ?>
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