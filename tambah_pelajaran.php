<?php
include 'koneksi.php';

if (isset($_POST['nama_pelajaran'])) {
    $kode_pelajaran = $_POST['kode_pelajaran'];
    $nama_pelajaran = $_POST['nama_pelajaran'];
    $query = "INSERT INTO pelajaran (kode_pelajaran, nama_pelajaran) VALUES ('$kode_pelajaran', '$nama_pelajaran')";
    $result= mysqli_query($koneksi, $query);

    if($result) {
        header('Location: pelajaran.php?status=success');
    } else {
        header('Location: pelajaran.php?status=error');
    }
    exit();
}
?>