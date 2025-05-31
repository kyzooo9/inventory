<?php 
include 'koneksi.php';

if (isset($_GET['id_pemesanan'])) {
    $id_pemesanan = $_GET['id_pemesanan'];
    $query = "DELETE FROM pemesanan WHERE id_pemesanan='$id_pemesanan'";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header("location:pemesanan.php?status=delete_success");
    } else{
        header("location:pemesanan.php?status=delete_error");
    }
    exit();
}
?>