<?php  
include "koneksi.php";

if (isset($_GET['id'])) {
    $no_resi = $_GET['id'];

    $sql = "
    SELECT * 
    FROM transaksi, pesan, jadwal, asal, destinasi, user 
    WHERE transaksi.id_pesan = pesan.id_pesan
    AND pesan.id_jadwal = jadwal.id_jadwal
    AND pesan.id_user = user.id_user
    AND jadwal.id_asal = asal.id_asal
    AND jadwal.id_destinasi = destinasi.id_destinasi
    AND transaksi.no_resi = '$no_resi'
    AND pesan.status = 'Dalam Proses'
";


    $result = mysqli_query($db, $sql);
    $r = mysqli_fetch_array($result);

    if ($r) {
?>
        <div class="container">
            <div class="row mt-2 pt-2">
                <div class="card">
                    <div class="card-header">
                        <h3>Konfirmasi Pesanan</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">

                            <!-- Asal dan Destinasi dalam satu baris -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="asal" class="form-label">Kota Asal</label>
                                    <input type="text" name="asal" id="asal" class="form-control" value="<?php echo $r['alamat']; ?>" readonly/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="destinasi" class="form-label">Kota Tujuan</label>
                                    <input type="text" name="destinasi" id="destinasi" class="form-control" value="<?php echo $r['nama_destinasi']; ?>" readonly/>
                                </div>
                            </div>

                            <!-- Nomor Kursi -->
                            <div class="col-md-6 mb-3">
                                <label for="no_kursi" class="form-label">Nomor Kursi</label>
                                <input type="text" name="no_kursi" id="no_kursi" class="form-control" value="<?php echo $r['no_kursi']; ?>" readonly/>
                            </div>

                            <!-- Tanggal Berangkat -->
                            <div class="col-md-6 mb-3">
                                <label for="tgl_berangkat" class="form-label">Tanggal Berangkat</label>
                                <input type="date" name="tgl_berangkat" id="tgl_berangkat" class="form-control" value="<?php echo $r['tgl_berangkat']; ?>" readonly/>
                            </div>

                            <!-- Harga -->
                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" name="harga" id="harga" class="form-control" value="<?php echo $r['harga']; ?>" readonly/>
                            </div>

                            <!-- Status Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status[]" value="belum_bayar" <?php echo (in_array('belum_bayar', explode(',', $r['status']))) ? 'checked' : ''; ?>>
                                <label class="form-check-label">Belum Bayar</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status[]" value="dalam_proses" <?php echo (in_array('dalam_proses', explode(',', $r['status']))) ? 'checked' : ''; ?>>
                                <label class="form-check-label">Dalam Proses</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status[]" value="lunas" <?php echo (in_array('lunas', explode(',', $r['status']))) ? 'checked' : ''; ?>>
                                <label class="form-check-label">Lunas</label>
                            </div>

                            <!-- No Resi dan Username -->
                            <div class="col-md-6 mb-3">
                                <label for="no_resi" class="form-label">No Resi</label>
                                <input type="text" name="no_resi" id="no_resi" class="form-control" value="<?php echo $r['no_resi']; ?>" readonly/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $r['username']; ?>" readonly/>
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-outline-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php  
        if (isset($_POST['submit'])) {
            $status = isset($_POST['status']) ? implode(',', $_POST['status']) : '';

            $update_sql = "UPDATE pesan SET status='$status' WHERE id_pesan='" . $r['id_pesan'] . "'";
            if (mysqli_query($db, $update_sql)) {
                echo "<script>alert('Status Pesanan Berhasil Diperbarui'); window.location = 'dashboard.php?hal=konfirmasi-pesan'</script>";
            } else {
                echo "<p class='text-danger'>Gagal memperbarui status pesanan.</p>";
            }
        }
    } else {
        echo "<p class='text-danger'>Data tidak ditemukan untuk no_resi: $no_resi</p>";
    }
} else {
    echo "<p class='text-danger'>No Resi tidak diberikan.</p>";
}
?>
