<?php 
include 'koneksi.php';

if (isset($_GET['kode_detail_pemesanan'])) {
    $kode_detail_pemesanan = $_GET['kode_detail_pemesanan'];
    $query = "DELETE FROM detail_pemesanan WHERE kode_detail_pemesanan='$kode_detail_pemesanan'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: detail_pemesanan.php?status=delete_success"); 
    } else {
        header("Location: detail_pemesanan.php?status=delete_error");
    }
    exit();
}
?>