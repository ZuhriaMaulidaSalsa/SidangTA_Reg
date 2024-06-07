<?php

session_start();

include "connect.php";

// $nim = $_GET['NIM'];

// cek apakah sudah login sebagai admin
if ($_SESSION['hak_akses'] != 'admin' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}

$sql = "SELECT multiuser.nama, multiuser.nim, revisi.file_revisi FROM revisi JOIN multiuser ON revisi.nim=multiuser.nim;";
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
                <li><a href="sidang.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Input Jadwal Sidang</span>
                    </a></li>
                <li><a href="hasil_sidang.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Input Hasil Sidang</span>
                    </a></li>
            </ul>
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
                    <span class="text">Data Revisi User</span> <br>
                </div>
            </div>
            <div class="activity">
                <div class="activity-data">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>File Revisi</th>
                                <th>ACTION</th>
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
                                        <td><?php echo $baris['nim'] ?></td>
                                        <td><?php echo $baris['nama'] ?></td>
                                        <td><?php echo $baris['file_revisi'] ?></td>
                                        <td>
                                            <a href="../user/pdfs/<?php echo $baris['file_revisi']; ?>" target="_blank"><button type="button" class="btn btn-primary"><span class="bi bi-box-arrow-up-right"></span> Open</button></a>
                                            <a href="../user/download.php?Url=<?php echo $baris['file_revisi']; ?>" class="btn btn-primary">
                                                <span class="bi bi-download"></span>Download
                                            </a>
                                        </td>
                                    </div>
                                </tr>


                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        </div>