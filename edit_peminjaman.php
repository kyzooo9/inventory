<?php
include 'koneksi.php';

if (isset($_POST['id_peminjaman']) && isset($_POST['username_peminjam'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $kode_peminjaman = $_POST['kode_peminjaman'];
    $id_peminjam = $_POST['username_peminjam'];
    $id_guru = $_POST['nama_guru'];
    $id_denda = $_POST['denda'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

    $query = "UPDATE peminjaman SET kode_peminjaman='$kode_peminjaman', id_guru='$id_guru', id_peminjam='$id_peminjam', id_denda='$id_denda', tanggal_peminjaman='$tanggal_peminjaman', tanggal_kembali='$tanggal_kembali', tanggal_pengembalian='$tanggal_pengembalian' WHERE id_peminjaman='$id_peminjaman'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: peminjaman.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: peminjaman.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>