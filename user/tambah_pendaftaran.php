<?php

include "../admin/connect.php";

session_start();

if ($_SESSION['hak_akses'] != 'user' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}

// Ambil NIM dari sesi (gantilah 'nim_sesi' dengan nama sesi yang sesuai)
$nim = $_SESSION['nim'];

// Jika tombol "kirim" diklik
if (!empty($_POST['kirim'])) {
    $pendaftaran_namafile = $_POST['judul'];
    $filename = $_FILES['foto']['name']; // Ambil nama file untuk dimasukkan ke dalam database

    // tmp_name adalah penyimpanan sementara dan lokasi sementara dari file
    // Pindahkan foto ke folder gambar
    move_uploaded_file($_FILES['foto']['tmp_name'], 'file/' . $filename);

    // Tambahkan kutip satu dan sesuaikan query SQL Insert
    $sql = "INSERT INTO pendaftaran VALUES(null, '$nim', '$pendaftaran_namafile', '$filename')";
    $hasil = mysqli_query($koneksi, $sql);

    if ($hasil) {
        header("location: pendaftaran.php");
    }
}
?>


<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
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

</head>

<body>
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
                    <span class="text">Tambah Data Pendaftaran</span> <br>
                </div>
            </div>
            <div class="activity">
                <div class="activity-data">
                    <div class="container mt-3">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 mt-3">
                                <label for="judul" class="form-label">Nama File Pendaftaran :</label>
                                <input type="text" class="form-control" placeholder="Nama File Pendaftaran" name="judul">
                            </div>
                            <div class="mb-3">
                                <label>File :</label>
                                <input type="file" name="foto">
                            </div>
                            <input type="submit" name="kirim" class="btn btn-sm btn-primary" value="Tambah">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
    <script>
        const textarea = document.querySelector("textarea");
        textarea.addEventListener("keyup", e => {
            textarea.style.height = "63px";

            let scHeight = e.target.scrollHeight;
            // textarea.style.height = "auto"
            textarea.style.height = `${scHeight}px`
        });
    </script>
</body>

</html>