<?php 
include 'koneksi.php';

if (isset($_GET['id_denda'])) {
    $id_denda = $_GET['id_denda'];
    $query = "DELETE FROM denda WHERE id_denda='$id_denda'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: denda.php?status=delete_success"); 
    } else {
        header("Location: denda.php?status=delete_error");
    }
    exit();
}
?>