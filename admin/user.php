<?php
include "connect.php";

session_start();

if ($_SESSION['hak_akses'] != 'admin' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}

$sql = "SELECT * FROM multiuser where hak_akses = 'user'";
$hasil = mysqli_query($koneksi, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body>
    <nav>
        <div class="logo-name">
            <span class="logo_name">Sidang TA</span>
        </div>
        <div class="menu-items" style="margin-left:-30px ;">
            <ul class="nav-links">
                <li><a href="index.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Data Tugas Akhir</span>
                    </a></li>
                <li><a href="insert.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Tambah Tugas Akhir</span>
                    </a></li>
                <li><a href="user.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Akun User</span>
                    </a></li>
                <li><a href="tinjautoacc.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Pendaftaran User</span>
                    </a></li>
                <li><a href="revisi.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Revisi User</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="../login multiuser/logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <span class="text">
                DASHBOARD ADMIN
            </span>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <span class="text">Data Mahasiswa</span> <br>
                </div>
            </div>
            <div class="activity">
                <div class="activity-data">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>NO HP</th>
                                <th>NIM</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $nomor_urut = 0;
                            while ($baris = mysqli_fetch_assoc($hasil)) {
                                $nomor_urut++;
                            ?>

                                <tr style="vertical-align: middle ;">
                                    <div class="td">
                                        <td><?php echo $nomor_urut ?></td>
                                        <td><?php echo $baris['nama'] ?></td>
                                        <td><?php echo $baris['no_hp']; ?></td>
                                        <td><?php echo $baris['nim'] ?></td>
                                    </div>
                                </tr>

                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>

</html>