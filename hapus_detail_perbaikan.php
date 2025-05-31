<?php 
include 'koneksi.php';

if (isset($_GET['kode_detail_perbaikan'])) {
    $kode_detail_perbaikan = $_GET['kode_detail_perbaikan'];
    $query = "DELETE FROM detail_perbaikan WHERE kode_detail_perbaikan='$kode_detail_perbaikan'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: detail_perbaikan.php?status=delete_success"); 
    } else {
        header("Location: detail_perbaikan.php?status=delete_error");
    }
    exit();
}
?>