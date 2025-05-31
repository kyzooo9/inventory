<?php 
include 'koneksi.php';

if(isset($_GET['id_peminjaman_guru'])) {
    $id_peminjaman_guru = $_GET['id_peminjaman_guru'];
    $query= "DELETE FROM peminjaman_guru WHERE id_peminjaman_guru='$id_peminjaman_guru'";
    $result= mysqli_query($koneksi, $query) or die(mysql_error());
    
    if($result){
        header("location:peminjaman_guru.php?status=delete_success");
    } else{
        header("location:peminjaman_guru.php?status=delete_error");
    }
    exit();
}
?>