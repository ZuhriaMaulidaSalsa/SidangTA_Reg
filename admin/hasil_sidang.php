<?php
include "connect.php";

session_start();

if ($_SESSION['hak_akses'] != 'admin' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}

$sql = "SELECT * FROM multiuser where hak_akses = 'user'";
$hasil = mysqli_query($koneksi, $sql);

$sql = "SELECT * FROM multiuser
JOIN pendaftaran ON multiuser.nim = pendaftaran.nim;";
$hasil = mysqli_query($koneksi, $sql);

if (isset($_POST['kirim'])) {
    $nim = $_POST['nim'];
    $namaLengkap = $_POST['nama_lengkap'];
    // $bimbingan = $_POST['bim'];  // Sesuaikan dengan nama yang benar dari dropdown
    $file_name = $_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'], '../user/pdfs/' . $file_name);
    $status = 'LULUS';

    // Update jadwal_sidang sesuai dengan NIM dan nama yang diinputkan
    $sqlUpdateJadwal = "UPDATE multiuser SET nilai_sidang = '$file_name' WHERE nim = '$nim' AND nama = '$namaLengkap'";
    $hasilUpdateJadwal = mysqli_query($koneksi, $sqlUpdateJadwal);

    if ($hasilUpdateJadwal) {
        echo "<script>alert('Nilai sidang berhasil diinputkan.');</script>";
    } else {
        echo "<script>alert('Gagal memasukkan Nilai sidang.');</script>";
    }


    $query_status = "UPDATE `multiuser` SET `status_form_pengajuan_sidangTA`='$status' WHERE nim = '$nim'";
    $hasil3 = mysqli_query($koneksi, $query_status);
}


?>

<a href=""></a>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        form {
            padding-left: -500px;
        }
    </style>
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

                <div class="title"><span class="text">Input Hasil Sidang Mahasiswa</span> <br> <br><br>

                </div>
            </div>
            <div class="activity">
                <div class="activity-data">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">NIM</span>
                            <input type="text" class="form-control" placeholder="Isi NIM Mahasiswa" aria-label="Username" aria-describedby="addon-wrapping" name="nim">
                        </div> <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">NAMA LENGKAP</span>
                            <input type="text" class="form-control" placeholder="Isi Nama Mahasiswa" aria-label="Username" aria-describedby="addon-wrapping" name="nama_lengkap">
                        </div> <br>

                        <div class="input-group flex-nowrap">
                            <div class="mb-3">
                                <label for="file">UPLOAD NILAI SIDANG : </label>
                                <br><input id="file" type="file" accept=".pdf" value="Tambah File" required name="NamaFile" class="form-control" style="width: 1243px;">
                            </div>
                            <!--<span class="input-group-text" id="addon-wrapping">NILAI SIDANG</span>
                            <input type="text" class="form-control" placeholder="Isi Jadwal Sidang" aria-label="Username" aria-describedby="addon-wrapping" name="nilai_sidang">-->
                        </div> <br>
                        <div class="dropdown">
                            <div class="mb-3">

                                <input type="submit" name="kirim" value="Kirim" style="margin-bottom: 10px; padding: 10px; border-radius: 5px; border: 0px; font-size: 17px; color: #fff; background-color: #800000; width: 120px;">
                            </div>
                        </div>
                        <br>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>

</html>