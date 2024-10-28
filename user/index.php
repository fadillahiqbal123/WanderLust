<?php

session_start();

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login User</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <!-- icon bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- link font awsome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- sweetalert -->
       <script src="dist/sweetalert2.all.min.js"></script>
        <!-- css -->
        <link rel="stylesheet" href="css/index.css">
       
    </head>

    <body>
      <div class="container" id="container">
        <div class="form-container sign-up">
          <form id="auth-form" action="proses.php" method="POST">
            <h3 style="text-align: center;">Create Account</h3>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i>
              </a>
              <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i>
              </a>
              <a href="#" class="icon"><i class="fa-brands fa-github"></i>
              </a>
              <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i>
              </a>
            </div>
            <span>Or use your email for registration</span>
            <input type="text" name="nama_user" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password">
            <button type="submit" id="btn" name="register">Sign Up</button>
            
          </form>
        </div> 
        <div class="form-container sign-in">
          <form action="proses.php" method="POST">
            <h4><strong>Sign In</strong></h4>
            <div class="social-icons">
              <h5 style="text-align: center;"><strong>Kunjungi Juga<br>Social Media Kami</strong></h5>
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i>
              </a>
              <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i>
              </a>
              <a href="#" class="icon"><i class="fa-brands fa-github"></i>
              </a>
              <a href="#" class="icon"><i class="fa-brands fa-linkedin"></i>
              </a>
            </div>
            <span>Or use your email password</span>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <a href="#">Forget Your Password ?</a>
            <div class="form-group text-end" style="width: 10px;">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
            <label class="form-cek-label">Remember Me</label>
            </div>
            <button type="submit" id="btn" name="login">Sign In</button>
          </form>
        </div>

        
        <div class="toggle-container">
    <div class="toggle">
        <div class="toggle-panel toggle-left">
          <img src="image/putihlogin.png" alt="WanderLust" style="height: 100px;">
            <h4>Welcome to the WanderLust app</h4>
            <p>Enter your personal details to use all the site features</p>
            <button class="hidden" id="login">Sign in</button>
        </div>
        <div class="toggle-panel toggle-right">
        <img src="image/putihlogin.png" alt="WanderLust" style="height: 100px;">
            <h1>Hello, Users!</h1>
            <p>Register with your personal details to use all the site features</p>
            <button class="hidden" id="register">Sign Up</button>
        </div>
    </div>
</div>

      </div>

    
    
    
        <footer>
            
        </footer>


        <script src="script.js"></script>
       



        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
