<?php
include "../admin/connect.php";
session_start();

if ($_SESSION['hak_akses'] != 'user' || empty($_SESSION['login'])) {
    header("location:../login multiuser/login.php");
}
$nim = $_SESSION['nim'];

$sql = "SELECT a.id, a.form_e, a.form_f, a.nim
FROM form_administrasi a JOIN multiuser b 
ON a.nim = b.nim
WHERE a.nim = '$nim'
LIMIT 0, 25;";
$hasil = mysqli_query($koneksi, $sql);


//jika kirim di klik 
if (isset($_POST['kirim'])) {

    $forme = $_FILES['forme']['name'];
    move_uploaded_file($_FILES['forme']['tmp_name'], 'pdfs/' . $file_name);

    $formf = $_FILES['formf']['name'];
    move_uploaded_file($_FILES['formf']['tmp_name'], 'pdfs/' . $file_name);
    $status = 'SEDANG DITINJAU';

    // Sesuaikan query INSERT dengan kolom yang ada di tabel
    $query = "INSERT INTO `form_administrasi`(`id`, `form_e`, `form_f`, `nim`) VALUES (null,'$forme','$formf','$nim')";
    $hasil2 = mysqli_query($koneksi, $query);

    $query_status = "UPDATE `multiuser` SET `status_form_administrasi`='$status' WHERE nim = '$nim'";
    $hasil3 = mysqli_query($koneksi, $query_status);


    if ($hasil3) {
        header("location: formadministrasi1.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
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
        .dropdown {
            margin-left: 15px;
        }

        .dropdown .mb-3 .syarat {
            color: #800000;
            font-size: 13px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* .mb-3 {
            color: #800000;
            font-size: 13px;
        } */
    </style>

    <!-- ... (bagian kode lainnya) ... -->

</head>

<body>
    <section>
        <header style="padding: 15px 100px 5px 100px;">
            <div class="logo" style="margin-top: -10px;">PENDAFTARAN SIDANG TA</div>
            <ul style="margin-top: 5px;">
                <li><a href="../index.php">Home</a></li>
                <!-- <li><a href="tugasakhir.php">Tugas Akhir</a></li> -->
                <li><a href="tugasakhir.php">Tugas Akhir</a></li>
                <li><a href="pendaftaran1.php">Pendaftaran</a></li>
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
                        <span class="text"><b>Form Administrasi</b></span>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="file">Upload Monitoring Kegiatan Pembimbingan :</label>
                            <input id="file" type="file" accept=".pdf" value="Tambah File" required name="forme" class="form-control" style="width: 1243px;"> <br>
                            <label for="file">Upload Persetujuan Sidang TA oleh Dosen Pembimbing :</label>
                            <input id="file" type="file" accept=".pdf" value="Tambah File" required name="formf" class="form-control" style="width: 1243px;"> <br>
                            <input type="submit" name="kirim" value="Kirim" style="margin-bottom: 10px; padding: 10px; border-radius: 5px; border: 0px; font-size: 17px; color: #fff; background-color: #800000; width: 120px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>