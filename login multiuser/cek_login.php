<?php
// mengaktifkan session pada php
session_start();

// koneksi dengan database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$nim = $_POST['nim'];
$password = $_POST['password'];

// menampilkan table multiuser sesuai dengan tangkapan data di atas menggunakan where
$login = mysqli_query($koneksi, "SELECT * FROM multiuser WHERE nim='$nim' and pass ='$password'");

// mengambil data dari database berdasarkan query yang ada di login
$data = mysqli_fetch_assoc($login);
// apakah nim dan password sesuai dengan data yang ada di database
if ($nim !== $data['nim'] && $password !== $data['pass']) {
        // jika tidak sesuai maka ditampilkan pesan error
        header("location:login.php?pesan=gagal");

        // jika user login sebagai admin
} else if ($data['hak_akses'] == "admin") {
        $_SESSION['login'] = true;
        $_SESSION['hak_akses'] = "admin";
        // di alihkan ke halaman index admin
        header("location:../admin/index.php");

        // cek jika user login sebagai user
} else if ($data['hak_akses'] == "user") {
        // menyimpan nim dan hak akses di session
        $_SESSION['login'] = true;
        $_SESSION['nim'] = $nim;
        $_SESSION['hak_akses'] = "user";
        // alihkan ke halaman dashboard user
        header("location:../index.php");
}
