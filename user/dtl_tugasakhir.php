<?php

include "../admin/connect.php";

session_start();

if ($_SESSION['hak_akses'] != 'user' || empty($_SESSION['login'])) {
    header("location:./login multiuser/login.php");
}
$nim = $_SESSION['nim'];

//mendapatkan id dari drama yang di klik user
$id = $_GET['id'];

// nampilin drama sesuai id drama yang didapat dari GET digabung dengan tabel tema
$query = mysqli_query($koneksi, "SELECT id_tugasakhir, judul_tugasakhir, tahun, abstrak, tema, cover, penulis
FROM tugas_akhir a, tema b
WHERE a.id_tema=b.id_tema and id_tugasakhir=$id");
$baris_mhs = mysqli_fetch_assoc($query);

$user = $_SESSION['nim'];

// query nambah ke favorite
if (!empty($_POST['kirim'])) {
    $id_tugasakhir   = $_POST['id_tugasakhir'];
    $nim = $_POST['user'];

    $hasil = mysqli_query($koneksi, "INSERT INTO favorite(id,id_tugasakhir,nim_user) VALUES (NULL,$id_tugasakhir,'$nim')");
    if ($hasil) {
        echo '<script type ="text/JavaScript">';
        echo 'alert("berhasil ditambahkan ke favorite!")';
        echo '</script>';
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELLCOME | SISTEM INFORMASI TUGAS AKHIR</title>
    <!-- <link rel="stylesheet" href="../index.css"> -->
    <link rel="stylesheet" href="dtl_tugasakhir.css">
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <section>
        <header>
            <div class="logo" style="color: #800000; font-size: 1.2em; font-weight: 700;letter-spacing: 0.1em;">PENDAFTARAN SIDANG TA</div>
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
        <div class="wrp">
            <div class="tampilan">
                <img src="../admin/cover/<?= $baris_mhs['cover'] ?>" width="380px" class="cover-album" style="border-radius: 10px;">
                <div class="kolom">
                    <p class="deskripsi">Tugas Akhir <?= $baris_mhs['tema'] ?> <?= $baris_mhs['tahun'] ?></p>
                    <form action="" method="POST">
                        <h2 style="color: #800000;"><?= $baris_mhs['judul_tugasakhir'] ?></h2>
                        <input type="hidden" class="form-control" name="id_tugasakhir" value="<?php echo $baris_mhs['id_tugasakhir'] ?>">
                        <input type="hidden" class="form-control" name="user" value="<?php echo $user ?>">
                        <p><?= $baris_mhs['abstrak']; ?></p> <br>
                    </form>
                </div>
            </div>
        </div>

</body>
</div>
</body>

</html>