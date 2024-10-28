
<?php
include "koneksi.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
}

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Tiketing.com</title>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <header>
        <nav class="nav justify-content-center bg-success ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Bromo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Kritik Saran</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
            User
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">History</a></li>
            <li><a class="dropdown-item" href="#">Berita</a></li>
            <li><a class="dropdown-item" href="#">Rating</a></li>
            <li><a class="dropdown-item" href="#">Pesan Tiket</li>
            <li><a class="dropdown-item" href="#">About Bromo</a></li>
          
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pesan Tiket</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-warning" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
        </header>
  <div class="container mt-5">
        <form action="process_order.php" method="POST" class="container">
    <div class="form-group">
        <label for="ticket">Pilih Tiket</label>
        <select name="ticket_id" id="ticket" class="form-control">
            <?php
            // Ambil data tiket dari database
            $query = "SELECT * FROM tickets";
            $result = mysqli_query($db, $query)  or die("Query gagal: " . mysqli_error($db));;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['ticket_id']}'>{$row['ticket_name']} - Rp {$row['ticket_price']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group mb-3">
    <label for="jumlah" class="form-label">Jumlah Tiket</label>
    <input type="number" name ="jumlah" id="jumlah" placeholder="pilih" min="1" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
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
