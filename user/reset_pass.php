<!doctype html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<body>
<main>

<div class="card mt-5 mx-auto" style="max-width: 400px;">
    <div class="card-body">
        <h5 class="card-title text-center">Reset Password</h5>
        <?php
            if ($_GET['key'] && $_GET['reset']) {
                include "koneksi.php";
                $email = $_GET['key'];
                $pass = $_GET['reset'];
                
                
                $select = mysqli_query($db, "SELECT email, password FROM user WHERE email='$email' AND md5(password)='$pass'");

                if (mysqli_num_rows($select) == 1) {
        ?>
            <form method="POST" action="">
                <div class="form-group mb-3">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control" id="password" name="password" onkeyup="checkPasswordMatch();" placeholder="******" required>
                    <input type="hidden" name="email" value="<?php echo $email ?>">
                    <input type="hidden" name="pass" value="<?php echo $pass ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" onkeyup="checkPasswordMatch();" placeholder="******" required>
                    <div id="message" class="mt-2"></div>
                </div>
                <div class="mb-3">
                <button type="submit" id="btnSubmit" name="submit_password" class="btn btn-primary btn-block" disabled>Reset Password</button>
                </div>
            </form>
        <?php 
                } else {
                    echo "Data tidak ditemukan.";
                }
            }  
        ?>

        <?php 
        if (isset($_POST['submit_password'])) {
            $email = $_POST['email'];
            $new_pass = md5($_POST['password']);

            
            $update = mysqli_query($db, "UPDATE user SET password='$new_pass' WHERE email='$email'") or die(mysqli_error($db));

            if ($update) {
                echo "<script>alert('Reset Password Berhasil'); window.location='index.php'</script>";
            } else {
                echo "<script>alert('Gagal Menyimpan'); window.location='index.php'</script>";
            }
        }
        ?>
           
    </div>
</div>

</main>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const message = document.getElementById('message');
        const submitButton = document.getElementById('btnSubmit');

        if (password === confirmPassword && password.length > 0) {
            message.style.color = 'green';
            message.textContent = 'Password dan Konfirmasi Sama';
            submitButton.disabled = false;
        } else {
            message.style.color = 'red';
            message.textContent = 'Password dan Konfirmasi Tidak Sama';
            submitButton.disabled = true;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
