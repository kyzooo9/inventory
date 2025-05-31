<?php 
include 'koneksi.php';

if (isset($_GET['id_siswa'])) {
    $id_siswa = $_GET['id_siswa'];
    $query = "DELETE FROM siswa WHERE id_siswa='$id_siswa'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: siswa.php?status=delete_success"); 
    } else {
        header("Location: siswa.php?status=delete_error");
    }
    exit();
}
?>