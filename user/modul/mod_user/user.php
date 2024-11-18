<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header"><strong>Pengaturan Akun</strong></div>
        <div class="card-body">
            <form class="action" method="POST">
                
            <div class="mb-3 w-25">
                    <label class="form-label">Nama Admin</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Admin" autocomplete="off" required/> 
                </div>
                <div class="mb-3 w-25">
                    <label class="form-label">Email</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukan Username Admin" autocomplete="off" required/>
                   
                </div>
                <div class="mb-3 w-25">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="telfon"  placeholder="Masukan No Telefon Admin" required/>
                </div>
                <div class="mb-3 w-25">
                    <label class="form-label">Password</label>
                    <input type="text"  class="form-control" name="alamat" placeholder="Masukan Alamat Admin" required/>
                </div>
                <div class="mb-3 w-25">
                    <label for="" class="form-label">Konfirmasi Password</label>
                    <input type="password"  class="form-control" name="konfirmasi_password" placeholder="Konfirmasi Password Admin" required/>
                </div>
                <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                
            </form>
            <?php  
            
            if(isset($_POST['submit'])){
                $namaadmin            = $_POST['nama_admin'];
                $email                = $_POST['email'];
                $username             = $_POST['username'];
                $password             = $_POST['password'];
                $konfirmasi_password  = $_POST['konfirmasi_password'];
                $id_user_login            = $_SESSION['idadmin'];
   
                if($password == $konfirmasi_password){
                    $password_md5= md5($password);

                   mysqli_query($db, "UPDATE admin SET username='$username', password='$password_md5', email='$email' WHERE id_admin= $id_user_login");
                   
                   echo "<script>alert('Data Berhasil Diubah'); window.location = 'dashboard.php?hal=user' </script";

                }else{
                    echo "<script>alert('Password Tidak Sama') window.location = 'dashboard.php?hal=user' </script>";
                }
            }
            
            ?>
        </div>
    </div>
</div>