<?php


$query = "SELECT * 
          FROM pesan 
          JOIN transaksi ON transaksi.id_pesan = pesan.id_pesan
          JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
          JOIN user ON pesan.id_user = user.id_user
          JOIN asal ON jadwal.id_asal = asal.id_asal
          JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
          WHERE pesan.status = 'Belum Bayar'";

$result = mysqli_query($db, $query);
?>

<div class="container-fluid">
    <div class="row mt-3">
    <h3><strong>Form Konfirmasi Pesanan</strong></h3>
    <div class="card">
        <div class="card-header">
        <h5><strong>Data Pesanan Belum Bayar</strong></h5> 
        </div>
        <div class="card-body">
            <table id="example" class="display">
                <thead>
                    <tr>         
                        <th>No</th>
                        <th>No Resi</th>
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
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['no_resi'] . "</td>";
                        echo "<td>" . $row['tgl_transfer'] . "</td>";
                        echo "<td>" . $row['jam_transfer'] . "</td>";
                        echo "<td>" . $row['id_pesan'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['harga'] . "</td>";
                        echo "<td>
                                <a href='dashboard.php?hal=perbarui_belumBayar&id=" . $row['no_resi'] . "' class='btn btn-outline-secondary'><i class='fa-sharp fa-solid fa-file-pen'></i></a>
                                <a href='dashboard.php?hal=hapus_belumbayar&id=" . $row['no_resi'] . "' class='btn btn-outline-danger'><i class='fa-solid fa-trash'></i></a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
