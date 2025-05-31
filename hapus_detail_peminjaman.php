<?php 
include 'koneksi.php';

if (isset($_GET['kode_detail_peminjaman'])) {
    $kode_detail_peminjaman = $_GET['kode_detail_peminjaman'];
    $query = "DELETE FROM detail_peminjaman WHERE kode_detail_peminjaman='$kode_detail_peminjaman'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: detail_peminjaman.php?status=delete_success"); 
    } else {
        header("Location: detail_peminjaman.php?status=delete_error");
    }
    exit();
}
?>