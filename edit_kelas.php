<?php
include 'koneksi.php';

if(isset($_POST['id_kelas']) && isset($_POST['nama_kelas'])) {
    $id_kelas = $_POST['id_kelas'];
    $kode_kelas = $_POST['kode_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $query = "UPDATE kelas SET kode_kelas='$kode_kelas', nama_kelas='$nama_kelas' WHERE id_kelas='$id_kelas'";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header('Location: kelas.php?status=edit_success');
    } else{
        header('Location: kelas.php?status=edit_error');
    }
    exit();
}
?>