<?php
include 'koneksi.php';

if (isset($_POST['nama_merk'])) {
    $kode_merk = $_POST['kode_merk'];
    $nama_merk = $_POST['nama_merk'];
    $query = "INSERT INTO merk (kode_merk, nama_merk) VALUES ('$kode_merk', '$nama_merk')";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header('Location: merk.php?status=success');
    } else{
        header('Location: merk.php?status=error');
    }
    exit();
}
?>