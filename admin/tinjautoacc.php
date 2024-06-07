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
                    <span class="text">Data Mahasiswa yang Mengajukan Persyaratan Pendaftaran Sidang TA</span> <br> <br><br>
                </div>
            </div>
            <div class="activity">
                <div class="activity-data">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIM</th>
                                <th>NAMA LENGKAP</th>
                                <th>SEMESTER</th>
                                <th>TOTAL SKS</th>
                                <th>FILE SYARAT PENDAFTARAN</th>
                                <th>STATUS</th>
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
                                        <td><?php echo $baris['semester'] ?></td>
                                        <td><?php echo $baris['total_sks'] ?></td>
                                        <td><?php echo $baris['file_pendaftaran'] ?></td>
                                        <td>
                                            Status Form Syarat Pendaftaran sidang TA : <br>
                                            <?php if ($baris['status_form_pengajuan_sidangTA'] === 'Belum Meng-Upload file Administrasi') : ?>
                                                <div style="color:red;">
                                                    <?php echo $baris['status_form_pengajuan_sidangTA'] ?><br>
                                                </div>
                                            <?php elseif ($baris['status_form_pengajuan_sidangTA'] === 'SEDANG DITINJAU') : ?>
                                                <div style="color: orange">
                                                    <?php echo $baris['status_form_pengajuan_sidangTA'] ?><br>
                                                </div>
                                            <?php elseif ($baris['status_form_pengajuan_sidangTA'] === 'DISETUJUI') : ?>
                                                <div style="color: blue">
                                                    <?php echo $baris['status_form_pengajuan_sidangTA'] ?><br>
                                                </div>
                                            <?php endif; ?> <br>
                                            Status Form Administrasi : <br>
                                            <?php if ($baris['status_form_administrasi'] === 'Belum Meng-Upload file Administrasi') : ?>
                                                <div style="color:red;">
                                                    <?php echo $baris['status_form_administrasi'] ?><br>
                                                </div>
                                            <?php elseif ($baris['status_form_administrasi'] === 'SEDANG DITINJAU') : ?>
                                                <div style="color: orange">
                                                    <?php echo $baris['status_form_administrasi'] ?><br>
                                                </div>
                                            <?php elseif ($baris['status_form_administrasi'] === 'DISETUJUI') : ?>
                                                <div style="color: blue">
                                                    <?php echo $baris['status_form_administrasi'] ?><br>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding: 15px;">
                                            <?php if ($baris['status_form_administrasi'] === 'Belum Meng-Upload file Administrasi') { ?>
                                                <a href="../user/pdfs/<?php echo $baris['file_pendaftaran']; ?>" target="_blank">
                                                    <button type="button" class="btn btn-primary"><span class="bi bi-box-arrow-up-right"></span>Lihat Berkas</button>
                                                </a> <br><br>

                                                <?php
                                                if ($baris['status_form_pengajuan_sidangTA'] == 'SEDANG DITINJAU') {
                                                    // Jika status masih ditinjau, tampilkan tombol setujui
                                                ?>
                                                    <a href="update.php?nim=<?php echo $baris['nim']; ?>" onclick="return confirm('Apakah anda yakin?')">
                                                        <button type="button" class="btn btn-danger"><span class="bi bi-trash"></span>Setujui</button>
                                                    </a>
                                                <?php
                                                } else {
                                                    // Jika status sudah disetujui, tampilkan pesan atau tombol lain sesuai kebutuhan
                                                ?>
                                                    <a href="batalupdate.php?nim=<?php echo $baris['nim']; ?>" onclick="return confirm('Apakah anda yakin?')">
                                                        <button type="button" class="btn btn-danger"><span class="bi bi-trash"></span>Tinjau Ulang</button>
                                                    </a> <br><br>
                                                    <div class="berkas">
                                                        <a href="administrasi.php?NIM=<?php echo $baris['nim']; ?>" class="btn btn-primary" disabled style="pointer-events: none; cursor: not-allowed; text-decoration: none; color: #808080;">
                                                            <span></span> berkas administrasi
                                                        </a><br><br>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            <?php } elseif ($baris['status_form_administrasi'] === 'DISETUJUI' || $baris['status_form_pengajuan_sidangTA'] == 'DISETUJUI') { ?>
                                                <br>
                                                <a href="../user/pdfs/<?php echo $baris['file_pendaftaran']; ?>" target="_blank">
                                                    <button type="button" class="btn btn-primary"><span class="bi bi-box-arrow-up-right"></span>Lihat Berkas</button>
                                                </a> <br><br>

                                                <?php
                                                if ($baris['status_form_pengajuan_sidangTA'] == 'SEDANG DITINJAU') {
                                                    // Jika status masih ditinjau, tampilkan tombol setujui
                                                ?>
                                                    <a href="update.php?nim=<?php echo $baris['nim']; ?>" onclick="return confirm('Apakah anda yakin?')">
                                                        <button type="button" class="btn btn-danger"><span class="bi bi-trash"></span>Setujui</button>
                                                    </a>
                                                <?php
                                                } else {
                                                    // Jika status sudah disetujui, tampilkan pesan atau tombol lain sesuai kebutuhan
                                                ?>
                                                    <a href="batalupdate.php?nim=<?php echo $baris['nim']; ?>" onclick="return confirm('Apakah anda yakin?')">
                                                        <button type="button" class="btn btn-danger"><span class="bi bi-trash"></span>Tinjau Ulang</button>
                                                    </a> <br><br>
                                                    <a href="administrasi.php?NIM=<?php echo $baris['nim']; ?>" class="btn btn-primary">
                                                        <span></span> berkas administrasi
                                                    </a><br><br>
                                                <?php
                                                }
                                                ?>
                                            <?php } ?>
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