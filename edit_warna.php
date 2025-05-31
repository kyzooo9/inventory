<?php
include 'koneksi.php';

if(isset($_POST['id_warna']) && isset($_POST['nama_warna'])) {
    $id_warna = $_POST['id_warna'];
    $kode_warna = $_POST['kode_warna'];
    $nama_warna = $_POST['nama_warna'];
    $query = "UPDATE warna SET kode_warna='$kode_warna', nama_warna='$nama_warna' WHERE id_warna='$id_warna'";
    $result = mysqli_query($koneksi, $query);

    if($result) {
        header('Location: warna.php?status=edit_success');
    } else {
        header('Location: warna.php?status=edit_error');
    }
    exit();
}
?>
