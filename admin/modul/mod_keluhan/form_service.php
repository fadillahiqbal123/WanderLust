<?php
include "koneksi.php";


function select($query) {
    global $db;

    $result = mysqli_query($db, $query);
    if (!$result) {
        die("Query gagal: " . mysqli_error($db)); // Menampilkan pesan error jika query gagal
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

$data_keluhan = select("SELECT * FROM saran");

?>
<div class="container-fluid">
        <div class="col lg-10">
            <h2>Keluhan Pelanggan</h2>
            <hr>
            <a href="" class="btn btn-primary">Tambah</a>
            <div class="container">
                <table class="table table-border table-striped mt-3">   
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
                        <?php if (!empty($data_keluhan)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data_keluhan as $keluhan) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $keluhan['nama_user']; ?></td>
                                    <td><?= $keluhan['judul_saran']; ?></td>
                                    <td><?= $keluhan['detail_saran']; ?></td> 
                                    <td>
                                        <a href="dashboard.php?hal=edit_keluhan" title="edit" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>

                                        <a href="dashboard.php?hal=hapus_keluhan&id=<?= $keluhan['id_keluhan']; ?>" title="hapus" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data keluhan yang ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

