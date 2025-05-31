<?php
include 'koneksi.php';

if (isset($_POST['nama_warna'])) {
    $kode_warna = $_POST['kode_warna'];
    $nama_warna = $_POST['nama_warna'];
    $query = "INSERT INTO warna (kode_warna, nama_warna) VALUES ('$kode_warna', '$nama_warna')";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header('Location: warna.php?status=success');
    } else{
        header('Location: warna.php?status=error');
    }
    exit();
}
?>