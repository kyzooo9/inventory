<?php
include 'koneksi.php';

if (isset($_POST['id_jabatan']) && isset($_POST['nama_jabatan'])) {
    $id_jabatan = $_POST['id_jabatan'];
    $kode_jabatan = $_POST['kode_jabatan'];
    $nama_jabatan = $_POST['nama_jabatan'];
    $query = "UPDATE jabatan SET kode_jabatan='$kode_jabatan', nama_jabatan='$nama_jabatan' WHERE id_jabatan='$id_jabatan'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: jabatan.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: jabatan.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>