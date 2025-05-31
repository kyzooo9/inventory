<?php 
include 'koneksi.php';

if (isset($_GET['id_guru'])) {
    $id_guru = $_GET['id_guru'];
    $query = "DELETE FROM guru WHERE id_guru='$id_guru'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: guru.php?status=delete_success"); 
    } else {
        header("Location: guru.php?status=delete_error");
    }
    exit();
}
?>