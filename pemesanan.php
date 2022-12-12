<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil data user
$username = $_SESSION['user']['username'];
$query = mysqli_query($dbcatering, "SELECT * FROM anak_kost WHERE username = '$username'");
$row = mysqli_fetch_assoc($query);

if( isset($_POST['pesan']) ){
    //ambil data dari form
    $username = $_SESSION['user']['username'];
    $id_toko = $_POST['id_toko'];
    $tanggal_awal_langganan = date("Y-m-d", strtotime($_POST['tanggal_awal_langganan']));
    $tanggal_akhir_langganan = date("Y-m-d", strtotime($_POST['tanggal_akhir_langganan']));
    $status = 'PENDING';

    //memasukkan ke dalam database
    $result = mysqli_query($dbcatering, "INSERT INTO berlangganan VALUES ('', '$username', '$id_toko', '$tanggal_awal_langganan', '$tanggal_akhir_langganan', '$status')");

    //cek jika query berhasil
    if( $result == TRUE ){
        echo "<script>alert('Pemesanan berhasil dibuat!');
                document.location.href ='daftarpesanan.php'</script>";
    }


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DapurKost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
        <!-- custom css -->
        <link href="css/pemesananstyle.css" rel="stylesheet">
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
                        <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                        <li><a class="dropdown-item" href="daftarpesanan.php">Riwayat Pemesanan</a></li>
                    </ul>
                    </li>
                </ul>
                <ul class="d-flex">
                    <a class="profile" style="padding-top: 7px;" href="profil.php">
                        <img src="assets/icon-profile.png" alt="profilelogo"/>
                    </a>
                    <a class="nav-link m-2"> Hi, <?= $row['nama']?></a>
                    <button class="btn btn-outline-warning" style="border-radius: 15px;" type="submit" ><a href="logout.php" class="logout">Log Out</a></button>
                </ul>
                </div>
            </div>
            </nav>
        <!-- Navbar end -->
    <div class="card mb-3" style="padding-top: 50px; padding-left: 100px; padding-right: 100px; padding-bottom: 50px; border: 10px;">
        <img src="assets/card.png" class="card-img-top" alt="...">
        <div class="card-body"></div>
            <form class="form  shadow-lg p-3 mb-5 bg-body rounded" action="" method="post">
                <fieldset class="isiform">
                    <div class="form-select-lg mb-3" style="text-align: center;" required>
                        <h5 for="tanggal_pemesanan">Tanggal Konsultasi : </h5>
                        <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" style="border-radius: 10px; padding: 5px;" required>
                    </div>
                    <div>
                        <label for="psikolog_id" style="padding-bottom: 10px;">Psikolog : </label>
                        <select id="psikolog_id" name="psikolog_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="border-radius: 10px; padding: 5px;" required>
                            <option value="" disabled selected>Pilih Psikolog</option>
                            <option value ="DJ6Z1">Soerjantini Rahayu, M.Psi., Psikolog</option>
                            <option value ="JBTH2">Budi Santoso, M.Psi., Psikolog</option>
                            <option value ="M8WC3">Sri Rahmani, S.Psi., M.Psi., Psikolog</option>
                            <option value ="VNJ24">Bianca Siregar, M.Psi., Psikolog</option>
                            <option value ="UQ4W5">Slamet Hassan, S.Psi., M.Psi., Psikolog</option>
                        </select>
                        <label for="waktu_konsultasi" style="padding-bottom: 10px;">Waktu Konsultasi : </label>
                        <select id="waktu_konsultasi" name="waktu_konsultasi" class="form-select form-select-sm" aria-label=".form-select-sm example" style="border-radius: 10px; padding: 5px;" required>
                            <option value="" disabled selected>Pilih waktu konsultasi</option>
                            <option value="10.00 - 11.00">10.00 - 11.00</option>
                            <option value="11.00 - 12.00">11.00 - 12.00</option>
                            <option value="13.00 - 14.00">13.00 - 14.00</option>
                            <option value="14.00 - 15.00">14.00 - 15.00</option>
                            <option value="15.00 - 16.00">15.00 - 16.00</option>
                            <option value="16.00 - 17.00">16.00 - 17.00</option>
                        </select>
                        
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-warning" style="border-radius: 10px; margin-top: 10px;" name="pesan">Pesan</button>
            </form>
        </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>