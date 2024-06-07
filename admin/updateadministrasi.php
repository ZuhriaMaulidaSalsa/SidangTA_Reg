<?php

include "connect.php";

$nim = $_GET['nim'];


$query = "UPDATE `multiuser` SET `status_form_administrasi`='DISETUJUI' WHERE nim = $nim";
$hasil = mysqli_query($koneksi, $query);

header("location:tinjautoacc.php");
