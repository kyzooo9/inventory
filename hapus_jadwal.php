<?php 
include 'koneksi.php';

if (isset($_GET['id_jadwal'])) {
    $id_jadwal = $_GET['id_jadwal'];
    $query = "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: jadwal.php?status=delete_success"); 
    } else {
        header("Location: jadwal.php?status=delete_error");
    }
    exit();
}
?>