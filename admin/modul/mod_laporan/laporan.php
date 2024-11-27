<?php

include "koneksi.php";


$tglawal = isset($_POST["awal"]) ? $_POST["awal"] : '';
$tglakhir = isset($_POST["akhir"]) ? $_POST["akhir"] : '';

$hasil = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if (empty($tglawal) || empty($tglakhir)) {
        echo "<script>alert('Tanggal awal dan akhir harus diisi!');</script>";
    } else {
       
        $sql = "SELECT * 
                FROM transaksi, user, pesan, jadwal, asal, destinasi, kendaraan 
                WHERE kendaraan.id_mobil = jadwal.id_mobil 
                AND user.id_user = pesan.id_user 
                AND pesan.id_jadwal = jadwal.id_jadwal 
                AND jadwal.id_asal = asal.id_asal 
                AND jadwal.id_destinasi = destinasi.id_destinasi 
                AND transaksi.id_pesan = pesan.id_pesan 
                AND status = 'Lunas' 
                AND tgl_transfer BETWEEN '$tglawal' AND '$tglakhir'";
        $hasil = mysqli_query($db, $sql);
    }
}
?>



<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header mt-3 mb-3">
                <h2>Laporan Pelunasan</h2>
            </div>
            <div class="card-body mt-3">
                
            <form method="POST" action="">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="awal">Masukkan Tanggal Awal</label>
                <input type="date" name="awal" id="awal" class="form-control" value="<?php echo isset($_POST['awal']) ? $_POST['awal'] : ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="akhir">Masukkan Tanggal Akhir</label>
                <input type="date" name="akhir" id="akhir" class="form-control" value="<?php echo isset($_POST['akhir']) ? $_POST['akhir'] : ''; ?>">
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
            <a href="dashboard.php?hal=laporan" class="btn btn-success"><i class="bi bi-recycle"></i> Clear</a>
           
            <?php if (!empty($_POST['awal']) && !empty($_POST['akhir'])): ?>
                <a href="modul/mod_laporan/preview.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" 
                   class="btn btn-warning"
                   target="_blank">
                    <i class="bi bi-file-earmark-pdf"></i> Download PDF
                </a>
            <?php endif; ?>
        </div>
    </div>
</form>



                
<h3>Laporan Periode <?php echo isset($_POST['awal']) ? $_POST['awal'] : '-'; ?> s/d <?php echo isset($_POST['akhir']) ? $_POST['akhir'] : '-'; ?></h3>

<div class='panel panel-default'>
    <div id="printableArea">
        <table id="example" class="display table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pesan</th>
                    <th>Jadwal</th>
                    <th>Tanggal Berangkat</th>
                    <th>Tanggal Transfer</th>
                    <th>Nama User</th>
                    <th>No Resi</th>
                    <th>Harga (Rp.)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['awal']) && !empty($_POST['akhir'])) {
                    include 'koneksi.php';

                    $tgl_awal = $_POST['awal'];
                    $tgl_akhir = $_POST['akhir'];

                    $query = "
                        SELECT 
                            transaksi.id_pesan, 
                            asal.alamat, 
                            destinasi.nama_destinasi, 
                            jadwal.tgl_berangkat, 
                            transaksi.tgl_transfer, 
                            user.username, 
                            transaksi.no_resi, 
                            jadwal.harga
                        FROM transaksi
                        JOIN pesan ON transaksi.id_pesan = pesan.id_pesan
                        JOIN user ON pesan.id_user = user.id_user
                        JOIN jadwal ON pesan.id_jadwal = jadwal.id_jadwal
                        JOIN asal ON jadwal.id_asal = asal.id_asal
                        JOIN destinasi ON jadwal.id_destinasi = destinasi.id_destinasi
                        WHERE transaksi.tgl_transfer BETWEEN '$tgl_awal' AND '$tgl_akhir'
                        ORDER BY transaksi.tgl_transfer";

                    $hasil = mysqli_query($db, $query);
                    if (mysqli_num_rows($hasil) > 0) {
                        $subtotal = 0;
                        $no = 1;

                        while ($r = mysqli_fetch_array($hasil)) {
                            $subtotal += $r['harga'];
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $r['id_pesan']; ?></td>
                                <td><?php echo $r['alamat'] . " - " . $r['nama_destinasi']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($r['tgl_berangkat'])); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($r['tgl_transfer'])); ?></td>
                                <td><?php echo $r['username']; ?></td>
                                <td><?php echo $r['no_resi']; ?></td>
                                <td><?php echo number_format($r['harga'], 0, ',', '.'); ?></td>
                            </tr>
                            <?php
                        }
                    } }

                ?>
            </tbody>
        </table>
    </div>
</div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("btnDownload").addEventListener("click", function() {

        const awal = document.getElementById("awal").value;
        const akhir = document.getElementById("akhir").value;

        if (awal && akhir) {
            const url = `priview.php?awal=${awal}&akhir=${akhir}`;
            window.location.href = url;
        } else {
            alert("Harap pilih Tanggal awal dan akhir terlebih dahulu");
        }
    });
});
</script> -->


<!-- <style>
  @media print {
    
    body * {
      visibility: hidden;
    }

    #printableArea, #printableArea * {
      visibility: visible;
    }

    #printableArea {
      position: absolute;
      left: 0;
      top: 0;
    }
  }
</style> -->
