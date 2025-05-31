<?php
include 'koneksi.php';

if (isset($_POST['nama_kelas'])) {
    $kode_kelas = $_POST['kode_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $query = "INSERT INTO kelas (kode_kelas, nama_kelas) VALUES ('$kode_kelas', '$nama_kelas')";
    $result= mysqli_query($koneksi, $query);

    if($result) {
        header('Location: kelas.php?status=success');
    } else {
        header('Location: kelas.php?status=error');
    }
    exit();
}
?>