<?php
include 'koneksi.php';

if (isset($_POST['kode_detail_perbaikan'])) {
    $nama_peralatan = mysqli_real_escape_string($koneksi, $_POST['nama_peralatan']);
    $kode_perbaikan = mysqli_real_escape_string($koneksi, $_POST['kode_perbaikan']);
    $kode_detail_perbaikan = mysqli_real_escape_string($koneksi, $_POST['kode_detail_perbaikan']);

    $query = "INSERT INTO detail_perbaikan (KODE_DETAIL_PERBAIKAN, ID_PERBAIKAN, ID_PERALATAN) VALUES ('$kode_detail_perbaikan', '$kode_perbaikan', '$nama_peralatan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: detail_perbaikan.php?status=success');
    } else {
        header('Location: detail_perbaikan.php?status=error');
    }
    exit();
}
?>
