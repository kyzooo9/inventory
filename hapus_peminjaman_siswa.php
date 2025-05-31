<?php 
include 'koneksi.php';

if(isset($_GET['id_peminjaman_siswa'])) {
    $id_peminjaman_siswa = $_GET['id_peminjaman_siswa'];
    $query= "DELETE FROM peminjaman_siswa WHERE id_peminjaman_siswa='$id_peminjaman_siswa'";
    $result= mysqli_query($koneksi, $query) or die(mysql_error());
    
    if($result){
        header("location:peminjaman_siswa.php?status=delete_success");
    } else{
        header("location:peminjaman_siswa.php?status=delete_error");
    }
    exit();
}
?>