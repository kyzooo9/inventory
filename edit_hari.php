<?php
include 'koneksi.php';

if(isset($_POST['id_hari']) && isset($_POST['nama_hari'])) {
    $id_hari = $_POST['id_hari'];
    $kode_hari = $_POST['kode_hari'];
    $nama_hari = $_POST['nama_hari'];
    $query = "UPDATE hari SET kode_hari='$kode_hari', nama_hari='$nama_hari' WHERE id_hari='$id_hari'";
    $result = mysqli_query($koneksi, $query);

    if($result) {
        header('Location: hari.php?status=edit_success');
    } else {
        header('Location: hari.php?status=edit_error');
    }
    exit();
}
?>
