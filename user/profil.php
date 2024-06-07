<?php
include "../admin/connect.php";
session_start();

if ($_SESSION['hak_akses'] != 'user' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}
$nim = $_SESSION['nim'];

// Lakukan query untuk mendapatkan data user
$query = "SELECT * FROM multiuser WHERE nim = '$nim'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Ambil nilai status dari database (sesuaikan dengan nama kolom yang benar)
    $statusPengajuan = $row['status_form_administrasi'];
    $statusSidang = $row['status_form_pengajuan_sidangTA'];
    $nilaiSidang = $row['nilai_sidang'];
    $jadwalSidang = $row['jadwal_sidang'];

    // Lakukan pengecekan status dan arahkan ke file yang sesuai
    if ($statusPengajuan == "SEDANG DITINJAU") {
        header("Location: profil_ditinjau.php");
        exit();
    } elseif ($statusSidang == "LULUS") {
        header("Location: profil_lulus.php");
        exit();
    } elseif ($statusPengajuan == "DISETUJUI") {
        header("Location: profil_sidang.php");
        exit();
    }
} else {
    echo "Data tidak ditemukan";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME | SISTEM INFORMASI TUGAS AKHIR</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="pendaftaran.css">
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <section>
        <header style="padding: 15px 100px 5px 100px;">
            <div class="logo" style="margin-top: -10px;">PENDAFTARAN SIDANG TA</div>
            <ul style="margin-top: 5px;">
                <li><a href="../index.php">Home</a></li>
                <li><a href="tugasakhir.php">Tugas Akhir</a></li>
                <li><a href="pendaftaran2.php">Pendaftaran</a></li>
                <li><a href="revisi.php">Revisi</a></li>
            </ul>
            <ul style="margin-top: 5px;">
                <?php
                $query_nama = "SELECT `nama` FROM `multiuser` WHERE nim = '$nim';";
                $hasil_nama = mysqli_query($koneksi, $query_nama);

                if ($hasil_nama) {
                    $row_nama = mysqli_fetch_assoc($hasil_nama);
                    $nama = $row_nama['nama'];

                    echo "<li><a href='profil.php'>halo!! " . $nama . "</a></li>";
                    echo "<li><span>||</span></li>";
                    echo "<li><a href='../login multiuser/logout.php'>Logout</a></li>";
                } else {
                    echo "Error in query: " . mysqli_error($koneksi);
                }
                ?>
            </ul>
        </header>

        <div class="container-xl px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profil Mahasiswa</div>
                        <div class="card-body text-center">
                            <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar8.png" alt="">
                            <div class="logo">
                                <?php
                                $query_nama = "SELECT `nama` FROM `multiuser` WHERE nim = '$nim';";
                                $hasil_nama = mysqli_query($koneksi, $query_nama);

                                if ($hasil_nama) {
                                    $row_nama = mysqli_fetch_assoc($hasil_nama);
                                    $nama = $row_nama['nama'];

                                    echo "<span> " . $nama . "</span>";
                                    echo "<br><span> " . $nim . "</span>";
                                } else {
                                    echo "Error in query: " . mysqli_error($koneksi);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Status Pendaftaran Sidang TA</div>
                        <div class="card-body text-center">
                            <span>Anda Belum Melakukan Pendaftaran</span>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">Hasil Sidang TA</div>
                        <div class="card-body">
                            <!-- Isi konten hasil sidang disini -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>