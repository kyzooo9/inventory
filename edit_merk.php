<?php
include 'koneksi.php';

if(isset($_POST['id_merk']) && isset($_POST['nama_merk'])) {
    $id_merk = $_POST['id_merk'];
    $kode_merk = $_POST['kode_merk'];
    $nama_merk = $_POST['nama_merk'];
    $query = "UPDATE merk SET kode_merk='$kode_merk', nama_merk='$nama_merk' WHERE id_merk='$id_merk'";
    $result = mysqli_query($koneksi, $query);

    if($result) {
        header('Location: merk.php?status=edit_success');
    } else {
        header('Location: merk.php?status=edit_error');
    }
    exit();
}
?>
