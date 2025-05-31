<?php
include 'koneksi.php';

if(isset($_POST['id_jenis']) && isset($_POST['nama_jenis'])) {
    $id_jenis = $_POST['id_jenis'];
    $kode_jenis = $_POST['kode_jenis'];
    $nama_jenis = $_POST['nama_jenis'];
    $query = "UPDATE jenis SET kdoe_jenis='$kode_jenis', nama_jenis='$nama_jenis' WHERE id_jenis='$id_jenis'";
    $result = mysqli_query($koneksi, $query);

    if($result) {
        header('Location: jenis.php?status=edit_success');
    } else {
        header('Location: jenis.php?status=edit_error');
    }
    exit();
}
?>
