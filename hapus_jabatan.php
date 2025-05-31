<?php
include 'koneksi.php';

if (isset($_GET['id_jabatan'])) {
    $id_jabatan = $_GET['id_jabatan'];
    $query = "DELETE FROM jabatan WHERE id_jabatan='$id_jabatan'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: jabatan.php?status=delete_success"); // Status untuk delete berhasil
    } else {
        header("Location: jabatan.php?status=delete_error"); // Status untuk delete gagal
    }
    exit();
}
?>
