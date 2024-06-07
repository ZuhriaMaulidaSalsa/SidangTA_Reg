<?php

include "../admin/connect.php";

$id = $_GET['id'];

$hasil = mysqli_query($koneksi, "DELETE FROM pendaftaran WHERE id = $id");

header("location:pendaftaran.php");

?>

<!DOCTYPE html>

