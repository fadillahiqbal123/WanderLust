<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

function koneksidatabase() {
    include('koneksi.php');
    return $db;
}

$db = koneksidatabase();


if (!$db) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$idp = $_GET['idp']; 

$no_resi = isset($_POST['no_resi']) ? mysqli_real_escape_string($db, $_POST['no_resi']) : '';
$no_rek = isset($_POST['no_rek']) ? mysqli_real_escape_string($db, $_POST['no_rek']) : NULL;
$tgl_transfer = isset($_POST['tgl_transfer']) ? mysqli_real_escape_string($db, $_POST['tgl_transfer']) : '';
$jam_transfer = isset($_POST['jam_transfer']) ? mysqli_real_escape_string($db, $_POST['jam_transfer']) : '';
$id_pesan = isset($_POST['id_pesan']) ? mysqli_real_escape_string($db, $_POST['id_pesan']) : '';
$status = isset($_POST['status']) ? mysqli_real_escape_string($db, $_POST['status']) : '';

if (empty($no_resi) || empty($tgl_transfer) || empty($jam_transfer)) {
    echo "<script>alert('Semua field yang diperlukan harus terisi'); window.location = 'konfirmasipembayaran.php'</script>";
    exit;
}


$result = "SELECT * FROM transaksi WHERE no_resi='$no_resi'";
$check = mysqli_query($db, $result) or die(mysqli_error($db));
$fetch_resi = mysqli_num_rows($check);

if ($fetch_resi == 1) {
    echo "<script>alert('No resi yang Anda masukkan sudah ada'); window.location = 'konfirmasipembayaran.php'</script>";    
    exit;
}


$check_pesan = "SELECT * FROM pesan WHERE id_pesan=?";
$stmt = mysqli_prepare($db, $check_pesan);
mysqli_stmt_bind_param($stmt, 'i', $id_pesan); // Bind parameter untuk query
mysqli_stmt_execute($stmt);
$result_check_pesan = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result_check_pesan) == 0) {
    echo "<script>alert('ID Pesan yang Anda masukkan tidak ditemukan di database'); window.location = 'konfirmasipembayaran.php'</script>";
    exit;
} else {
    // Query untuk INSERT ke tabel transaksi menggunakan prepared statement
    $sql = "INSERT INTO transaksi (no_resi, no_rek, tgl_transfer, jam_transfer, id_pesan) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt_insert, 'ssssi', $no_resi, $no_rek, $tgl_transfer, $jam_transfer, $id_pesan);

    if (mysqli_stmt_execute($stmt_insert)) {
        // Jika INSERT berhasil, lakukan UPDATE status di tabel pesan
        $sql1 = "UPDATE pesan SET status=? WHERE id_pesan=?";
        $stmt_update = mysqli_prepare($db, $sql1);
        mysqli_stmt_bind_param($stmt_update, 'si', $status, $id_pesan); // Bind parameter untuk status

        if (mysqli_stmt_execute($stmt_update)) {
            echo "<script>alert('Terima kasih, konfirmasi pembayaran berhasil dilakukan, mohon bersabar. Kami akan memprosesnya.'); window.location = 'cekstatus.php'</script>";
        } else {
            echo "Terjadi kesalahan pada update pesan: " . mysqli_error($db);
        }
    } else {
        echo "Terjadi kesalahan pada sistem kami saat melakukan insert: " . mysqli_error($db);
    }
}

mysqli_close($db);
?>
