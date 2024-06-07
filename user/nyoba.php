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

// if (!empty($_POST['kirim'])) {
//     $nim = $_SESSION['nim'];
//     $file_pendaftaran = $_POST['file'];
//     $filename = $_FILES['pdf']['name']; //ngambil nama buat di masukin ke database

//     // tmp_name adalah penyimpanan sementara Dan lokasi sementara dari file
//     // mindah foto ke folder gambar
//     move_uploaded_file($_FILES['pdf']['tmp_name'], 'pdfs/' . $filename);
//     $sql = "INSERT INTO pendaftaran VALUES(null,'$nim','$file_pendaftaran','$filename')";
//     $hasil = mysqli_query($koneksi, $sql);
//     if ($hasil) {
//         header("location:pendaftaran.php");
//     }
// }

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


<table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>FILE PENDAFTARAN</th>
            <th>NAMA FILE PENDAFTARAN</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor_urut = 0;
        while ($baris = mysqli_fetch_assoc($hasil)) {
            $nomor_urut++;
        ?>
            <tr>
                <td><?php echo $nomor_urut ?></td>
                <td><a href="pdfs/<?php echo $baris['file_pendaftaran']; ?>" target="_blank"><?php echo $baris['file_pendaftaran']; ?></a></td>
                <td><?php echo $baris['file_pendaftaran'] ?></td>

                <td>
                    <a href="edit.php?id=<?php echo $baris['id']; ?>"><i style='font-size:24px' class='fas'>&#xf044;</i></a>
                    <a href="delete.php?id=<?php echo $baris['id']; ?>" onclick="return confirm('apakah anda yakin?')"><i style='font-size:24px' class='far'>&#xf2ed;</i></a>
                </td>
            </tr>
            <?php
            // Query untuk mengambil data dari tabel pendaftaran
            // $nim = $_SESSION['nim'];
            // $query = "SELECT * FROM pendaftaran WHERE nim = '$nim2'";

            // $result = mysqli_query($koneksi, $query);

            // Tampilkan hasil dalam tabel HTML
            // echo "<table border='1'>
            // <tr>
            //     <th>NO</th>
            //     <th></th>
            //     <th></th>
            //     <th>Aksi</th>
            // </tr>";            ny
            // while ($row = mysqli_fetch_assoc($result)) {
            //     echo "<tr>";
            //     echo "<td>" . $row['id'] . "</td>";
            //     echo "<td>" . $row['nim'] . "</td>";
            //     echo "<td>" . $row['file_pendaftaran'] . "</td>";
            //     echo "<td><a href='pdfs/" . $row['name'] . "' target='_blank'>Lihat PDF</a></td>";
            //     echo "</tr>";
            // }

            // echo "</table>";

            // 
            ?>
            <?php
            // $nomor_urut = 0;
            // while ($baris = mysqli_fetch_assoc($hasil)) {
            //     $nomor_urut++;
            // 
            ?>



        <?php } ?>
    </tbody>
</table>