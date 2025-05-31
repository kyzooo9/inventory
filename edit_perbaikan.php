<?php
include 'koneksi.php';

if (isset($_POST['id_perbaikan']) && isset($_POST['tanggal_perbaikan'])) {
    $id_perbaikan = $_POST['id_perbaikan'];
    $kode_perbaikan = $_POST['kode_perbaikan'];
    $tanggal_perbaikan = $_POST['tanggal_perbaikan'];
    $id_guru = $_POST['id_guru'];

    $query = "UPDATE perbaikan SET kode_perbaikan='$kode_perbaikan', tanggal_perbaikan='$tanggal_perbaikan', id_guru='$id_guru' WHERE id_perbaikan='$id_perbaikan'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location:perbaikan.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location:perbaikan.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>