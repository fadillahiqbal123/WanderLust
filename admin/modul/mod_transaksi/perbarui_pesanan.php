<div class="container-fluid">
    <div class="row mt-3 w-100">
        <div class="card">
            <div class="card-header">
                <strong>Table Perbarui Pesanan</strong>
            </div>
            <div class="card-body">
                <?php  
                // Ambil no_resi dari URL dan pastikan ada
                if (isset($_GET['no_resi'])) {
                    $no_resi = $_GET['no_resi'];

                    // Query untuk mengambil data berdasarkan no_resi dari tabel transaksi
                    $sql = mysqli_query($db, "SELECT * FROM transaksi WHERE no_resi='$no_resi'");
                    $r = mysqli_fetch_array($sql);

                    // Cek jika data ditemukan
                    if ($r) {
                ?>
                    <form action="" method="POST">
                        <div class="col-md-5 mb-3">
                            <label for="no_kursi" class="form-label">Nomor Kursi</label>
                            <input type="text" name="no_kursi" id="no_kursi" class="form-control" placeholder="" value="<?php echo $r['no_kursi']; ?>"/>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input mt-0" type="checkbox" name="belum_bayar" value="1" <?php echo ($r['status'] == 'belum_bayar') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Belum Bayar</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input mt-0" type="checkbox" name="dalam_proses" value="1" <?php echo ($r['status'] == 'dalam_proses') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Dalam Proses</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input mt-0" type="checkbox" name="lunas" value="1" <?php echo ($r['status'] == 'lunas') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Lunas</label>
                        </div>

                        <!-- Row untuk dua kolom sejajar -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="alamat" class="form-label">Alamat Keberangkatan</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="" value="<?php echo $r['alamat']; ?>"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tujuan_destinasi" class="form-label">Tujuan Destinasi</label>
                                <input type="text" name="nama_destinasi" id="nama_destinasi" class="form-control" placeholder="" value="<?php echo $r['nama_destinasi']; ?>"/>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tgl_transfer" id="tanggal" class="form-control" placeholder="" value="<?php echo $r['tgl_transfer']; ?>"/>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control" placeholder="" value="<?php echo $r['harga']; ?>"/>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_resi" class="form-label">No Resi</label>
                            <input type="text" name="no_resi" id="no_resi" class="form-control" placeholder="" value="<?php echo $r['no_resi']; ?>"/>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="id_pesan" class="form-label">Id Pesan</label>
                            <input type="text" name="id_pesan" id="id_pesan" class="form-control" placeholder="" value="<?php echo $r['id_pesan']; ?>"/>
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" name="submit" class="btn btn-outline-primary"> Submit</button>
                        </div>
                    </form>

                    <?php  
                    if(isset($_POST['submit'])){
                        // Mengambil data dari form
                        $no_kursi = $_POST['no_kursi'];
                        $alamat_keberangkatan = $_POST['alamat'];
                        $tujuan_destinasi = $_POST['nama_destinasi'];
                        $tanggal = $_POST['tgl_transfer'];
                        $harga = $_POST['harga'];
                        $no_resi = $_POST['no_resi'];
                        $id_pesan = $_POST['id_pesan'];

                        // Menentukan status berdasarkan checkbox
                        $status = '';
                        if (isset($_POST['belum_bayar'])) {
                            $status = 'belum_bayar';
                        } elseif (isset($_POST['dalam_proses'])) {
                            $status = 'dalam_proses';
                        } elseif (isset($_POST['lunas'])) {
                            $status = 'lunas';
                        }

                        // Melakukan update pada tabel transaksi
                        mysqli_query($db, "UPDATE transaksi SET no_kursi='$no_kursi', alamat='$alamat_keberangkatan', tujuan_destinasi='$tujuan_destinasi', tgl_transfer='$tanggal', harga='$harga', no_resi='$no_resi', id_pesan='$id_pesan', status='$status' WHERE no_resi='$no_resi'");

                        echo "<script>alert('Pesanan Berhasil Diperbarui'); window.location = 'dashboard.php?hal=konfirmasi-pesan'</script>";
                    }
                    ?>
                <?php
                    } else {
                        echo "<p class='text-danger'>Data tidak ditemukan untuk no_resi: $no_resi</p>";
                    }
                } else {
                    echo "<p class='text-danger'>No Resi tidak diberikan.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
