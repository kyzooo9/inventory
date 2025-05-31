<?php
include 'koneksi.php';

if (isset($_POST['id_peminjaman_guru']) && isset($_POST['username_peminjam'])) {
    $id_peminjaman_guru = $_POST['id_peminjaman_guru'];
    $kode_peminjaman_guru = $_POST['kode_peminjaman_guru'];
    $keterangan_peminjaman = $_POST['keterangan_peminjaman'];
    $id_peminjam = $_POST['username_peminjam'];

    $query = "UPDATE peminjaman_guru SET kode_peminjaman_guru='$kode_peminjaman_guru', keterangan_peminjaman='$keterangan_peminjaman', id_peminjam='$id_peminjam' WHERE id_peminjaman_guru='$id_peminjaman_guru'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: peminjaman_guru.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: peminjaman_guru.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>