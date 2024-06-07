<?php
include "../admin/connect.php";
session_start();

if ($_SESSION['hak_akses'] != 'user' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}
$nim = $_SESSION['nim'];

$sql = "SELECT a.id, a.nim, a.file_pendaftaran
FROM pendaftaran a JOIN multiuser b 
ON a.nim = b.nim
WHERE a.nim = '$nim'
ORDER BY a.id
LIMIT 0, 25;";
$hasil = mysqli_query($koneksi, $sql);

//jika kirim di klik 
if (isset($_POST['kirim'])) {
    // $direktori = "pdfs/";
    $file_name = $_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'], 'pdfs/' . $file_name);
    $query = "INSERT INTO `pendaftaran`(`id`, `nim`, `file_pendaftaran`) VALUES (null,'$nim','$file_name')";
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        header("location:pendaftaran.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELLCOME | SISTEM INFORMASI TUGAS AKHIR</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="pendaftaran.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                echo "<li><span>halo!! " . $_SESSION['nim'] . "</span></li>";
                echo "<li><span>||</span></li>";
                echo "<li><a href='../login multiuser/logout.php'>Logout</a></li>";
                ?>
            </ul>
        </header>
        
        <div class="dashboard" style="margin-top: -15px; box-sizing: border-box; font-family: 'Poppins', sans-serif;">
            <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <span class="text"><b>Data Revisi</b></span>
                    </div>
                    <form action="tambah_pendaftaran.php" method="POST">
                        <input type="submit" name="kirim" value="Tambah File" class="btn"><br>
                    </form>
                </div>
                <p></p>

                <div class="activity">
                    <div class="activity-data">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>FILE REVISI</th>
                                    <th>NAMA FILE REVISI</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

</body>

</html>