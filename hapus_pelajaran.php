<?php 
include 'koneksi.php';

if(isset($_GET['id_pelajaran'])) {
    $id_pelajaran = $_GET['id_pelajaran'];
    $query= "DELETE FROM pelajaran WHERE id_pelajaran='$id_pelajaran'";
    $result= mysqli_query($koneksi, $query) or die(mysql_error());
    
    if($result){
        header("location:pelajaran.php?status=delete_success");
    } else{
        header("location:pelajaran.php?status=delete_error");
    }
    exit();
}
?>