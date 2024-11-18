<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header mt-3 mb-3">
                <h2>Input Tanggal Laporan</h2>
            </div>
            <div class="card-body mt-3">
                
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="awal">Masukkan Tanggal Awal</label>
                                <input type="date" name="awal" id="awal" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="akhir">Masukkan Tanggal Akhir</label>
                                <input type="date" name="akhir" id="akhir" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group mt-4">
                                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                                <a href="dashboard.php?hal=laporan" class="btn btn-success"><i class="bi bi-recycle"></i> Clear</a>
                                <a href="javascript:void(0)" class="btn btn-warning" onclick="printReport()"><i class="bi bi-floppy-fill"></i> Download</a>
                            </div>
                        </div>
                    </div>
                </form>

                <?php
                // Ambil nilai tanggal dari form
                $tglawal = isset($_POST["awal"]) ? $_POST["awal"] : '';
                $tglakhir = isset($_POST["akhir"]) ? $_POST["akhir"] : '';
                ?>

                <!-- Tampilkan Laporan -->
                <h2>Laporan Periode <?php echo $tglawal ?> s/d <?php echo $tglakhir ?></h2>

                <div class='panel panel-default'>
                    <!-- Wrap the table in a container with an ID -->
                    <div id="printableArea">
                        <table id="example" class="display table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>ID Pesan</td>
                                    <td>Jadwal</td>
                                    <td>Tanggal Berangkat</td>
                                    <td>Tanggal Transfer</td>
                                    <td>Nama User</td>
                                    <td>No Resi</td>
                                    <td>Harga (Rp.)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                error_reporting(E_ALL);
                                ini_set('display_errors', 1);
                                $subtotal = 0;

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
                                while ($r = mysqli_fetch_array($hasil)) {
                                    $harga = $r['harga'];
                                    $subtotal += $harga;
                                    echo "
                                    <tr>
                                        <td></td>
                                        <td>{$r['id_pesan']}</td>
                                        <td>{$r['alamat']} - {$r['nama_destinasi']}</td>
                                        <td>{$r['tgl_berangkat']}</td>
                                        <td>{$r['tgl_transfer']}</td>
                                        <td>{$r['username']}</td>
                                        <td>{$r['no_resi']}</td>
                                        <td>{$r['harga']}</td>
                                    </tr>";
                                }

                                ?>
                            </tbody>
                        </table>
                    </div> <!-- End of printableArea -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  function printReport() {
    var printContent = document.getElementById("printableArea").innerHTML;
    var originalContent = document.body.innerHTML;

    // Set content to print only the report
    document.body.innerHTML = printContent;

    window.print();

    // Restore the original content
    document.body.innerHTML = originalContent;
  }
</script>


<style>
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
</style>
