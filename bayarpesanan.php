<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil id langganan dari daftar langganan
$id_langganan = $_GET['id_langganan'];

//buat query tergantung dari langganan
$query = mysqli_query($dbcatering, "SELECT * FROM berlangganan JOIN toko_catering ON berlangganan.id_toko = toko_catering.id_toko JOIN anak_kost ON berlangganan.username = anak_kost.username WHERE id_langganan = $id_langganan");
$row = mysqli_fetch_assoc($query);

if($row['status'] == 'PAID'){
    echo "<script>alert('Anda Sudah Membayar!');
                document.location.href ='daftarlangganan.php'</script>";
}

//cek apakah tombol bayar sudah diklik
if ( isset($_POST['bayar']) ){
    //ambil data dari formulir
    $id_langganan = $id_langganan;
    $tagihan = 'Rp150.000';
    $jenis_pembayaran = $_POST['jenis_pembayaran'];
    $no_hp = strval($_POST['no_hp']);

    //buat query
    $result = mysqli_query($dbcatering, "INSERT INTO pembayaran VALUES ('$id_langganan', '$tagihan', '$jenis_pembayaran', '$no_hp')");

    //cek query berhasil atau tidak
    if($result){
        $status = mysqli_query($dbcatering, "UPDATE berlangganan SET status = 'PAID' WHERE id_langganan = $id_langganan");
        echo "<script>alert('Pembayaran berhasil!');
                document.location.href ='daftarlangganan.php'</script>";
    } else {
        echo "<script>alert('Pembayaran gagal!');
                document.location.href ='bayarpesanan.php'</script>";
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
    <link href="css/billstyle.css" rel="stylesheet">
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
                    <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                    <li><a class="dropdown-item" href="daftarlangganan.php">Daftar Pesanan</a></li>
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
    <!--Form Pembayaran Start-->
    <div class="card mb-3" style="padding-top: 50px; padding-left: 100px; padding-right: 100px; padding-bottom: 50px; border: 10px;">
        <img src="assets/Card-P.png" class="card-img-top" alt="...">
        <div class="card-body"></div>
        <form class="shadow-lg p-3 mb-5 bg-body rounded" action="" method="post">
            <fieldset>
                <p>Nama : <?= $row['nama']?></p>
                <p>Toko Catering : <?= $row['nama_toko']?></p>
                <p>Tanggal Awal Berlangganan : <?= $row['tanggal_awal_langganan']?></p>
                <p>Tanggal Akhir Berlangganan : <?= $row['tanggal_akhir_langganan']?></p>
                <p>Total tagihan : <?= $row['harga']?></p>
                <p>
                    <label for="jenis_pembayaran">Jenis Pembayaran  </label>
                    <select class="form-select" aria-label="Default select example" name="jenis_pembayaran" id="jenis_pembayaran" required>
                        <option value="" disabled selected>Pilih jenis pembayaran</option>
                        <option value="gopay">Go-Pay</option>
                        <option value="ovo">OVO</option>
                        <option value="dana">DANA</option>
                        <option value="spay">Shopee-Pay</option>
                    </select>
                </p>
                <p>
                    <label class="label" for="no_hp">Nomor HP : </label>
                    <input type="number" class="form-control" id="no_hp" placeholder="08XX XXXX XXXX" required>
                </p>
            </fieldset>
            <button class="btn btn-warning d-grid gap-2" type="submit" name="bayar" onclick="return confirm('Pesanan yang sudah dibayar dan ingin dibatalkan, tidak mendapatkan refund!');">Bayar</button>
        </form>
        </div>
        </div>
        <!--Form Pembayaran End-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>