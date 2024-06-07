<?php

include "connect.php";

$nim = $_GET['nim'];


$query = "UPDATE `multiuser` SET `status_form_pengajuan_sidangTA`='SEDANG DITINJAU' WHERE nim = $nim";
$hasil = mysqli_query($koneksi, $query);

header("location:tinjautoacc.php");
