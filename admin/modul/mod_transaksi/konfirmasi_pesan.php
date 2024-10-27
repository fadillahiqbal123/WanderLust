<div class="container">
    <h3>Konfirmasi Pemesanan</h3>
    <div class="card">
        <div class="card-body">
            <table id="example" class="display" style="height: 50px; font-size: 13px;">
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
                  $sql = mysqli_query($db,"SELECT * FROM transaksi 
                     JOIN pesan ON transaksi.id_pesan = pesan.id_pesan
                     JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
                     JOIN user ON pesan.id_user = user.id_user
                     JOIN asal ON jadwal.id_asal = asal.id_asal
                     JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi");

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
                            <a href="dashboard.php?hal=perbarui_pesanan&id=<?php echo $r['no_resi'] ?>" class="btn btn-outline-secondary"> Update</a>
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