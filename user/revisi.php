<?php
include "../admin/connect.php";
session_start();

if ($_SESSION['hak_akses'] != 'user' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}
$nim = $_SESSION['nim'];

$sql = "SELECT a.id, a.nim, a.file_revisi
FROM revisi a JOIN multiuser b 
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
    $query = "INSERT INTO `revisi`(`id`, `nim`, `file_revisi`) VALUES (null,'$nim','$file_name')";
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        header("location:revisi.php");
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
    <!-- <meta name='viewport' content='width=device-width, initial-scale=1'> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <section>
        <header style="padding: 15px 100px 5px 100px;">
            <div class="logo" style="margin-top: -10px;">PENDAFTARAN SIDANG TA</div>
            <ul style="margin-top: 5px;">
                <li><a href="../index.php">Home</a></li>
                <!-- <li><a href="tugasakhir.php">Tugas Akhir</a></li> -->
                <li><a href="tugasakhir.php">Tugas Akhir</a></li>
                <li><a href="pendaftaran.php">Pendaftaran</a></li>
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

                    echo "<li><a href='profil.php'>halo!! " . $nama . "</a></li>";
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
                    <div class="title">
                        <span class="text"><b>Data Revisi</b></span>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="file" accept=".pdf" value="Tambah File" required name="NamaFile" class="form-control" style="width: 1220px;"> <br>
                            <input type="submit" name="kirim" value="Tambah" style="margin-bottom: 10px; padding: 10px; border-radius: 5px; border: 0px; font-size: 17px; color: #fff; background-color: #800000;">
                        </div>
                    </form>
                    <?php
                    // Memeriksa apakah ada data
                    if (mysqli_num_rows($hasil) > 0) {
                    ?>

                    <?php
                    } else {
                        echo "<p>Anda belum mengunggah berkas apapun.</p>";
                    }
                    ?>

                    <?php
                    if (mysqli_num_rows($hasil) > 0) {
                    ?>
                        <div class="activity">
                            <div class="activity-data">
                                <table class="table table-bordered" style="text-align: left; width: 1220px;">
                                    <thead>
                                        <tr>
                                            <th style="padding: 15px;">NO</th>
                                            <th style="padding: 15px;">NAMA FILE REVISI</th>
                                            <th style="padding: 15px;">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $nomor_urut = 0;
                                        while ($baris = mysqli_fetch_assoc($hasil)) {
                                            $nomor_urut++;
                                        ?>
                                            <tr>
                                                <td style="padding: 15px;"><?php echo $nomor_urut ?></td>
                                                <td style="padding: 15px;"><?php echo $baris['file_revisi'] ?></td>
                                                <td style="padding: 15px;">
                                                    <a href="pdfs/<?php echo $baris['file_revisi']; ?>" target="_blank"><button type="button" class="btn btn-primary"><span class="bi bi-box-arrow-up-right"></span> Open</button></a>
                                                    <a href="download.php?Url=<?Php echo $baris['file_revisi']; ?>" class="btn btn-primary">
                                                        <span class="bi bi-download"></span>Download
                                                    </a>
                                                    <a href="delete.php?id=<?php echo $baris['id']; ?>" onclick="return confirm('apakah anda yakin?')"><button type="button" class="btn btn-danger"><span class="bi bi-trash"></span> Delete</button></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

</body>