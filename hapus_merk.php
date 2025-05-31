<?php 
include 'koneksi.php';

if(isset($_GET['id_merk'])) {
    $id_merk = $_GET['id_merk'];
    $query= "DELETE FROM merk WHERE id_merk='$id_merk'";
    $result= mysqli_query($koneksi, $query) or die(mysql_error());
    
    if($result){
        header("location:merk.php?status=delete_success");
    } else{
        header("location:merk.php?status=delete_error");
    }
    exit();
}
?>