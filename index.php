<?php
session_start();

if( isset($_SESSION["login"]) ){
    header("Location: homepage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DapurKost</title>

    <!-- menyisipkan bootstrap -->
     <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body class="bg-light">
    <header>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>Welcome to DapurKost</h1>
                        <p>Discover menus according to your preference here</p>
                    </div>
                    <div class="col-md-4">
                        <a href="login.php" class="btn btn-secondary">Login</a>
                        <a href="registrasi.php" class="btn btn-success">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img class="img img-responsive" src="img/connect.png" />
                </div>
            </div>
        </div>
    </section>

</body>
</html>