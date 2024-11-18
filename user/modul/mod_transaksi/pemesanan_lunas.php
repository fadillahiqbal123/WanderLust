<?php
include 'koneksi.php';

// Query untuk mengambil data pesanan yang statusnya lunas
$query = "SELECT * 
          FROM pesan 
          JOIN transaksi ON transaksi.id_pesan = pesan.id_pesan
          JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
          JOIN user ON pesan.id_user = user.id_user
          JOIN asal ON jadwal.id_asal = asal.id_asal
          JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
          WHERE pesan.status = 'lunas'";

$result = mysqli_query($db, $query);
?>

<div class="container-fluid">
    <div class="row mt-3">
    <div class="card">
        <div class="card-header">
        <h3><strong>Form Konfirmasi Pesanan</strong></h3> 
        </div>
        <div class="card-body">
            <table id="example" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Pemesanan</th>
                        <th>Status</th>
                        <th>Nama User</th>
                        <th>Jadwal</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>No Kursi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td>" . $row['id_pesan'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['alamat'] . "-" . $row['nama_destinasi'] . "</td>";
                        echo "<td>" . $row['tgl_transfer'] . "</td>";
                        echo "<td>" . $row['harga'] . "</td>";
                        echo "<td>" . $row['no_kursi'] . "</td>";
                        echo "<td>
                                <a href='#' class='btn btn-outline-success'><i class='bi bi-pencil-square'></i></a>
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
