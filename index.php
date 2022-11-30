<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil data user
$username = $_SESSION['user']['username'];
$query = mysqli_query($koneksi, "SELECT * FROM anak_kost WHERE username = '$username'");
$row = mysqli_fetch_assoc($query);


?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DapurKost</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="css/indexStyle.css" rel="stylesheet">
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-light sticky-top">
            <div class="container-fluid">
                <img src="#" class="img-fluid text-center" width="50px" height="50px" alt="logo">
                <a class="navbar-brand" href="#">DapurKost</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Beranda</a>
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
                        <li><a class="dropdown-item" href="berlangganan.php">Riwayat Langganan</a></li>
                    </ul>
                    </li>
                </ul>
                <ul class="d-flex">
                    <a class="profile" style="padding-top: 7px;" href="profile.php">
                        <img src="assets/iconprofile.png" alt="profilelogo"/>
                    </a>
                    <a class="nav-link m-2"> Hi, <?= $row['nama']?></a>
                    <button class="btn btn-outline-warning" style="border-radius: 15px;" type="submit" ><a href="logout.php" class="logout">Log Out</a></button>
                </ul>
                </div>
            </div>
            </nav>
            <!-- Navbar end -->
            <!-- Carosel -->
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                    <img src="assets/home1.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                    <img src="assets/home2.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="assets/home3.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
                <!-- Carosel end -->
                <!-- Layanancard start -->
                <div class="Secondary-title">
                <h1 class="text-center" style="padding-top: 50px;">Siap Memasak Setiap Hari</h1>
                <div class="container2 text-center">
                    <div class="layanancard">
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="assets/layanan1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Menerima Langganan</h5>
                                    <p class="card-text">Solusi yang tepat untuk Anda yang memiliki permasalahan menu dan waktu makan. Kami siap menyediakan makanan yang bergizi dan diantar tepat waktu ke tempat Anda. </p>
                                    <a href="pemesanan.php" class="btn btn-outline-warning">Pesan</a>
                                </div>
                                </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="assets/layanan2.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Menyediakan Catering untuk Acara Anda</h5>
                                    <p class="card-text">Kami siap menyediakan makanan untuk Anda dan para tamu sepanjang acara, jangan khawatir!.</p>
                                    <a href="pemesanan.php" class="btn btn-outline-warning">Pesan</a>
                                </div>
                                </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="assets/layanan3.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bebas Memilih</h5>
                                    <p class="card-text">Kami membebaskan Anda dalam memilih menu makanan setiap harinya, Anda dapat memilih menu dalam bentuk paket atau memilih menu sendiri, beberapa toko catering kami menyediakan keduanya!</p>
                                    <a href="pemesanan.php" class="btn btn-outline-warning">Pesan</a>
                                </div>
                                </div>    
                        </div>
                    </div>
                    </div>
                </div>
                <!-- layanancard end -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>