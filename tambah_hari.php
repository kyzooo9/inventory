<?php
include 'koneksi.php';

if (isset($_POST['nama_hari'])) {
    $kode_hari = $_POST['kode_hari'];
    $nama_hari = $_POST['nama_hari'];
    
    $query = "INSERT INTO `hari` (`kode_hari`, `nama_hari`) VALUES ('$kode_hari', '$nama_hari')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: hari.php?status=success');
    } else {
        echo "Error: " . mysqli_error($koneksi);
        header('Location: hari.php?status=error');
    }
    exit();
}
?>
