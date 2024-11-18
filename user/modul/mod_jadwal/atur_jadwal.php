
<div class="container-fluid">
    <h4>Form Atur Jadwal</h4>
    <div class="card mt-4">
    <div class="card-header">
        <a href="dashboard.php?hal=tambah_jadwal" class="btn btn-outline-success" style="width: 100px; height: 30px; font-size: 12px;"><i class="bi bi-plus-lg"></i> Create</a>
    </div>
    <div class="card-body">
        <table id= "example" class="display" style="height: 50px; font-size: 13px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Jadwal</th>
                    <th>Alamat Keberangkatan</th>
                    <th>Tujuan Destinasi</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Nomor Polisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 

             $sql = mysqli_query($db, "SELECT jadwal.id_jadwal, asal.alamat AS alamat_keberangkatan, destinasi.nama_destinasi, jadwal.harga, jadwal.tgl_berangkat, jadwal.jam_berangkat, kendaraan.nomor_polisi 
                FROM jadwal 
                JOIN asal ON jadwal.id_asal = asal.id_asal 
                JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
                JOIN kendaraan ON jadwal.id_mobil = kendaraan.id_mobil
                ORDER BY jadwal.id_jadwal DESC");

                while($r = mysqli_fetch_assoc($sql)){   
?>
                <tr>
                    <td></td>
                    <td><?php echo $r['id_jadwal'] ?></td>
                    <td><?php echo $r['alamat_keberangkatan'] ?></td>
                    <td><?php echo $r['nama_destinasi'] ?></td>
                    <td><?php echo $r['harga'] ?></td>
                    <td><?php echo date('d m Y', strtotime($r['tgl_berangkat'])) ?></td>
                    <td><?php echo $r['jam_berangkat'] ?></td>
                    <td><?php echo $r['nomor_polisi'] ?></td>
                    <td>
                        <a href="dashboard.php?hal=edit_jadwal&id=<?php echo $r['id_jadwal'] ?>" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a>

                        <a href="dashboard.php?hal=hapus_jadwal&id=<?php echo $r['id_jadwal'] ?>" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></a>
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


