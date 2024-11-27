<div class="container">
    <div class="row mt-3 pt-2">
    <div class="card">
        <div class="card-header"><h4>Konfirmasi Pemesanan</h4></div>
        <div class="card-body">
            <table id="example" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Resi</th>
                        <th>No Rek</th>
                        <th>Tgl Transfer</th>
                        <th>Jam Transfer</th>
                        <th>Id Pemesanan</th>
                        <th>Status</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
            <?php 
            $sql = mysqli_query($db, "SELECT transaksi.*, transaksi.no_resi, transaksi.no_rek, transaksi.tgl_transfer, transaksi.jam_transfer, jadwal.harga, pesan.status
                FROM transaksi
                JOIN pesan ON transaksi.id_pesan = pesan.id_pesan
                JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
                WHERE pesan.status = 'Dalam Proses'"); 

            while($r = mysqli_fetch_array($sql)){   
            ?>
                    <tr>
                        <td></td>
                        <td><?php echo $r['no_resi'] ?></td>
                        <td><?php echo $r['no_rek'] ?></td>
                        <td><?php echo $r['tgl_transfer'] ?></td>
                        <td><?php echo $r['jam_transfer'] ?></td>
                        <td><?php echo $r['id_pesan'] ?></td>
                        <td><?php echo $r['status'] ?></td>
                        <td><?php echo $r['harga'] ?></td>
                        <td>
                            <a href="dashboard.php?hal=perbarui_pesanan&id=<?php echo $r['no_resi'] ?>" class="btn btn-outline-secondary"> <i class="fa-sharp fa-solid fa-file-pen"></i></a>
                            <a href="dashboard.php?hal=hapus_pesanan&id=<?php echo $r['no_resi'] ?>" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
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
</div>