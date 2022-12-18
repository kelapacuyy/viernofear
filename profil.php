<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

// ambil data dari user
$username = $_SESSION['user']['username'];
$query = mysqli_query($dbcatering, "SELECT * FROM anak_kost WHERE username = '$username'");
$row = mysqli_fetch_assoc($query);

if( isset($_POST['edit']) ){
    header("Location: editprofil.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DapurKost</title>
    <link href="css/profilestyle.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light sticky-top">
            <div class="container-fluid">
                <img src="assets/Mental Health Solution.png" class="img-fluid text-center" width="50px" height="50px" alt="logo">
                <a class="navbar-brand" href="#">DapurKost</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="homepage.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                        <li><a class="dropdown-item" href="daftarlangganan.php">Daftar Pesanan</a></li>
                    </ul>
                    </li>
                </ul>
                <ul class="d-flex">
                    <a class="profile" style="padding-top: 7px;" href="profile.php">
                        <img src="assets/icon-profile.png" alt="profilelogo"/>
                    </a>
                    <a class="nav-link m-2"> Hi, <?= $row['nama']?></a>
                    <button class="btn btn-outline-warning" style="border-radius: 15px;" type="submit" ><a href="logout.php" class="logout">Log Out</a></button>
                </ul>
                </div>
            </div>
            </nav>
            <!-- Navbar end -->

    <div class="card border-0" style="padding-left: 100px; padding-right: 100px; padding-bottom: 50px;">
        <div class="row g-0 shadow-lg p-3 mb-5 bg-body rounded">
            <div class="col-md-4">
            <img src="assets/profile-card1.png" class="img-fluid" style="border-radius: 10px;" alt="...">
            </div>
                <div class="col-md-8">
            <div class="card-body">
            <!--Profile Start-->
        <form action="" method="post" style="padding-top: 20px;">
            <fieldset>
            <p class="text-center">
                <label class="fw-bold"> Identitas Anda</label>
            </p>
            <p>
                <label for="nama">Nama</label><br>
                <input class="border-0" type="text" name="nama" id="nama" value="<?= $row['nama'] ?>" disabled>
            </p>
            <p>
                <label for="email">Email</label><br>
                <input class="border-0" type="email" name="email" id="email" value="<?= $row['email'] ?>" disabled>
            </p>
            <p>
                <label for="nomor_hp">No HP</label><br>
                <input class="border-0" type="number" name="no_hp" id="no_hp" value="<?= $row['no_hp'] ?>" disabled>
            </p>
            <p>
                <label for="tanggal_lahir">Tanggal Lahir <br> <?= $row['tanggal_lahir'] ?></label>
            </p>
            <p>
                <label for="jenis_kelamin">Jenis Kelamin </label><br>
                <label><input type="radio" name="jenis_kelamin" value="L" 
                <?php
                    if ($row['jenis_kelamin'] == 'L') {
                        echo "checked";
                    }
                ?> disabled>Laki-laki</label>
                <label><input type="radio" name="jenis_kelamin" 
                <?php
                    if ($row['jenis_kelamin'] == 'P') {
                        echo "checked";
                    }
                    ?> disabled>Perempuan</label>
            </p>
            <p>
                <label for="alamat">Alamat</label><br>
                <input class="border-0" type="text" name="alamat" id="alamat" value="<?= $row['alamat_kos'] ?>" disabled>
            </p>
            </fieldset>
            <button class="btn btn-warning"type="submit" name="edit">Edit Profil</button>
        </form>
    <!--Profile End-->
            </div>
            </div>
        </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
