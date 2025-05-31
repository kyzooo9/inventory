<?php 
include 'koneksi.php';

if (isset($_GET['id_perbaikan'])) {
    $id_perbaikan = $_GET['id_perbaikan'];
    $query = "DELETE FROM perbaikan WHERE id_perbaikan='$id_perbaikan'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: perbaikan.php?status=delete_success"); 
    } else {
        header("Location: perbaikan.php?status=delete_error");
    }
    exit();
}
?>