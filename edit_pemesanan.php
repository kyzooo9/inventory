<?php
include 'koneksi.php';

if (isset($_POST['id_pemesanan'])) {
    $id_pemesanan = $_POST['id_pemesanan'];
    $kode_pemesanan = $_POST['kode_pemesanan'];
    $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
    $status_pemesanan = $_POST['status_pemesanan'];
    $id_peminjam = $_POST['username_peminjam'];

    $query = "UPDATE pemesanan SET kode_pemesanan='$kode_pemesanan', tanggal_pemesanan='$tanggal_pemesanan', status_pemesanan='$status_pemesanan', id_peminjam='$id_peminjam' WHERE id_pemesanan='$id_pemesanan'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: pemesanan.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: pemesanan.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>