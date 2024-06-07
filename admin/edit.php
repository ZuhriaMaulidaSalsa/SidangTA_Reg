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

    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    include "connect.php";

    // query untuk menampilkan kategori
    $sql = "SELECT * FROM tema";
    // menjalankan query
    $hasil = mysqli_query($koneksi, $sql);

    // nangkep id yang di klik
    $id = $_GET['id'];

    //nampilin tugas_akhirnya ngambil dari id berdasarkan yang di klik oleh admin
    $sql2 = "SELECT * FROM tugas_akhir WHERE id_tugasakhir=$id";
    $hasil2 = mysqli_query($koneksi, $sql2);
    // menghasilkan data dari query
    $row = mysqli_fetch_assoc($hasil2);

    if (!empty($_POST['kirim'])) {
        $judul = $_POST['judul_tugasakhir'];
        $tahun = $_POST['tahun'];
        $tema = $_POST['tema'];
        $abstrak = $_POST['abstrak'];
        $penulis = $_POST['penulis'];


        $gambar = $_POST['gambar']; //nangkep foto lama
        $filename = $_FILES['foto']['name']; //ngambil nama dari gambar untuk disimpen ke database
        $filetmp = $_FILES['foto']['tmpname']; //ngambil nama dari gambar untuk nama di folder gambar


        if ($filename) {
            //jika ada foto baru
            unlink('cover/' . $gambar);
            //maka foto lama di folder gambar akan di hapus
            //dan akan up foto baru
            move_uploaded_file($_FILES['foto']['tmp_name'], 'cover/' . $filename);
            $update = "UPDATE tugas_akhir SET id_tema='$tema',judul_tugasakhir='$judul',tahun='$tahun',abstrak='$abstrak',cover='$filename',penulis='$penulis' WHERE id_tugasakhir=$id";
        } else {
            //jika tidak ada foto baru maka yang dijalankan adalah dibawah ini
            // $update = "UPDATE tugas_akhir SET id_tema='$tema', judul_tugasakhir='$judul', abstrak='$abstrak' where id_tugasakhir=$id";
            $update = "UPDATE tugas_akhir SET id_tema='$tema',judul_tugasakhir='$judul',tahun='$tahun',abstrak='$abstrak',penulis='$penulis' WHERE id_tugasakhir=$id";

            //tanpa update kolom gambar
        }

        $hasil = mysqli_query($koneksi, $update);
        header("location:index.php");
    }
    ?>
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
                <div class="title">
                    <span class="text">Tambah Data Tugas Akhir</span> <br>
                </div>
            </div>
            <div class="activity">
                <div class="activity-data">
                    <div class="container mt-3">
                        <h2>EDIT DATA TUGAS AKHIR</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 mt-3">
                                <label for="judul_tugasakhir" class="form-label">Judul Tugas Akhir :</label>
                                <input type="text" class="form-control" name="judul_tugasakhir" value="<?php echo $row['judul_tugasakhir'] ?>">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="penulis" class="form-label">Penulis :</label>
                                <input type="text" class="form-control" name="penulis" value="<?php echo $row['penulis'] ?>">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="tahun" class="form-label">Tahun :</label>
                                <input type="text" class="form-control" name="tahun" value="<?php echo $row['tahun'] ?>">
                            </div>
                            <div class="mb-3 mt-3">
                                Tema Tugas Akhir :
                                <select class="form-select" name="tema" aria-label="Default select example">
                                    <option>--PILIH TEMA--</option>
                                    <?php
                                    while ($baris = mysqli_fetch_assoc($hasil)) {
                                        echo "<option value=\"";
                                        echo $baris['id_tema'];
                                        echo "\"";
                                        if ($baris['id_tema'] == $row['id_tema'])
                                            echo "selected";
                                        echo ">";
                                        echo $baris['tema'];
                                        echo "</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="abstrak">Abstrak Tugas Akhir :</label> <br>
                                <textarea name="abstrak" cols="30" rows="10"><?php echo $row['abstrak']; ?></textarea>
                            </div>
                            Gambar Sebelumnya: <br>
                            <img src="<?php echo "cover/" . $row['cover']; ?>" alt="" width="250">
                            <div class="mb-3">
                                <label>Foto :</label>
                                <input type="file" name="foto"> <br>
                            </div>
                            <input type="submit" name="kirim" class="btn btn-sm btn-primary" value="Edit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
    <script>
        const textarea = document.querySelector("textarea");
        textarea.addEventListener("keyup", e => {
            textarea.style.height = "63px";

            let scHeight = e.target.scrollHeight;
            // textarea.style.height = "auto"
            textarea.style.height = `${scHeight}px`
        });
    </script>
</body>

</html>