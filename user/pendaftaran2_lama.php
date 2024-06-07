<?php
include "../admin/connect.php";
session_start();

if ($_SESSION['hak_akses'] != 'user' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}

$nim = $_SESSION['nim'];

$query_status = "SELECT `status_form_pengajuan_sidangTA` FROM `multiuser` WHERE nim = '$nim';";
$hasil_status = mysqli_query($koneksi, $query_status);

if ($hasil_status) {
    $row_status = mysqli_fetch_assoc($hasil_status);
    $status = $row_status['status_form_pengajuan_sidangTA'];
} else {
    echo "Error in query: " . mysqli_error($koneksi);
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELLCOME | SISTEM INFORMASI TUGAS AKHIR</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="pendaftaran.css">
    <!-- <meta name='viewport' content='width=device-width, initial-scale=1'> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* status box di tinjau */
        /* .status-box {
            background-color: rgba(251, 140, 1, 0.2);
            color: #721c24;
            padding: 10px;
            border: 1.5px solid rgb(251, 140, 1);
            border-radius: 4px;
            margin-top: 250px;
            margin-left: 460px;
            text-align: center;
            font-size: 16px;
            height: 200px;
            width: 500px;
        } */

        /* statusbox disetujui */
        .status-box {
            background-color: rgba(173, 216, 230, 0.3);
            color: #007bff;
            padding: 10px;
            border: 1px solid #007bff;
            border-radius: 4px;
            margin-top: 250px;
            margin-left: 460px;
            text-align: center;
            font-size: 16px;
            height: 200px;
            width: 500px;
        }

        .status-box i {
            height: 100px;
        }
    </style>
</head>

<body>
    <section>
        <header style="padding: 15px 100px 5px 100px;">
            <div class="logo" style="margin-top: -10px;">PENDAFTARAN SIDANG TA</div>
            <ul style="margin-top: 5px;">
                <li><a href="../index.php">Home</a></li>
                <!-- <li><a href="tugasakhir.php">Tugas Akhir</a></li> -->
                <li><a href="tugasakhir.php">Tugas Akhir</a></li>
                <li><a href="pendaftaran2.php">Pendaftaran</a></li>
                <li><a href="revisi.php">Revisi</a></li>
            </ul>
            <ul style="margin-top: 5px;">
                <!-- menampilkan nim bagi user yang sudah log in -->
                <?php
                $query_nama = "SELECT `nama` FROM `multiuser` WHERE nim = '$nim';";
                $hasil_nama = mysqli_query($koneksi, $query_nama);

                if ($hasil_nama) {
                    $row_nama = mysqli_fetch_assoc($hasil_nama);
                    $nama = $row_nama['nama'];

                    echo "<li><span>halo!! " . $nama . "</span></li>";
                    echo "<li><span>||</span></li>";
                    echo "<li><a href='../login multiuser/logout.php'>Logout</a></li>";
                } else {
                    echo "Error in query: " . mysqli_error($koneksi);
                }
                ?>
            </ul>
        </header>

        <div class="dashboard" style="margin-top: -15px; box-sizing: border-box; font-family: 'Poppins', sans-serif;">
            <div class="dash-content">
                <div class="overview">
                    <div class="status-box">
                        <br><br>
                        <!-- status box ditinjau -->
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="50" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                        </svg> <br><br> -->

                        <!-- status box di setujui -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                        </svg> <br><br>
                        <?php
                        $query_status = "SELECT `status_form_pengajuan_sidangTA` FROM `multiuser` WHERE nim = '$nim';";
                        $hasil_status = mysqli_query($koneksi, $query_status);

                        if ($hasil_nama) {
                            $row_status = mysqli_fetch_assoc($hasil_status);
                            $status = $row_status['status_form_pengajuan_sidangTA'];

                            echo "$status";
                        } else {
                            echo "Error in query: " . mysqli_error($koneksi);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>