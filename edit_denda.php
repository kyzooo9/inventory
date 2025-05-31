<?php
include 'koneksi.php';

if(isset($_POST['id_denda']) && isset($_POST['denda'])) {
    $id_denda = $_POST['id_denda'];
    $kode_denda = $_POST['kode_denda'];
    $denda = $_POST['denda'];
    $keterangan = $_POST['keterangan'];
    $query = "UPDATE denda SET kode_denda='$kode_denda', denda='$denda', keterangan='$keterangan' WHERE id_denda='$id_denda'";
    $result= mysqli_query($koneksi, $query);

    if($result){
        header('Location: denda.php?status=edit_success');
    } else{
        header('Location: denda.php?status=edit_error');
    }
    exit();
}
?>