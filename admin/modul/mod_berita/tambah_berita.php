
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header">
            <strong>Form Tambah Data</strong>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
           <div class="mb-3">
            <label class="form-label">Judul Berita</label>
            <input type="text" name="judul_berita" id="" class="form-control" placeholder="Masukan Judul Berita"/>
           </div>         
            <div class="mb-3">
                <label class="form-label">Konten Berita</label>
                <textarea class="form-control ckeditor" name="konten_berita" id="ckeditor" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Berita</label>
                <input type="file" class="form-control" name="foto_berita"/>
                <div id="fileHelpId" class="form-text">Upload file image(png, jpg, jpeg)</div>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>

                <a href="dashboard.php?hal=berita" class="btn btn-outline-danger">Batal</a>
            </div>
            </form>
            <?php 
if(isset($_POST['submit'])) {
    $judul_berita = $_POST['judul_berita'];
    $konten_berita =  $_POST['konten_berita'];
    $foto_berita = $_FILES['foto_berita']['name'];
    $file_extension = array('png', 'jpg', 'jpeg', 'gif');
    $extension = pathinfo($foto_berita, PATHINFO_EXTENSION);
    $size_foto_berita = $_FILES['foto_berita']['size'];
    $rand = rand();

    
    $penulis = $_SESSION['idadmin'];
    $tanggal = date('Y-m-d');

    if(!in_array($extension, $file_extension)) {
        echo "<script>alert('File Tidak Didukung'); window.location = 'dashboard.php?hal=tambah_berita'</script>";
    } else {
        if ($size_foto_berita < 409600) {
            $nama_foto_berita = $rand . '_' . $foto_berita;
            move_uploaded_file($_FILES['foto_berita']['tmp_name'], '././img_berita/' . $nama_foto_berita);

           
            $query = "INSERT INTO berita (judul_berita, id_admin, tgl_berita, konten_berita, foto_berita) VALUES ('$judul_berita', '$penulis', '$tanggal', '$konten_berita', '$nama_foto_berita')";
            if (mysqli_query($db, $query)) {
                echo "<script>alert('Konten Berita Berhasil Ditambahkan'); window.location = 'dashboard.php?hal=berita'</script>";
            } else {
                echo "<script>alert('Gagal Menambahkan Data'); window.location = 'dashboard.php?hal=tambah_berita'</script>";
            }
        } else {
            echo "<script>alert('Ukuran Foto Terlalu Besar'); window.location = 'dashboard.php?hal=tambah_berita'</script>";
        }
    }
}
?>


        </div>
    </div>
</div>