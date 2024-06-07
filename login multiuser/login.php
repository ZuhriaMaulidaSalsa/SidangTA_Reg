<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" >

    <title>LOGIN | PENDAFTARAN SIDANG TA</title>
</head>

<body style="background: #dde1e7;">
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="wrapper">
        <div class="img">
            <img src="../user/img/login.png" alt="">
        </div>
        <div class="content">
            <div class="text" style="text-align: center;">
                Login To Pendaftaran Sidang TA
            </div>
            <form action="cek_login.php" method="POST">
                <div class="field">
                    <input type="text" required name="nim">
                    <span class="fas fa-user" style="margin-left:20px ;"></span>
                    <label>NIM</label>
                </div>
                <div class="field">
                    <input type="password" required name="password">
                    <span class="fas fa-lock" style="margin-left:20px ;"></span>
                    <label>Password</label>
                </div> <br>
                <button>Sign in</button>
                <button><a href="../index.php">Back to dashboard</a></button>
                <button><a href="../login multiuser/daftar.php">Registrasi</a></button>

            </form>
        </div>
    </div>
    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "<div class='alert alert-danger'>
            <strong>Peringatan !</strong> nim dan Password tidak valid!
          </div>";
        }
    }
    ?>
</body>

</html>