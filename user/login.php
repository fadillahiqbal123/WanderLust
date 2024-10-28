<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
             rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
     body {
      background-color: #e0e8f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      max-width: 600px;
      width: 100%;
      background-color: white;
      border-radius: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }
    .left-panel {
      background-color: #0d3a66;
      color: white;
      padding: 40px;
      text-align: center;
      flex-direction: column;
      display: flex;
      justify-content: center;
    }
    .right-panel {
      padding: 40px;
    }
  </style>
</head>

<body>

<div class="container d-flex p-0">
    <div class="left-panel col-6">
        <img src="image/putihlogin.png" alt="">
      <p>Hello admin! Welcome back to please access again via the login page</p>
    </div>
    <div class="right-panel col-6">
      <form>
        <div class=" form-group mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Enter Username">
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Enter Password">
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="forgotPassword">
          <label class="form-check-label">Remember Me</label>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-outline-primary">Login</button>
        </div>
      </form>
    </div>
  </div>



  <footer>

  </footer>

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
