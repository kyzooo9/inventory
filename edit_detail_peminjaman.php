<?php
include 'koneksi.php';

if (isset($_POST['kode_detail_peminjaman'])) {
    $kode_detail_peminjaman = $_POST['kode_detail_peminjaman'];
    $nama_peralatan = $_POST['nama_peralatan'];
    $kode_peminjaman = $_POST['kode_peminjaman'];

    $query = "UPDATE detail_peminjaman SET kode_detail_peminjaman='$kode_detail_peminjaman', id_peralatan='$nama_peralatan', id_peminjaman='$kode_peminjaman' WHERE kode_detail_peminjaman='$kode_detail_peminjaman'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: detail_peminjaman.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: detail_peminjaman.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>