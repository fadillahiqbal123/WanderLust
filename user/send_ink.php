<?php
if (isset($_POST['submit_email'])) {
    include "koneksi.php";
    $email = $_POST['email'];
    $select = mysqli_query($db, "SELECT email, password FROM user WHERE email = '$email'");

    if (mysqli_num_rows($select) == 1) {
        $row = mysqli_fetch_array($select);
        $pass_hash = md5($row['password']);

        require_once('PHPMailer/class.phpmailer.php');
        require_once('PHPMailer/class.smtp.php');

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->Username = "wanderlustjember@gmail.com";  // Ganti dengan email Anda
        $mail->Password = "vkpp xgcf nhum edhq";         // Ganti dengan password Anda
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->From = 'wanderlustjember@gmail.com';
        $mail->FromName = 'Admin WanderLust';

        $reset_link = "localhost:8080/destinasi-wisata/user/reset_pass.php?key=$email&reset=$pass_hash";
        $body = "Klik link berikut untuk mereset password Anda: <a href='$reset_link'>Reset Password</a>";

        $mail->addAddress($email, 'User Sistem');
        $mail->Subject = 'Reset Password';
        $mail->isHTML(true);
        $mail->Body = $body;

        if ($mail->send()) {
            echo "<script>alert('Link reset password telah dikirim ke email Anda.'); window.location = 'index.php';</script>";
        } else {
            echo "Mail Error - " . $mail->ErrorInfo;
        }
    } else {
        echo "<script>alert('Email tidak ditemukan.'); window.location = 'index.php';</script>";
    }
}
?>
