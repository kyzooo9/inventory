<?php 
include 'koneksi.php';

if(isset($_GET['id_jenis'])) {
    $id_jenis = $_GET['id_jenis'];
    $query= "DELETE FROM jenis WHERE id_jenis='$id_jenis'";
    $result= mysqli_query($koneksi, $query) or die(mysql_error());
    
    if($result){
        header("location:jenis.php?status=delete_success");
    } else{
        header("location:jenis.php?status=delete_error");
    }
    exit();
}
?>