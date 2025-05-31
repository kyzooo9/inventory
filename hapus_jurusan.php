<?php 
include 'koneksi.php';

if (isset($_GET['id_jurusan'])) {
    $id_jurusan = $_GET['id_jurusan'];
    $query = "DELETE FROM jurusan WHERE id_jurusan='$id_jurusan'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: jurusan.php?status=delete_success"); 
    } else {
        header("Location: jurusan.php?status=delete_error");
    }
    exit();
}
?>