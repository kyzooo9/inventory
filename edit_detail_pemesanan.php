<?php
include 'koneksi.php';

if (isset($_POST['kode_detail_pemesanan'])) {
    $kode_detail_pemesanan = $_POST['kode_detail_pemesanan'];
    $nama_peralatan = $_POST['nama_peralatan'];
    $kode_pemesanan = $_POST['kode_pemesanan'];

    $query = "UPDATE detail_pemesanan SET kode_detail_pemesanan='$kode_detail_pemesanan', id_peralatan='$nama_peralatan', id_pemesanan='$kode_pemesanan' WHERE kode_detail_pemesanan='$kode_detail_pemesanan'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: detail_pemesanan.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: detail_pemesanan.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>