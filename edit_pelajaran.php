<?php
include 'koneksi.php';
if(isset($_POST['id_pelajaran']) && isset($_POST['nama_pelajaran'])){
    $id_pelajaran = $_POST['id_pelajaran'];
    $kode_pelajaran = $_POST['kode_pelajaran'];
    $nama_pelajaran = $_POST['nama_pelajaran'];
    $query = "UPDATE pelajaran SET kode_pelajaran='$kode_pelajaran', nama_pelajaran='$nama_pelajaran' WHERE id_pelajaran='$id_pelajaran'";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header('Location: pelajaran.php?status=edit_success');
    } else {
        header('Location: pelajaran.php?status=edit_error');
    }
    exit();
}
?>