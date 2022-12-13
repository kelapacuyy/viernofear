<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include("config.php");

//ambil id langganan dari daftar langganan
$id_langganan = $_GET['id_langganan'];

$rowbill = mysqli_query($dbcatering, "SELECT * FROM pembayaran WHERE id_langganan = $id_langganan");

//cek apakah pesanan sudah dibayar
if (mysqli_num_rows($rowbill) === 1){
    //query hapus
    $result1 = mysqli_query($dbcatering, "DELETE  FROM pembayaran WHERE id_langganan = $id_langganan");
    $result2 = mysqli_query($dbcatering, "DELETE  FROM berlangganan WHERE id_langganan = $id_langganan");

    if($result1 && $result2){
        echo "<script>alert('Pemesanan berhasil dibatalkan tanpa ada refund!');
                     document.location.href ='daftarlangganan.php'</script>";
    }
} else {
    //query hapus
    $result2 = mysqli_query($dbcatering, "DELETE  FROM berlangganan WHERE id_langganan = $id_langganan");
    
    //cek query
    if($result2){
        echo "<script>alert('Pemesanan berhasil dibatalkan!');
                    document.location.href ='daftarlangganan.php'</script>";
    }
}