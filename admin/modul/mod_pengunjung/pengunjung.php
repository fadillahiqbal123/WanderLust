<div class="container-fluid">
    <div class="card mt-4">
    <div class="card-header">
        <a href="#" class="btn btn-outline-primary"><i class="bi bi-plus-lg"></i>Data Wisata</a>
    </div>
    <div class="card-body">
        <table id="example" class="display" style="width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Admin</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $sql = mysqli_query($db, "SELECT * FROM user");
                    while($r= mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td></td>
                    <td><?php echo $r['nama_user'] ?></td>
                    <td><?php echo $r['email']?></td>
                    <td><?php echo $r['username'] ?></td>
                    <td><?php echo $r['password']?></td>
                <td>
                <a href="dashboard.php?hal=edit_wisata&id=<?php echo $r['id_user'] ?>" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a>

                <a href="dashboard.php?hal=hapus_wisata&id=<?php echo $r['id_user'] ?>" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></a>
                </td>
                </tr>
                <?php  
                    }
                ?>
                </tbody>
            </tbody>
        </table>
    </div>
    </div>
</div>