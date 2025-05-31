<?php
include 'koneksi.php';

if (isset($_POST['nama_jenis'])) {
    $kode_jenis = $_POST['kode_jenis'];
    $nama_jenis = $_POST['nama_jenis'];
    $query = "INSERT INTO jenis (kode_jenis, nama_jenis) VALUES ('$kode_jenis', '$nama_jenis')";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header('Location: jenis.php?status=success');
    } else{
        header('Location: jenis.php?status=error');
    }
    exit();
}
?>