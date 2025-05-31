<?php
include 'koneksi.php';

if(isset($_POST['id_jurusan']) && isset($_POST['nama_jurusan'])) {
    $id_jurusan = $_POST['id_jurusan'];
    $kode_jurusan = $_POST['kode_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];
    $inisial = $_POST['inisial'];
    $query = "UPDATE jurusan SET kode_jurusan='$kode_jurusan', nama_jurusan='$nama_jurusan', inisial='$inisial' WHERE id_jurusan='$id_jurusan'";
    $result = mysqli_query($koneksi, $query);

    if($result) {
        header('Location: jurusan.php?status=edit_success');
    } else {
        header('Location: jurusan.php?status=edit_error');
    }
    exit();
}
?>
