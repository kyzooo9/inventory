<?php
include 'koneksi.php';

if (isset($_POST['kode_detail_perbaikan'])) {
    $kode_detail_perbaikan = $_POST['kode_detail_perbaikan'];
    $nama_peralatan = $_POST['nama_peralatan'];
    $kode_perbaikan = $_POST['kode_perbaikan'];

    $query = "UPDATE detail_perbaikan SET kode_detail_perbaikan='$kode_detail_perbaikan', id_peralatan='$nama_peralatan', id_perbaikan='$kode_perbaikan' WHERE kode_detail_perbaikan='$kode_detail_perbaikan'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: detail_perbaikan.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: detail_perbaikan.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>