<?php
session_start();

if( isset($_SESSION["login"]) ){
    header("Location: homepage.php");
    exit;
}

include('config.php');

if( isset($_POST['akun']) ){
  header("Location: registrasi.php");
}

//cek apakah tombol login sudah diklik
if( isset($_POST["login"]) ){

    //ambil data dari form
    $username = strtolower(htmlspecialchars($_POST['username']));
    $password = $_POST['password'];

    //buat query
    $result = mysqli_query($dbcatering, "SELECT * FROM anak_kost WHERE username = '$username'");

    //cek uname apakah terdaftar
    if( mysqli_num_rows($result) === 1 ){
        //cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row['password']) ){
            //set session
            $_SESSION["user"] = $row;
            $_SESSION["login"] = true;

            header("Location: homepage.php");

            exit; //keluar fungsi if
        }
    }

    //jika password salah
    $error = true;
    if ( isset($error) ){
        echo "<script>alert('Username/Password salah!');
        document.location.href ='login.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DapurKost</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous"
    />
    <link href="loginStyle.css" rel="stylesheet" />
    </head>
    <body>
    <div class="container1">
        <div class="row">
        <div class="col">
            <div class="logo text-center">
            <img
                src="assets/Dapurkost.png"
                class="img-fluid text-center"
                alt="logo"
            />
            </div>
        </div>
        <div class="col" style="margin-top: 70px; margin-right: 100px;">
            <div class="container2" style="padding: 50px">
            <h2 class="title text-center">Log in</h2>
            <form method="post" style="padding: 30px">
                <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    class="form-control"
                    id="username"
                    placeholder="Masukkan Username"
                    name="username"
                    required
                />
                </div>

                <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    placeholder="Masukkan Password"
                    name="password"
                    required
                />
                </div>
                <div class="d-grid gap-2">
                <input
                    type="submit"
                    name="login"
                    class="btn btn-primary"
                    value="Log in"
                />
                <button class="btn btn-secondary"><a href="registrasi.php" class="akun">Registrasi Akun</a></button>   
             </div>
            </form>
            
            </div>
        </div>
        </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"
    ></script>
    </body>
</html>
