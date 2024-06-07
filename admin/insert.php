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
    <?php
    include "connect.php";

    session_start();

    // cek apakah sudah login sebagai admin
    if ($_SESSION['hak_akses'] != 'admin' || empty($_SESSION['login'])) {
        header("location:../login multiuser/login.php");
    }

    //buat nampilin tema dari database
    $sql = "SELECT * FROM tema";
    $hasil = mysqli_query($koneksi, $sql);

    //jika kirim di klik 
    if (!empty($_POST['kirim'])) {
        $judul_tugasakhir = $_POST['judul'];
        $tahun = $_POST['tahun'];
        $tema = $_POST['tema'];
        $abstrak = $_POST['abstrak'];
        $penulis = $_POST['penulis'];
        $filename = $_FILES['foto']['name']; //ngambil nama buat di masukin ke database

        // tmp_name adalah penyimpanan sementara Dan lokasi sementara dari file
        // mindah foto ke folder gambar
        move_uploaded_file($_FILES['foto']['tmp_name'], 'cover/' . $filename);
        $sql = "INSERT INTO tugas_akhir VALUES(null,$tema,'$judul_tugasakhir','$tahun','$abstrak','$filename','$penulis')";
        $hasil = mysqli_query($koneksi, $sql);
        if ($hasil) {
            header("location:index.php");
        }
    }
    ?>
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
                    <span class="text">Tambah Data Tugas Akhir</span> <br>
                </div>
            </div>
            <div class="activity">
                <div class="activity-data">
                    <div class="container mt-3">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 mt-3">
                                <label for="judul" class="form-label">Judul Tugas Akhir :</label>
                                <input type="text" class="form-control" placeholder="Judul Tugas Akhir" name="judul">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="penulis" class="form-label">Penulis Tugas Akhir :</label>
                                <input type="text" class="form-control" placeholder="Penulis Tugas Akhir" name="penulis">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="tahun" class="form-label">Tahun Terbit :</label>
                                <input type="text" class="form-control" placeholder="Tahun Terbit" name="tahun">
                            </div>
                            <div class="mb-3 mt-3">
                                Tema Tugas Akhir :
                                <select class="form-select" name="tema" aria-label="Default select example">
                                    <option>--PILIH TEMA--</option>
                                    <?php
                                    // menghasilkan data array asosiative yg didapat dari query SQL sebelumnya
                                    while ($baris = mysqli_fetch_assoc($hasil)) {
                                    ?>
                                        <option value="<?php echo $baris['id_tema']; ?>"><?php echo $baris['tema'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="abstrak">Abstrak Tugas Akhir :</label> <br>
                                <textarea name="abstrak" cols="30" rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Cover :</label>
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