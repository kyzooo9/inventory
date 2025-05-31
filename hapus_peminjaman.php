<?php 
include 'koneksi.php';

if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];
    $query = "DELETE FROM peminjaman WHERE id_peminjaman='$id_peminjaman'";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header("location:peminjaman.php?status=delete_success");
    } else{
        header("location:peminjaman.php?status=delete_error");
    }
    exit();
}
?>