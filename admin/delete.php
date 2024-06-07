<?php

include "connect.php";

$id = $_GET ['id'];

$hasil = mysqli_query($koneksi, "DELETE FROM tugas_akhir WHERE id_tugasakhir=$id");

header("location:index.php");

?>

<!DOCTYPE html>