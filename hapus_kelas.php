<?php 
include 'koneksi.php';

if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];
    $query = "DELETE FROM kelas WHERE id_kelas='$id_kelas'";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header("location:kelas.php?status=delete_success");
    } else{
        header("location:kelas.php?status=delete_error");
    }
    exit();
}
?>