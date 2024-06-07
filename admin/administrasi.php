<?php
include "connect.php";

session_start();

$nim = $_GET['NIM'];

if ($_SESSION['hak_akses'] != 'admin' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}

$sql = "SELECT * FROM form_administrasi JOIN multiuser ON form_administrasi.nim=multiuser.nim WHERE multiuser.nim='$nim';";
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
                <li><a href="pendaftaran.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Pendaftaran User</span>
                    </a></li>
                <li><a href="revisi.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Revisi User</span>
                    </a></li>
                <li><a href="revisi.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Input Jadwal Sidang</span>
                    </a></li>
                <li><a href="revisi.php">
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
                    <?php
                    $nomor_urut = 0;
                    while ($baris = mysqli_fetch_assoc($hasil)) {
                        $nomor_urut++;
                    ?>
                        <span class="text">Data File Administrasi <?php echo $baris['nama']; ?> (<?php echo $baris['nim']; ?>)</span> <br> <br><br>
                </div>
            </div>
            <div class="activity">
                <div class="activity-data">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>File Monitoring Kegiatan Pembimbingan</th>
                                <th>File Persetujuan Sidang TA oleh Dosen Pembimbing</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr style="vertical-align: middle ;">
                                <div class="td">
                                    <td><?php echo $nomor_urut ?></td>
                                    <td>
                                        <a href="../user/pdfs/<?php echo $baris['form_e']; ?>" target="_blank">
                                            <button type="button" class="btn btn-primary"><span class="bi bi-box-arrow-up-right">
                                                </span><?php echo $baris['form_e'] ?></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="../user/pdfs/<?php echo $baris['form_f']; ?>" target="_blank">
                                            <button type="button" class="btn btn-primary"><span class="bi bi-box-arrow-up-right">
                                                </span><?php echo $baris['form_f'] ?></button>
                                        </a>

                                    </td>
                                    <td style="padding: 15px;">
                                        <?php if ($baris['status_form_administrasi'] === 'SEDANG DITINJAU') : ?>
                                            <a href="updateadministrasi.php?nim=<?php echo $baris['nim']; ?>" onclick="return confirm('Apakah anda yakin?')">
                                                <button type="button" class="btn btn-danger"><span class="bi bi-trash"></span>Setujui</button>
                                            </a>
                                        <?php elseif ($baris['status_form_administrasi'] === 'DISETUJUI') : ?>
                                            <a href="bataladministrasi.php?nim=<?php echo $baris['nim']; ?>" onclick="return confirm('Apakah anda yakin?')">
                                                <button type="button" class="btn btn-danger"><span class="bi bi-trash"></span>Tinjau Ulang</button>
                                            </a>
                                        <?php endif;
                                        ?>
                                    </td>
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