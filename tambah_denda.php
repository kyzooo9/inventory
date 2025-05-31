<?php
include 'koneksi.php';

if (isset($_POST['denda'])) {
    $kode_denda = $_POST['kode_denda'];
    $denda = $_POST['denda'];
    $keterangan = $_POST['keterangan'];
    $query = "INSERT INTO denda (kode_denda, denda, keterangan) VALUES ('$kode_denda', '$denda', '$keterangan')";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header('Location: denda.php?status=success');
    } else{
        header('Location: denda.php?status=error');
    }
    exit();
}
?>