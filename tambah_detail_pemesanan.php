<?php
include 'koneksi.php';

if (isset($_POST['kode_detail_pemesanan'])) {
    $nama_peralatan = mysqli_real_escape_string($koneksi, $_POST['nama_peralatan']);
    $kode_pemesanan = mysqli_real_escape_string($koneksi, $_POST['kode_pemesanan']);
    $kode_detail_pemesanan = mysqli_real_escape_string($koneksi, $_POST['kode_detail_pemesanan']);

    $query = "INSERT INTO detail_pemesanan (KODE_DETAIL_PEMESANAN, ID_PEMESANAN, ID_PERALATAN) VALUES ('$kode_detail_pemesanan', '$kode_pemesanan', '$nama_peralatan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: detail_pemesanan.php?status=success');
    } else {
        header('Location: detail_pemesanan.php?status=error');
    }
    exit();
}
?>
