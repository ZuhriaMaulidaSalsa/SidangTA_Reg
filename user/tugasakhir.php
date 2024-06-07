<?php

include "../admin/connect.php";

session_start();

if ($_SESSION['hak_akses'] != 'user' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}
$nim = $_SESSION['nim'];

$query = mysqli_query($koneksi, "SELECT id_tugasakhir, judul_tugasakhir, tahun, abstrak, tema, cover, penulis
FROM tugas_akhir a, tema b
WHERE a.id_tema=b.id_tema ORDER BY id_tugasakhir DESC");

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELLCOME | SISTEM INFORMASI TUGAS AKHIR</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="tugasakhir.css">
</head>

<body>
    <section>
        <header>
            <div class="logo">PENDAFTARAN SIDANG TA</div>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="tugasakhir.php">Tugas Akhir</a></li>
                <li><a href="pendaftaran.php">Pendaftaran</a></li>
                <li><a href="revisi.php">Revisi</a></li>
            </ul>
            <ul>
                <!-- menampilkan nim bagi user yang sudah log in -->
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
        <div class="content" style="margin-top: 50px;">

            <main style="gap: 20px 35px;">
                <?php
                while ($k = mysqli_fetch_array($query)) {
                ?>
                    <div class="lagu" style="border: #800000 solid 2px;">
                        <div class="cover">
                            <a href="dtl_tugasakhir.php?id=<?php echo $k['id_tugasakhir']; ?>"><img src="../admin/cover/<?= $k['cover'] ?>" width="300px" class="cover-album"></a>
                        </div>
                        <div class="judul">
                            <h4 style="color: black; text-align:center;"><?= $k['judul_tugasakhir'] ?></h4>
                            <!--<span><?= $k['tema'] ?></span>-->
                        </div>
                    </div>

                <?php
                }
                ?>
            </main>
        </div>
</body>
</div>
</body>