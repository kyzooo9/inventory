<?php 
include 'koneksi.php';

if (isset($_GET['id_kelas_siswa'])) {
    $id_kelas_siswa = $_GET['id_kelas_siswa'];
    $query = "DELETE FROM kelas_siswa WHERE id_kelas_siswa='$id_kelas_siswa'";
    $result = mysqli_query($koneksi, $query); 
    
    if ($result) {
        header("Location: kelas_siswa.php?status=delete_success"); 
    } else {
        header("Location: kelas_siswa.php?status=delete_error");
    }
    exit();
}
?>