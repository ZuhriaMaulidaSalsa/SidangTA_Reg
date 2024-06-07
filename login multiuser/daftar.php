<?php
include "koneksi.php";

if (!empty($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $nim = $_POST['nim'];
    $password = $_POST['password'];
    $hak_akses = $_POST['hak_akses'];

    $query = mysqli_query($koneksi, "select * from multiuser where nim='$nim'");
    $cek = mysqli_num_rows($query);
    echo $cek;

    if ($cek == 0) {
        mysqli_query($koneksi, "INSERT INTO `multiuser`(`nama`, `no_hp`, `nim`, `pass`, `status_form_pengajuan_sidangTA`, `status_form_administrasi`, `hak_akses`) 
        VALUES ('$nama', '$no_hp', '$nim', '$password', 'Belum Melakukan pendaftaran', 'Belum Meng-Upload file Administrasi', '$hak_akses')");
        header("location:login.php");
    } elseif ($cek > 0) {
        header("location:daftar.php?pesan=gagal");
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>SIGNUP | PENDAFTARAN SIDANG TA</title>
</head>

<body style="background: #dde1e7;">
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="wrapper">
        <div class="gambar">
            <img src="../user/img/sigin.png" alt="">
        </div>
        <div class="content" style="height: 660px ; margin-top:25px; ">
            <div class="text" style="text-align: center; margin-top:-20px;">
                Signup Account Pendaftaran Sidang TA
            </div>
            <form action="" method="POST">
                <div class="field">
                    <input type="text" required name="nama">
                    <span class="fas fa-user" style="margin-left:20px ;"></span>
                    <label>Nama</label>
                </div>
                <div class="field">
                    <input type="text" required name="no_hp">
                    <span class="fas fa-user" style="margin-left:20px ;"></span>
                    <label>No Tlp</label>
                </div>
                <div class="field">
                    <input type="text" required name="nim">
                    <span class="fas fa-user" style="margin-left:20px ;"></span>
                    <label>NIM</label>
                </div>
                <div class="field">
                    <input type="password" required name="password">
                    <span class="fas fa-lock" style="margin-left:20px ;"></span>
                    <label>Password</label>
                </div>

                <input type="hidden" name="hak_akses" value="user">

                <br>
                <!-- <button name="kirim" type="submit">Sign in</button> -->
                <div class="input">
                    <input type="submit" name="kirim" class="btn btn-sm btn-primary" value="Sign Up">
                </div>
                <button><a href="../index.php">Back to dashboard</a></button>
            </form>
        </div>
    </div>
    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "<div class='alert alert-danger'>
            <strong>Peringatan !</strong> nim sudah digunakan, gunakan yang lainnya !
          </div>";
        }
    }
    ?>
</body>

</html>