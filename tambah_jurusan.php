<?php
include 'koneksi.php';

if (isset($_POST['nama_jurusan'])) {
    $kode_jurusan = $_POST['kode_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];
    $inisial = $_POST['inisial'];
    $query = "INSERT INTO jurusan (nama_jurusan, kode_jurusan, inisial) VALUES ('$nama_jurusan', '$kode_jurusan', '$inisial')";
    $result = mysqli_query($koneksi, $query);

    if($result){
        header('Location: jurusan.php?status=success');
    } else{
        header('Location: jurusan.php?status=error');
    }
    exit();
}
?>