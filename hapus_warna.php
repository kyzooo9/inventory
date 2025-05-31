<?php 
include 'koneksi.php';

if(isset($_GET['id_warna'])) {
    $id_warna = $_GET['id_warna'];
    $query= "DELETE FROM warna WHERE id_warna='$id_warna'";
    $result= mysqli_query($koneksi, $query) or die(mysql_error());
    
    if($result){
        header("location:warna.php?status=delete_success");
    } else{
        header("location:warna.php?status=delete_error");
    }
    exit();
}
?>