<?php
session_start();
include "./admin/connect.php";

$nim = $_SESSION['nim'];

if ($_SESSION['hak_akses'] != 'user' || empty($_SESSION['login'])) {
    header("location:./login multiuser/login.php");
}

$sql = "SELECT nim, status_form_pengajuan_sidangTA, status_form_administrasi FROM `multiuser` WHERE nim = '$nim';";
$hasil = mysqli_query($koneksi, $sql);

if ($hasil) {
    $row_status = mysqli_fetch_assoc($hasil);
    $status_form_syarat = $row_status['status_form_pengajuan_sidangTA'];
}

$sql_admin = "SELECT form_administrasi.nim, multiuser.status_form_administrasi 
FROM `multiuser` JOIN form_administrasi ON multiuser.nim=form_administrasi.nim 
WHERE form_administrasi.nim = '$nim';";
$hasil_admin = mysqli_query($koneksi, $sql);

if ($hasil_admin) {
    $row_status_admin = mysqli_fetch_assoc($hasil_admin);
    $status_form_admin = $row_status_admin['nim'];
}

?>
<!--  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELLCOME | PENDAFTARAN SIDANG TA</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <section>
        <div class="circle1"></div>
        <div class="circle2"></div>
        <header>
            <div class="logo">PENDAFTARAN SIDANG TA</div>
            <ul>
                <li><a href="index.php">home</a></li>
                <li>
                    <?php
                    if (!isset($_SESSION['nim'])) { ?>
                <li><a href="login multiuser/login.php">Tugas Akhir</a></li>
            <?php
                    } else { ?>
                <li><a href="user/tugasakhir.php">Tugas Akhir</a></li>
            <?php
                    }

            ?>
            </li>
            <li>
                <?php
                if ($nim != $status_form_syarat) {  ?>
            <li><a href="user/pendaftaran1.php">Pendaftaran</a></li>
        <?php
                } elseif ($nim === $status_form_syarat) { // nampilinn status kalo udah submit administrasi 
        ?>
            <li><a href="user/pendaftaran2.php">Pendaftaran</a></li>
        <?php
                } ?>



        </li>
        </li>
        <li><a href="./user/revisi.php">Revisi</a></li>
            </ul>
            <a href=""></a>
            <ul>
                <!-- menampilkan nama bagi user yang sudah log in -->
                <?php
                $query_nama = "SELECT `nama` FROM `multiuser` WHERE nim = '$nim';";
                $hasil_nama = mysqli_query($koneksi, $query_nama);

                if ($hasil_nama) {
                    $row_nama = mysqli_fetch_assoc($hasil_nama);
                    $nama = $row_nama['nama'];

                    echo "<li><a href='user/profil.php'>halo!! " . $nama . "</a></li>";
                    echo "<li><span>||</span></li>";
                    echo "<li><a href='./login multiuser/logout.php'>Logout</a></li>";
                } else {
                    echo "Error in query: " . mysqli_error($koneksi);
                }
                ?>
                <a href=></a>
            </ul>
        </header>
        <div class="content">
            <div class="textbox">
                <h2>Let's healing with <br><span>Sidang <br> Tugas Akhir</span></h2>
                <p>Sistem informasi manejemen skripsi fakultas teknik yang bertujuan memudahkan mahasiswa untuk<br>
                    mengupload berkas pendaftaran dan revisi dalam melaksanakan prosedur untuk kelulusan.</p>

                <!-- menampilkan menu registrasi -->
                <?php
                // kalau session kosong atau belum ada yang login maka akan ditampilkan menu registrasi
                if (!isset($_SESSION['nim'])) {
                    echo "<a href='./login multiuser/daftar.php'>Signup</a>";
                }

                ?>
            </div>
            <div class="imgBox">
                <img src="./user/img/bg.png" alt="..." class="imgBox">
            </div>
        </div>
        <!-- FOOTER -->

</body>

</html>