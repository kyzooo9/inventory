<?php 
include 'koneksi.php';

if (isset($_GET['id_hari'])) {
    $id_hari = $_GET['id_hari'];
    $query = "DELETE FROM hari WHERE id_hari='$id_hari'";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header("location:hari.php?status=delete_success");
    } else{
        header("location:hari.php?status=delete_error");
    }
    exit();
}
?>