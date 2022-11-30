<?php
    $server = "localhost";
    $user = "root";
    $password ="";
    $database = "catering";

    $dbcatering = mysqli_connect($server,$user,$password,$database) or die(mysqli_error($dbcatering));
?>