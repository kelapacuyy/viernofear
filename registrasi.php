<?php
session_start();

if( isset($_SESSION["login"]) ){
    header("Location: index.php");
    exit;
}
include("config.php");

//cek tombol submit sudah diklik blm
if( isset($_POST['register']) ){

    //ambil data dari form
    //htmlspecialchars untuk menghindari injeksi dr user
    $username = strtolower(htmlspecialchars($_POST['username']));
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $tanggal_lahir = htmlspecialchars(date("Y-m-d", strtotime($_POST['tanggal_lahir']))); //ubah format ttl html to postgres
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $no_hp = htmlspecialchars($_POST['no_hp']);
    $alamat_kos = htmlspecialchars($_POST['alamat_kos']);
    $password = htmlspecialchars($_POST['password']);
    $verif_password = htmlspecialchars($_POST['verif_password']);

    //cek uname sudah ada atau belum
    $cek = mysqli_query($dbcatering, "SELECT * FROM anak_kost WHERE username = '$username'");
    $cek2 = mysqli_query($dbcatering, "SELECT * FROM anak_kost WHERE email = '$email'");
    $result = mysqli_fetch_assoc($cek);
    $result2 = mysqli_fetch_assoc($cek2);

    if( $result['username'] == 1 ) {
        echo "<script>alert('Username Telah Terdaftar!');
                document.location.href ='registrasi.php'</script>";
        return false; //diberhentikan
    }

    if( $result2['nik'] ){
        echo "<script>alert('Email Telah Terdaftar!');
                   document.location.href ='registrasi.php'</script>";
        return false; //diberhentikan
    }
    // cek password sama atau tidak
    if($password !== $verif_password){
        echo "<script>alert('Password berbeda!');
                   document.location.href ='registrasi.php'</script>";
        return false; //diberhentikan
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //persiapan simpan data
    $query = mysqli_query($dbcatering, "INSERT INTO anak_kost VALUES ('$username', '$nama', '$email', '$tanggal_lahir', '$jenis_kelamin', '$no_hp', '$alamat_kos', '$password')");
    //uji jika simpan data berhasil
    if($query){
        echo "<script>alert('Registrasi berhasil!');
                document.location.href ='login.php'</script>";
    } else {
        echo "<script>alert('Registrasi gagal!');
                document.location.href ='registrasi.php'</script>";
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
    <link href="style.css" rel="stylesheet">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

            /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
    <body>
        <div class="container1" style=" margin: 60px;">
            <div class="row">
                <div class="col">
                    <div class="logo text-center" style="margin-top: 120px;">
                        <img src="assets/Dapurkost.png" class="img-fluid text-center" alt="logo">
                    </div>
                </div>
                <div class="col">
                <div class="container2" >
                    <h2 class="title text-left">Sign Up </h2>
                    <form style="padding-bottom: 60px; padding-right: 90px;" action="" method="post">
                        <fieldset class="">
                            <p>
                                <label for="username">Username  </label><br>
                                <input class="form-control" type="text" name="username" placeholder="Username" id="username" required> <!--blm dihapus button controlnya, apus di css-->
                            </p>
                            <p>
                                <label for="nama">Nama  </label><br>
                                <input class="form-control" type="text" name="nama" placeholder="Nama saya" id="nama" required> <!--blm dihapus button controlnya, apus di css-->
                            </p>
                            <p>
                                <label for="email">Alamat Email</label><br>
                                <input class="form-control" type="email" name="email" placeholder="Email saya" id="email" required>
                            </p>
                            <p>
                                <label for="tanggal_lahir">Tanggal Lahir  </label><br>
                                <input class="form-control" type="date" name="tanggal_lahir" required>
                            </p>
                            <p>
                                <label for="jenis_kelamin">Jenis Kelamin  </label><br>
                                <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L">Laki-laki</label>
                                <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P">Perempuan</label>
                            </p>
                            <p>
                                <label for="no_hp">Nomor Telepon  </label><br>
                                <input class="form-control" type="text" name="no_hp" placeholder="Nomor Teleponmu" id="no_hp" required>
                            </p>
                            <p>
                                <label for="alamat_kos">Alamat Kost  </label><br>
                                <input class="form-control" type="text" name="alamat_kos" placeholder="Tulis alamat lengkapmu" id="alamat_kos" required>
                            </p>
                            <p>
                                <label for="password">Password  </label><br>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Masukkan Password" required><br>
                                <label for="verif_password">Konfirmasi Password : </label><br>
                                <input class="form-control" type="password" name="verif_password" id="verif_password" placeholder="Konfirmasi Password" required>
                                <div class="d-grid gap-2">
                                    <button class="button" type="submit" name="register">Daftar</button>
                                    <button class="button"><a href="login.php" class="akun">Login</a></button>
                                </div>
                            </p>
                        </fieldset>
                    </form>
                    </div>
                </div>
            </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>
