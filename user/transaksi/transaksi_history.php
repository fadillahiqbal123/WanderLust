<?php
include 'koneksi.php';

// Ambil transaksi pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM transaksi WHERE user_id = $user_id";
$result = mysqli_query($db, $query);
?>

<table class="table">
    <thead>
        <tr>
            <th>ID Transaksi</th>
            <th>Tiket</th>
            <th>Tanggal</th>
            <th>Status Pembayaran</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $row['id_transaksi']; ?></td>
            <td><?php echo $row['ticket_id']; ?></td>
            <td><?php echo $row['tgl_transaksi']; ?></td>
            <td><?php echo $row['status_pembayaran']; ?></td>
            <td>Rp <?php echo number_format($row['total_amount'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
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
    </head>

    <body>
        <header>
           
        </header>
        <main></main>
        <footer>
            
        </footer>
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
